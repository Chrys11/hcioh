<?php
/********************************************************************************************* 
*** Notes:
    **** This requires alot of editing, I am using the lazy methods which is almost impractical
    **** for large databases 
**************************************************************************************************/

if(isset($_POST['addtopics']) && isset($_POST['wc_c'])){
    $chosen = [];
    for($i=0;$i<100;$i++){
        if(isset($_POST["$i"])){
            array_push($chosen,$i);
        }
    }
    $its=[];
    require_once('conn.php');
    if($_POST['wc_type']=='cu'){
        $stmt = mysqli_prepare($conn,"SELECT topics FROM course_units WHERE cid=?");
        mysqli_stmt_bind_param($stmt,'i',$_POST['wc_c']);
    }
    elseif($_POST['wc_type']=='t'){
        $stmt = mysqli_prepare($conn,"SELECT topics FROM teachers WHERE tid=?");
        mysqli_stmt_bind_param($stmt,'s',$_POST['wc_c']);
    }
    mysqli_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_row($res)){
        if($row[0]!=''){
            $its = explode(',',$row[0]);
        }
    }
    $lits = array_merge($its,$chosen);
    $fits = implode(',',$lits);

    if($_POST['wc_type']=='cu'){
        $stmt = mysqli_prepare($conn,"UPDATE course_units SET topics=? WHERE cid=?");
        mysqli_stmt_bind_param($stmt,'si',$fits,$_POST['wc_c']);
        mysqli_execute($stmt);
        header('location:acu.php?wc_c='.$_POST['wc_c']);
    }
    elseif($_POST['wc_type']=='t'){
        ////MORE WORK NEEDED HERE UPDATING THE TOPICS FOR EACH TEACHER
        $stmt = mysqli_prepare($conn,"UPDATE teachers SET topics=? WHERE tid=?");
        mysqli_stmt_bind_param($stmt,'ss',$fits,$_POST['wc_c']);
        mysqli_execute($stmt);

        foreach($lits as $li){
            $stmt = mysqli_prepare($conn,"UPDATE topics SET teacher=? WHERE toid=?");
            mysqli_stmt_bind_param($stmt,'si',$_POST['wc_c'],$li);
            mysqli_execute($stmt);
        }

        header('location:teachers.php?wc_t='.$_POST['wc_c']);
    }
}
else{
    header('location:home.php');
}

?>
<?php
if(isset($_POST['addt'])){
    require_once('conn.php');
    $stmt = mysqli_prepare($conn,"INSERT INTO topics(name,notes) VALUES(?,'1000000')");
    mysqli_stmt_bind_param($stmt,'s',$_POST['t_name']);
    mysqli_execute($stmt);

    $tid=0;
    $stmt = mysqli_prepare($conn,"SELECT toid FROM topics WHERE notes='1000000'");
    mysqli_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_row($res)){
        $tid = $row[0];
    }

    $stmt = mysqli_prepare($conn,"UPDATE topics SET notes='' WHERE toid=?");
    mysqli_stmt_bind_param($stmt,'i',$tid);
    mysqli_execute($stmt);
    header('location:topics.php?wc_t='.$tid);
    
}
elseif(isset($_POST['rename_t']) && isset($_POST['wc_t'])){
    $tid = $_POST['wc_t'];
    require_once('conn.php');
    $stmt = mysqli_prepare($conn,"UPDATE topics SET name=? WHERE toid=?");
    mysqli_stmt_bind_param($stmt,'si',$_POST['t_name'],$tid);
    mysqli_execute($stmt);
    header('location:topics.php?wc_t='.$tid);
    
}
elseif(isset($_POST['assign_teacher']) && isset($_POST['wc_t'])){
    $tid = $_POST['wc_t'];
    require_once('conn.php');
    $stmt = mysqli_prepare($conn,"UPDATE topics SET teacher=? WHERE toid=?");
    mysqli_stmt_bind_param($stmt,'si',$_POST['teachers_box'],$tid);
    mysqli_execute($stmt);

    $topics = [];
    $stmt = mysqli_prepare($conn,"SELECT topics FROM teachers WHERE tid=?");
    mysqli_stmt_bind_param($stmt,'s',$_POST['teachers_box']);
    mysqli_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_row($res)){
        if($row[0]!=''){
            $topics = explode(',',$row[0]);
        }
    }
    $is_in=false;
    foreach($topics as $topic){
        if($topic == $_POST['wc_t']){
            $is_in=true;
            break;
        }
    }
    if(!($is_in)){
        array_push($topics,$_POST['wc_t']);
        $ftopics = implode(',',$topics);

        $stmt = mysqli_prepare($conn,"UPDATE teachers SET topics=? WHERE tid=?");
        mysqli_stmt_bind_param($stmt,'ss',$ftopics,$_POST['teachers_box']);
        mysqli_execute($stmt);
    }

    $stmt = mysqli_prepare($conn,"SELECT tid FROM teachers");
    mysqli_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while($row = mysqli_fetch_row($result)){
        if($row[0]!=$_POST['teachers_box']){
            $t_topics=[];
            $stmt = mysqli_prepare($conn,"SELECT topics FROM teachers WHERE tid=?");
            mysqli_stmt_bind_param($stmt,'s',$row[0]);
            mysqli_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);
            if($r = mysqli_fetch_row($res)){
                if($r[0]!=''){
                    $t_topics = explode(',',$r[0]);
                }
            }
            for($i=0;$i<count($t_topics);$i++){
                if($t_topics[$i]==$_POST['wc_t']){
                    unset($t_topics[$i]);
                    $t_topics = array_values($t_topics);
                }
            }
            $f_topics = implode(',',$t_topics);
            $stmt = mysqli_prepare($conn,"UPDATE teachers SET topics=? WHERE tid=?");
            mysqli_stmt_bind_param($stmt,'ss',$f_topics,$row[0]);
            mysqli_execute($stmt);
        }
    }
    
    header('location:topics.php?wc_t='.$tid);
    
}
else{
    header('location:topics.php');
}

?>
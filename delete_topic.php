<?php
    require_once('auth_teacher.php');
    if(isset($_GET['wc_c'])){
        $topics=[];
        require_once('conn.php');
        $stmt = mysqli_prepare($conn,"SELECT topics FROM course_units WHERE cid=?");
        mysqli_stmt_bind_param($stmt,'i',$_GET['wc_c']);
        mysqli_execute($stmt);
        $result=mysqli_stmt_get_result($stmt);
        if($row = mysqli_fetch_row($result)){
            if($row[0]!=''){
                $topics = explode(',',$row[0]);
            }
        }
        if(isset($_GET['wc_t'])){
            for($i=0;$i<count($topics);$i++){
                if($topics[$i]==$_GET['wc_t']){
                    unset($topics[$i]);
                    $topics = array_values($topics);
                    break;
                }
            }
        }
        else{
            $topics=[];
        }

        $ftopics=implode(',',$topics);
        //echo $ftopics;
        $stmt = mysqli_prepare($conn,"UPDATE course_units SET topics=? WHERE cid=?");
        mysqli_stmt_bind_param($stmt,'si',$ftopics,$_GET['wc_c']);
        mysqli_execute($stmt);
        header('location:acu.php?wc_c='.$_GET['wc_c']);
    }
    else{
        header('location:home.php');
    }

?>
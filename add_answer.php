<?php
    require_once('auth_teacher.php');
    if(isset($_GET['wc_que'])){
        $ans='';
        require_once('conn.php');
        $stmt = mysqli_prepare($conn,"SELECT p_ans FROM questions WHERE queid=?");
        mysqli_stmt_bind_param($stmt,'i',$_GET['wc_que']);
        mysqli_execute($stmt);
        $result=mysqli_stmt_get_result($stmt);
        if($row = mysqli_fetch_row($result)){
            $ans=$row[0];
        }
        $ans= $ans."|&;";
        $stmt = mysqli_prepare($conn,"UPDATE questions SET p_ans=? WHERE queid=?");
        mysqli_stmt_bind_param($stmt,'si',$ans,$_GET['wc_que']);
        mysqli_execute($stmt);
        header('location:editquestion.php?wc_t='.$_GET['wc_t'].'&wc_q='.$_GET['wc_q'].'&wc_qu='.$_GET['wc_que']);
    }
    else{
        echo $_GET['wc_que'];
        header('location:home.php');
    }

?>
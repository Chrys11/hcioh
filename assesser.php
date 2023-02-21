<?php
    if(isset($_GET['wc_t'])){
        $topic = (int) $_GET['wc_t'];
        $student = $_COOKIE['stno'];
        //$today = date("DATE-ATOM");
        $marks = (int) $_COOKIE['wc_m'];
        require_once('conn.php');
        $stmt = mysqli_prepare($conn,"INSERT INTO assesser(student,topic,marks) VALUES(?,?,?)");
        mysqli_stmt_bind_param($stmt,'sii',$student,$topic,$marks);
        mysqli_execute($stmt);
        header('location:work.php');
    }
    else{
        header('location:quiz.php');
    }


?>
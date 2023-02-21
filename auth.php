<?php

if(isset($_POST['signin'])){
    $stno = $_POST['stno'];
    $password = $_POST['password'];
    require_once('conn.php');
    $stmt = mysqli_prepare($conn,"SELECT password FROM students WHERE sid=?");
    mysqli_stmt_bind_param($stmt,'s',$stno);
    mysqli_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_row($result)){
        if($row[0] == $password){
            setcookie('stno',$stno);
            setcookie('upzer','0');
            header("location:home.php");
        }
    }
    else{
        $stmt = mysqli_prepare($conn,"SELECT password FROM teachers WHERE tid=?");
        mysqli_stmt_bind_param($stmt,'s',$stno);
        mysqli_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if($row = mysqli_fetch_row($result)){
            if($row[0] == $password){
                setcookie('stno',$stno);
                setcookie('upzer','1');
                header("location:home.php");
            }
        }
        else{
            $stmt = mysqli_prepare($conn,"SELECT password FROM admins WHERE aid=?");
            mysqli_stmt_bind_param($stmt,'s',$stno);
            mysqli_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_row($result)){
                if($row[0] == $password){
                    setcookie('stno',$stno);
                    setcookie('upzer','2');
                    header("location:home.php");
                }
            }
        }
        setcookie('error',"Wrong Credentials please try again.");
        header("location:home.php");
    }
}
header("location:home.php");
?>
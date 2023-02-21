<?php
require_once('auth_admin.php');
require_once('conn.php');
if(isset($_POST['addteacher'])){
    $stmt = mysqli_prepare($conn,"INSERT INTO teachers(tid,name) VALUES(?,'Default Name')");
    mysqli_stmt_bind_param($stmt,'s',$_POST['t_name']);
    mysqli_execute($stmt);
    header('location:teachers.php?wc_t='.$_POST['t_name']);
}
elseif(isset($_POST['rename_t'])){
    $stmt = mysqli_prepare($conn,"UPDATE teachers SET name=? WHERE tid=?");
    mysqli_stmt_bind_param($stmt,'ss',$_POST['t_name'],$_POST['wc_t']);
    mysqli_execute($stmt);
    header('location:teachers.php?wc_t='.$_POST['wc_t']);
}
elseif(isset($_GET['terminate_t'])){
    $stmt = mysqli_prepare($conn,"DELETE FROM teachers WHERE tid=?");
    mysqli_stmt_bind_param($stmt,'s',$_GET['wc_t']);
    mysqli_execute($stmt);
    header('location:teachers.php');
}
elseif(isset($_POST['changeGender'])){
    $stmt = mysqli_prepare($conn,"UPDATE teachers SET gender=? WHERE tid=?");
    mysqli_stmt_bind_param($stmt,'ss',$_POST['gender'],$_POST['wc_t']);
    mysqli_execute($stmt);
    header('location:teachers.php?wc_t='.$_POST['wc_t']);
}
elseif(isset($_POST['changePassword'])){
    $stmt = mysqli_prepare($conn,"UPDATE teachers SET password=? WHERE tid=?");
    mysqli_stmt_bind_param($stmt,'ss',$_POST['password'],$_POST['wc_t']);
    mysqli_execute($stmt);
    header('location:teachers.php?wc_t='.$_POST['wc_t']);
}
elseif(isset($_GET['removeTopic'])){
    $stmt = mysqli_prepare($conn,"SELECT teacher FROM topics WHERE toid=?");
    mysqli_stmt_bind_param($stmt,'i',$_GET['wc_t']);
    mysqli_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_row($result)){
        if($row == $_GET['wc_te']){
            $stmt = mysqli_prepare($conn,"UPDATE topics SET teacher='' WHERE toid=?");
            mysqli_stmt_bind_param($stmt,'i',$_GET['wc_t']);
            mysqli_execute($stmt);
        }
    }
    header('location:teachers.php?wc_t='.$_GET['wc_te']);
}
else{
    header('location:teachers.php');
}
?>
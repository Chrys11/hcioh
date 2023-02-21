<?php
require_once('auth_admin.php');
require_once('conn.php');
if(isset($_POST['addstudent'])){
    $stmt = mysqli_prepare($conn,"INSERT INTO students(sid,name) VALUES(?,'Default Student')");
    mysqli_stmt_bind_param($stmt,'s',$_POST['s_name']);
    mysqli_execute($stmt);
    header('location:students.php?wc_s='.$_POST['s_name']);
}
elseif(isset($_POST['rename_s'])){
    $stmt = mysqli_prepare($conn,"UPDATE students SET name=? WHERE sid=?");
    mysqli_stmt_bind_param($stmt,'ss',$_POST['s_name'],$_POST['wc_s']);
    mysqli_execute($stmt);
    header('location:students.php?wc_s='.$_POST['wc_s']);
}
elseif(isset($_GET['terminate_s'])){
    $stmt = mysqli_prepare($conn,"DELETE FROM students WHERE sid=?");
    mysqli_stmt_bind_param($stmt,'s',$_GET['wc_s']);
    mysqli_execute($stmt);
    header('location:students.php');
}
elseif(isset($_POST['changeGender'])){
    $stmt = mysqli_prepare($conn,"UPDATE students SET gender=? WHERE sid=?");
    mysqli_stmt_bind_param($stmt,'ss',$_POST['gender'],$_POST['wc_s']);
    mysqli_execute($stmt);
    header('location:students.php?wc_s='.$_POST['wc_s']);
}
elseif(isset($_POST['changeDOB'])){
    $day = $_POST['day'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $dob = "$year-$month-$day";
    $stmt = mysqli_prepare($conn,"UPDATE students SET dob=? WHERE sid=?");
    mysqli_stmt_bind_param($stmt,'ss',$dob,$_POST['wc_s']);
    mysqli_execute($stmt);
    header('location:students.php?wc_s='.$_POST['wc_s']);
}
elseif(isset($_POST['changecu1'])){
    $stmt = mysqli_prepare($conn,"UPDATE students SET cu1=? WHERE sid=?");
    mysqli_stmt_bind_param($stmt,'ss',$_POST['cu'],$_POST['wc_s']);
    mysqli_execute($stmt);
    header('location:students.php?wc_s='.$_POST['wc_s']);
}
elseif(isset($_POST['changecu2'])){
    $stmt = mysqli_prepare($conn,"UPDATE students SET cu2=? WHERE sid=?");
    mysqli_stmt_bind_param($stmt,'ss',$_POST['cu'],$_POST['wc_s']);
    mysqli_execute($stmt);
    header('location:students.php?wc_s='.$_POST['wc_s']);
}
elseif(isset($_POST['changePassword'])){
    $stmt = mysqli_prepare($conn,"UPDATE students SET password=? WHERE sid=?");
    mysqli_stmt_bind_param($stmt,'ss',$_POST['password'],$_POST['wc_s']);
    mysqli_execute($stmt);
    header('location:students.php?wc_s='.$_POST['wc_s']);
}
else{
    header('location:students.php');
}
?>
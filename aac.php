<?php
if(isset($_POST['addcu'])){
    require_once('conn.php');
    $stmt = mysqli_prepare($conn,"INSERT INTO course_units(name,topics) VALUES(?,'1000000')");
    mysqli_stmt_bind_param($stmt,'s',$_POST['cu_name']);
    mysqli_execute($stmt);

    $cid=0;
    $stmt = mysqli_prepare($conn,"SELECT cid FROM course_units WHERE topics='1000000'");
    mysqli_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_row($res)){
        $cid = $row[0];
    }

    $stmt = mysqli_prepare($conn,"UPDATE course_units SET topics='' WHERE cid=?");
    mysqli_stmt_bind_param($stmt,'i',$cid);
    mysqli_execute($stmt);
    header('location:acu.php?wc_c='.$cid);
    
}
elseif(isset($_POST['rename_cu']) && isset($_POST['wc_c'])){
    $cid = $_POST['wc_c'];
    require_once('conn.php');

    $stmt = mysqli_prepare($conn,"UPDATE course_units SET name=? WHERE cid=?");
    mysqli_stmt_bind_param($stmt,'si',$_POST['cu_name'],$cid);
    mysqli_execute($stmt);
    header('location:acu.php?wc_c='.$cid);
    
}
else{
    header('location:topics.php');
}

?>
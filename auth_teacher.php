<?php
if(!(isset($_COOKIE['upzer']))){
    header('location:login.php');
}
$priv = $_COOKIE['upzer'];
if(!($priv >= 1)){
    header('location:home.php');
}
?>
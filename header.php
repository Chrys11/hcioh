<?php
$stno = '';
if(!isset($_COOKIE['stno'])){
    header('location:login.php');
}
$stno = $_COOKIE['stno'];


if(!isset($_COOKIE['location'])){
    setcookie("location","home");
    header("location:home.php");
}
if(!isset($_COOKIE['upzer'])){
    header('location:login.php');
}
$priv = $_COOKIE['upzer'];

$loc = $_COOKIE['location'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard - Elearning HGiOG</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600">
    <!-- https://fonts.google.com/specimen/Open+Sans -->
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="css/fullcalendar.min.css">
    <!-- https://fullcalendar.io/ -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="css/tooplate.css">
</head>

<body id="reportsPage">
    <div class="" id="home">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="navbar navbar-expand-xl navbar-light bg-light">
                        <a class="navbar-brand" href="#">
                            <i class="fas fa-3x fa-tachometer-alt tm-site-icon"></i>
                            <h1 class="tm-site-title mb-0">Dashboard</h1>
                        </a>
                        <button class="navbar-toggler ml-auto mr-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mx-auto">
                                <li class="nav-item">
                                    <a class="nav-link active" href="home.php">Dashboard
                                        <span class="sr-only">(current)</span>
                                    </a>
                                </li>
                                <!--li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Reports
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="#">Daily Report</a>
                                        <a class="dropdown-item" href="#">Weekly Report</a>
                                        <a class="dropdown-item" href="#">Yearly Report</a>
                                    </div>
                                </li-->
                                <?php if($priv=='0'){?>
                                <li class="nav-item">
                                    <a class="nav-link" href="cu.php">Course Units</a>
                                </li>
                                <?php }?>
                                <?php if($priv=='1'){?>
                                <li class="nav-item">
                                    <a class="nav-link" href="topics.php">Topics</a>
                                </li>
                                <?php }?>
                                <?php if($priv=='2'){?>
                                <li class="nav-item">
                                    <a class="nav-link" href="acu.php">Course Units</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="topics.php">Topics</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="teachers.php">Teachers</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="students.php">Students</a>
                                </li>
                                <?php } if($priv=='3'){?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Settings
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="#">Profile</a>
                                        <a class="dropdown-item" href="#">Billing</a>
                                        <a class="dropdown-item" href="#">Customize</a>
                                    </div>
                                </li>
                                <?php }?>
                            </ul>
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link d-flex" href="login.php">
                                        <i class="far fa-user mr-2 tm-logout-icon"></i>
                                        <span>Logout</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
<?php
    session_start();
    if(!$_SESSION['uname']){
        header('Location: ../ADMIN/index.php');
    }
    $base_url = 'http://localhost/finalproject/KITCHEN/';
?>
<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Kitchen Orders</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <!-- Favicon-->
    <link rel="shortcut icon" href="<?php echo "$base_url";?>assets/img/fast_food.jpg">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?php echo "$base_url";?>assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo "$base_url";?>assets/plugins/jquery-ui-1.12.1/jquery-ui.css">
    <!-- Fonts  -->
    <link rel="stylesheet" href="<?php echo "$base_url";?>assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo "$base_url";?>assets/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
    <link rel="stylesheet" href="<?php echo "$base_url";?>assets/plugins/fontawesome-5.3.1-web/css/all.css">
    <link rel="stylesheet" href="<?php echo "$base_url";?>/assets/plugins/fontawesome-5.3.1-web/css/googleapis1.css">
    <link rel="stylesheet" href="<?php echo "$base_url";?>assets/plugins/fontawesome-5.3.1-web/css/googleapis2.css">
    <link rel="stylesheet" href="<?php echo "$base_url";?>assets/css/simple-line-icons.css">
    <!-- CSS Animate -->
    <link rel="stylesheet" href="<?php echo "$base_url";?>assets/css/animate.css">
    <!-- Switchery -->
    <link rel="stylesheet" href="<?php echo "$base_url";?>assets/plugins/switchery/switchery.min.css">
    <!-- DataTables-->
    <link rel="stylesheet" href="<?php echo "$base_url";?>assets/plugins/DataTablesNew/datatables.css">
    <!-- Custom styles for this theme -->
    <link rel="stylesheet" href="<?php echo "$base_url";?>assets/css/main.css">
    <link rel="stylesheet" href="<?php echo "$base_url";?>assets/css/common.css">
    <!--Global JS-->
    <script src="<?php echo "$base_url";?>assets/js/vendor/jquery-1.11.1.min.js"></script>
    <!--jQuery Confirm-->
    <link rel="stylesheet" href="<?php echo "$base_url";?>assets/plugins/jquery-confirm-master/dist/jquery-confirm.min.css" type="text/css"/>
    <!--sweet alert-->
    <link href="<?php echo "$base_url";?>assets/plugins/sweet alert/sweetalert2.css" rel="stylesheet">
    <!--Bootstrap Validator-->
    <link rel="stylesheet" href="<?php echo "$base_url";?>assets/plugins/bsvalidator-master/dist/css/bootstrapValidator.css">
    <!--Slick Carousel-->
    <link rel="stylesheet" type="text/css" href="<?php echo "$base_url";?>assets/plugins/slick-carousel/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo "$base_url";?>assets/plugins/slick-carousel/slick/slick-theme.css"/>
    <!-- bootstrap datetimepicker -->
    <link rel="stylesheet" href="<?php echo "$base_url";?>assets/plugins/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="<?php echo "$base_url";?>assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Daterange -->
    <link rel="stylesheet" href="<?php echo "$base_url";?>assets/plugins/bootstrap-daterangepicker/daterangepicker.css">
    <style>
        .footer {
            position: fixed;
            /*left: 250px;*/
            bottom: 0;
            height: 40px;
            width: 100%;
            background-color: #bfc3c5;
            color: #000;
            text-align: center;
            font-size: 12pt;
        }
        @keyframes fadeItCount {
            0%   { color: #e6e6e6; }
            50%  { color: red; }
            100%  { color: #e6e6e6; }
        }

        .animateCount{
            background-image:none !important;
            animation: fadeItCount 3s ease-in-out infinite;
        }
        .notifyText{
            font-size: 14pt;
            color: #3e3e3e;
            font-weight: normal;
        }
    </style>

</head>

<body>
<section id="main-wrapper" class="theme-default">
    <header id="header">
        <!--logo start-->
        <div class="brand">
            <a href="kitchenMain.php" style="text-align: center;"><h2 style="color: white; padding-top: 20px;">Eats</h2></a>
        </div>
        <!--logo end-->
        <ul class="nav navbar-nav navbar-left">
            <li class="toggle-profile toggle-navigation toggle-left">
                <a href="kitchenMain.php" style="color: black; margin-top: 5px;"><span class="icon"><i class="fas fa-home"></i></span> Home</a>
            </li>
            <li class="toggle-profile toggle-navigation toggle-left">
                <a href="foodManage.php" style="color: black; margin-top: 5px;"><span class="icon"><i class="fas fa-utensils"></i></span> Manage Food</a>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown profile hidden-xs" id="drop">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="meta">
                        Welcome! <?php echo($_SESSION['uname']);?>
                    </span>
                </a>
            </li>
            <li class="toggle-navigation profile toggle-right">
                <a href="logout.php"><span class="icon"><i class="fas fa-sign-out-alt"></i></span>Logout</a>
            </li>
            <li style="width: 10px;"></li>
        </ul>
    </header>
    <!--main content start-->
    <section class="main-content-wrapper">
        <section id="main-content" class="animated fadeInUp">
            <div class="row">
                <div class="col-md-12 col-lg-12">
<?php
    session_start();
    if(!$_SESSION['uname']){
        header('Location: ../ADMIN/index.php');
    }
    $base_url = 'http://localhost/finalproject/WAITER/';

    include_once("process/food.php");
    $food = new food();
    $sql = "SELECT food_offer.*, food_menu.fname
            FROM food_offer
            JOIN food_menu ON food_offer.fid = food_menu.fid";
    $res = $food->db->query($sql);
?>
<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Restaurant Menu</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <!-- Favicon-->
    <link rel="shortcut icon" href="<?php echo "$base_url";?>assets/img/fav.png">
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
            /*position: fixed;*/
            /*left: 250px;*/
            bottom: 0;
            height: 40px;
            width: 100%;
            background-color: aliceblue;
            color: #000;
            text-align: center;
            font-size: 12pt;
        }
    </style>
    <link rel="icon" href="uploads/foods/1109.jpg">
</head>

<body>
<section id="main-wrapper" class="theme-default" >
    <header id="header" style="width: 100%;">
        <!--logo start-->
        <div class="brand" style="width: 15%">
            <a href="waiterMain.php" style="text-align: center;"><h1 style="color: white; padding-top: 10px; font-family: Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana,' sans-serif';">Eats</h1></a>
        </div>
        <!--logo end-->
        <ul class="nav navbar-nav navbar-left">
            <li class=" toggle-left" style="font-family: Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana,' sans-serif'; font-size: 15px;">
                <a href="waiterMain.php" style="color: black; margin-top: 5px;"><span class="icon"><i class="fas fa-home"></i></span> <b>Home</b></a>
            </li>
            <li class="toggle-profile toggle-navigation toggle-left" style="font-family: Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana,' sans-serif'; font-size: 15px;">
                <a href="orderManage.php" style="color: black; margin-top: 5px;"><span class="icon"><i class="fas fa-list-alt"></i></span> <B>Orders</B></a>
            </li>
            <li class="dropdown profile hidden-xs" id="drop" style="font-family: Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana,' sans-serif'; font-size: 15px;">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="background-color: #e00047">
                    <span class="meta">
                        <span class="icon"><i class="fas fa-money"></i> <b>Offers</b></span>
                        <span class="caret"></span>
                    </span>
                </a>
                <ul class="dropdown-menu animated fadeInRight" role="menu" style="background-color: #fff;">
                    <li class="divider"></li>
                    <?php while($foffer = mysqli_fetch_assoc($res)) : ?>
                        <li style="margin-left: 10px;">
                            <span><?php echo $foffer['fname']; ?> <?php echo $foffer['discount']; ?>% off</span>
                        </li>
                        <li class="divider"></li>
                    <?php endwhile; ?>
                </ul>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-right" style="font-family: Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana,' sans-serif'; font-size: 15px;">
            <li class="toggle-navigation profile toggle-right" id="drop" >
                <a> 
                    <span class="meta">
                        <b>Welcome!</b>&nbsp; <?php echo($_SESSION['uname']);?>
                    </span>
                </a>
            </li>
            <li class="toggle-navigation profile toggle-right" >
                <a href="logout.php" style="color: firebrick;"><span class="icon"><i class="fas fa-sign-out-alt"></i></span>Logout</a>
            </li>
        </ul>
    </header>
    <!--main content start-->
    <section class="main-content-wrapper">
        <section id="main-content" class="animated fadeInUp">
            <div class="row">
                <div class="col-md-12 col-lg-12">
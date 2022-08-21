<?php

include 'config.php';

session_start();
//include 'library/validationSession.php';
if(!isset($_SESSION['ValidationAdmin'])){
  header("location: login.php");
}


if(isset($_SESSION['Validation'])){
  header("Location: logout.php");

}
// get user id from nCode
//----------------------
$adminUserName=$_SESSION['adminUserName'];
$query = "SELECT id FROM `admin` WHERE `username`='$adminUserName'";
$result = mysqli_query($conn,$query);
if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $user_id = $row["id"];
    }
}



// get user id from nCode
//----------------------
$adminUserName=$_SESSION['adminUserName'];
$query = "SELECT profilePicture FROM `admin` WHERE `username`='$adminUserName'";
$result = mysqli_query($conn,$query);
if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $profilePicture = $row["profilePicture"];
    }
}


      
        // get user id from nCode
        //----------------------
       
        $query = "SELECT `name`,lName FROM `admin` WHERE `username`='$adminUserName'";
        $result = mysqli_query($conn,$query);
        if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $name = $row["name"];
                $lname = $row["lName"];
                $nameLname = $name." ".$lname;
               // echo iconv("UTF-8", "ISO-8859-1", $nameLname);
            }
        }

        
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>پنل مدیریت | داشبورد اول</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- Admin Theme style -->
    <link rel="stylesheet" href="../dist/css/admin.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="../plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- bootstrap rtl -->
    <link rel="stylesheet" href="../dist/css/bootstrap-rtl.min.css">
    <!-- template rtl version -->
    <link rel="stylesheet" href="../dist/css/custom-style.css">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="index.php" class="nav-link">خانه</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="mailto://aref@post.ir" class="nav-link">تماس</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="logout.php" class="nav-link">خروج</a>
            </li>
        </ul>

        <!-- SEARCH FORM -->
        <form class="form-inline ml-3">
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="جستجو" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>

        <!-- Right navbar links -->
        <ul class="navbar-nav mr-auto">
                   
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell-o"></i>
                    <span class="badge badge-warning navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
                    <span class="dropdown-item dropdown-header">15 نوتیفیکیشن</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fa fa-envelope ml-2"></i> 4 پیام جدید
                        <span class="float-left text-muted text-sm">3 دقیقه</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fa fa-users ml-2"></i> 8 درخواست ها
                        <span class="float-left text-muted text-sm">12 ساعت</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fa fa-file ml-2"></i> 3 گزارش جدید
                        <span class="float-left text-muted text-sm">2 روز</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">مشاهده همه نوتیفیکیشن</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
                        class="fa fa-th-large"></i></a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            <img src="../dist/img/bank-flat.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">پنل مدیریت</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar" style="direction: ltr">
            <div style="direction: rtl">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">

                        <img src="<?php echo $profilePicture; ?>" class="img-rounded elevation-3" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"> <?php
                            // get user id from nCode
                            //----------------------
                            $adminUserName=$_SESSION['adminUserName'];
                            $query = "SELECT `name`,lName FROM `admin` WHERE `username`='$adminUserName'";
                            $result = mysqli_query($conn,$query);
                            if(mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    $name = $row["name"];
                                    $lname = $row["lName"];
                                    echo $name." ".$lname;
                                }
                            }

                            ?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                             with font-awesome or any other icon font library -->
                        <li class="nav-item has-treeview">
                            <a href="<?php  echo $Domain;?>/dept/admin" class="nav-link <?php if (basename($_SERVER['PHP_SELF'])=='index.php'){ echo 'active';} ?>">
                                <i class="nav-icon fa fa-dashboard"></i>
                                <p>
                                    داشبورد
                                    <!--i class="right fa fa-angle-left"></i-->
                                </p>
                            </a>

                        </li>
                        <li class="nav-item">
                            <a href="allDebts.php" class="nav-link <?php if (basename($_SERVER['PHP_SELF'])=='depts.php'){ echo 'active';} ?>">
                                <i class="nav-icon fa fa-th"></i>
                                <p>
                                    همه ی وام ها

                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="ticketList.php" class="nav-link <?php if (basename($_SERVER['PHP_SELF'])=='ticket.php'){ echo 'active';} ?>">
                                <i class="nav-icon fa fa-envelope-o"></i>
                                <p>
                                    تیکت
                                    
                                </p>
                            </a>
                            
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="statusDebts.php" class="nav-link <?php if (basename($_SERVER['PHP_SELF'])=='payment.php'){ echo 'active';} ?>">
                                <i class="nav-icon fa fa-pie-chart"></i>
                                <?php
                                    $query= "SELECT * FROM `dept` WHERE `status` = '2'";
                                    $result = mysqli_query($conn,$query);
                                    $countOfStatus2 = mysqli_num_rows($result);

                                ?>
                                <p>
                                    برسی وام ها
                                    <span class="right badge badge-danger"><?php  echo($countOfStatus2); ?></span>
                                </p>
                            </a>

                        
                        <li class="nav-item has-treeview">
                            <a href="AddAdmin.php" class="nav-link">
                                <i class="nav-icon fa fa-user"></i>
                                <p>
                                    اضافه کردن ادمین جدید
                                  
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">اطلاعات</li>
                        <li class="nav-item">
                            <a href="https://github.com/DeAref" class="nav-link">
                                <i class="nav-icon fa fa-connectdevelop"></i>
                                <p>
                                    برنامه نویس

                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-github"></i>
                                <p>
                                    گیت هاب

                                </p>
                            </a>

                        </li>
                        <li class="nav-item has-treeview">
                            <a href="https://t.me/deAref" class="nav-link">
                                <i class="nav-icon fa fa-send"></i>
                                <p>
                                    تماس با ما

                                </p>
                            </a>

                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-book"></i>
                                <p>
                                    درباره این پروژه

                                </p>
                            </a>
                           
                        </li>
                        <li class="nav-header">متفاوت</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-file"></i>
                                <p>مستندات</p>
                            </a>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
        </div>
        <!-- /.sidebar -->
    </aside>
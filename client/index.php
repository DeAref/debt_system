<?php
session_start();
include '../library/header.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">داشبورد</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">خانه</a></li>
                        <li class="breadcrumb-item active">داشبورد</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <?php
                            // get user all debts
                            //----------------------
                            $sumDeptValue = 0;
                            $stmt = mysqli_prepare($conn, "SELECT SUM(deptValue) as total FROM `dept` WHERE `user_id`=?");
                            mysqli_stmt_bind_param($stmt, "i", $user_id);
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);
                            $row = mysqli_fetch_assoc($result);
                            
                            if($row["total"] > 0) {
                                $sumDeptValue = $row["total"];
                            }
                            ?>
                            <h4><?php echo number_format($sumDeptValue)." تومان"; ?></h4>
                            <p>کل پول وام های شما</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-cash"></i>
                        </div>
                        <a href="depts.php" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <?php
                            // get count of dept
                            //----------------------
                            $stmt = mysqli_prepare($conn, "SELECT COUNT(id) as count FROM `dept` WHERE `user_id`=?");
                            mysqli_stmt_bind_param($stmt, "i", $user_id);
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);
                            $row = mysqli_fetch_assoc($result);
                            $countOfdept = $row["count"];
                            ?>
                            <h3><?php echo $countOfdept; ?></h3>
                            <p>تعداد وام ها</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-clipboard"></i>
                        </div>
                        <a href="depts.php" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <?php
                            // get user payment statistics
                            //----------------------
                            $stmt = mysqli_prepare($conn, "SELECT SUM(payed) as totalPayed, SUM(monthCount) as totalMonth FROM `dept` WHERE `user_id`=?");
                            mysqli_stmt_bind_param($stmt, "i", $user_id);
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);
                            $row = mysqli_fetch_assoc($result);
                            
                            $sumPayed = $row["totalPayed"] ?? 0;
                            $sumMonthCount = $row["totalMonth"] ?? 0;
                            ?>
                            <h3><?php 
                            if($sumMonthCount > 0) { 
                                echo round(($sumPayed*100)/$sumMonthCount); 
                            } else {
                                echo "0";
                            }  
                            ?><sup style="font-size: 20px">%</sup></h3>
                            <p>اقساط پرداخت شده</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="payment.php" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <?php
                            $stmt = mysqli_prepare($conn, "SELECT SUM(unPayed) as totalUnPayed FROM `dept` WHERE `user_id`=?");
                            mysqli_stmt_bind_param($stmt, "i", $user_id);
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);
                            $row = mysqli_fetch_assoc($result);
                            $sumUnPayed = $row["totalUnPayed"] ?? 0;
                            ?>
                            <h3><?php echo $sumUnPayed; ?><sup style="font-size: 20px">ماه</sup></h3>
                            <p>کل اقساط مانده</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="payment.php" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            
            <!-- Info Box -->
            <div class="row">
                <div class="col-md-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="ion ion-information-circled"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">اطلاعات مهم</span>
                            <span class="info-box-number">برای مشاهده جزئیات وام‌ها به صفحه وام‌ها مراجعه کنید</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
include '../library/footer.php';
?>
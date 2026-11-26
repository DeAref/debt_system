<?php
session_start();
include '../library/header.php';

// Get user statistics using prepared statements
$stmt = $conn->prepare("SELECT 
    COALESCE(SUM(d.deptValue), 0) as totalDept,
    COUNT(d.id) as debtCount,
    COALESCE(SUM(d.payed), 0) as totalPayed,
    COALESCE(SUM(d.monthCount), 0) as totalMonthCount,
    COALESCE(SUM(d.unPayed), 0) as totalUnPayed
FROM dept d 
WHERE d.user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stats = $stmt->get_result()->fetch_assoc();

$totalDept = $stats['totalDept'];
$debtCount = $stats['debtCount'];
$paymentPercentage = ($stats['totalMonthCount'] > 0) ? round(($stats['totalPayed'] * 100) / $stats['totalMonthCount']) : 0;
$totalUnPayed = $stats['totalUnPayed'];
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
                            <h4><?php echo number_format($totalDept) . " تومان"; ?></h4>
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
                            <h3><?php echo $debtCount; ?></h3>
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
                            <h3><?php echo $paymentPercentage; ?><sup style="font-size: 20px">%</sup></h3>
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
                            <h3><?php echo $totalUnPayed; ?><sup style="font-size: 20px">ماه</sup></h3>
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
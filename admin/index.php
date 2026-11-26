<?php
include 'header.php';
include 'functions.php';

$allDebt = getAllDebtsSum($conn);
$allPayed = getAllPaidAmounts($conn);
$allIds = getTotalDebtsCount($conn);
$allIdsActive = getActiveDebtsCount($conn);
$userCount = getUserCount($conn);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">داشبورد ادمین</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">خانه</a></li>
                        <li class="breadcrumb-item active">داشبورد ادمین</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fa fa-gear"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">مقدار استفاده از RAM</span>
                            <span class="info-box-number" dir="ltr" align="left">
                                <?php  
                                include '../library/resource_usage.php';
                                $result = getServerMemoryUsage();
                                $total = $result['total'];
                                echo $total;
                                ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="ion ion-pie-graph"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">فضای آزاد سرور</span>
                            <span class="info-box-number">
                                <?php echo formatSizeUnits(disk_free_space("/")); ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="ion ion-android-cloud-outline"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">کل حافظه سرور</span>
                            <span class="info-box-number">
                                <?php echo formatSizeUnits(disk_total_space("/")); ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">کاربران</span>
                            <span class="info-box-number">
                                <?php
                                $stmt = mysqli_prepare($conn, "SELECT * FROM `user`");
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);
                                echo mysqli_num_rows($result);
                                ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">آمار کلی وام‌ها</h5>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-widget="collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-widget="remove">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="chart">
                                        <canvas id="salesChart" height="180" style="height: 180px;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-3 col-6">
                                    <div class="description-block border-right">
                                        <span class="description-percentage text-success">
                                            <i class="fa fa-caret-up"></i> 17%
                                        </span>
                                        <h5 class="description-header">تومان <?php echo number_format($allDebt); ?></h5>
                                        <span class="description-text">کل وام‌ها</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                
                                <div class="col-sm-3 col-6">
                                    <div class="description-block border-right">
                                        <span class="description-percentage text-warning">
                                            <i class="fa fa-caret-left"></i> 0%
                                        </span>
                                        <h5 class="description-header">تومان <?php echo number_format($allPayed); ?></h5>
                                        <span class="description-text">بازپرداختی‌ها</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                
                                <div class="col-sm-3 col-6">
                                    <div class="description-block border-right">
                                        <span class="description-percentage text-success">
                                            <i class="fa fa-caret-up"></i> 20%
                                        </span>
                                        <h5 class="description-header"><?php echo $allIds; ?></h5>
                                        <span class="description-text">تعداد کل وام‌ها</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                
                                <div class="col-sm-3 col-6">
                                    <div class="description-block">
                                        <span class="description-percentage text-danger">
                                            <i class="fa fa-caret-down"></i> 18%
                                        </span>
                                        <h5 class="description-header"><?php echo $allIdsActive; ?></h5>
                                        <span class="description-text">وام‌های تایید شده</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Main row -->
            <div class="row">
                <!-- TABLE: LATEST ORDERS -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">آخرین وام‌ها</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-widget="collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-widget="remove">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0">
                                    <thead>
                                        <tr>
                                            <th>کد وام</th>
                                            <th>نام متقاضی</th>
                                            <th>مقدار وام</th>
                                            <th>تاریخ دریافت</th>
                                            <th>تعداد اقساط</th>
                                            <th>اقساط پرداخت شده</th>
                                            <th>اقساط مانده</th>
                                            <th>وضعیت</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // List of debts 
                                        //----------------------
                                        $counter = 0;
                                        $stmt = mysqli_prepare($conn, "SELECT dept.`id`,`deptValue`,`date`,`status`,`monthCount`,`unPayed`,`payed`,`user`.`name` FROM dept INNER JOIN `user` ON dept.user_id=user.id ORDER BY `dept`.`date` DESC");
                                        mysqli_stmt_execute($stmt);
                                        $result = mysqli_stmt_get_result($stmt);
                                        
                                        if(mysqli_num_rows($result) > 0) {
                                            while($counter < 6 && $row = mysqli_fetch_assoc($result)) {
                                                $counter++;
                                                $id = $row["id"];
                                                $deptValue = number_format($row["deptValue"]);
                                                $date = $row["date"];
                                                $status = $row["status"];
                                                $monthCount = $row["monthCount"];
                                                $name = $row["name"];
                                                $unPayed = $row["unPayed"];
                                                $payed = $row["payed"];
                                                
                                                if ($status == 0) {
                                                    $resultStatus = "رد شد";
                                                    $colorStatus = "badge-danger";
                                                } elseif ($status == 1) {
                                                    $resultStatus = "تایید شده";
                                                    $colorStatus = "badge-success";
                                                } else {
                                                    $resultStatus = "درحال بررسی";
                                                    $colorStatus = "bg-primary";
                                                }
                                                
                                                echo "<tr>
                                                    <td>$id</td>
                                                    <td>$name</td>
                                                    <td>$deptValue</td>
                                                    <td>$date</td>
                                                    <td>$monthCount</td>
                                                    <td>$payed</td>
                                                    <td>$unPayed</td>
                                                    <td><span class='badge $colorStatus'>$resultStatus</span></td>
                                                </tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='8' class='text-center'>هیچ وامی ثبت نشده است.</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <a href="statusDebts.php" class="btn btn-sm btn-info float-left">تایید و رد</a>
                            <a href="allDebts.php" class="btn btn-sm btn-secondary float-right">مشاهده همه وام‌ها</a>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
include 'footer.php';
?>
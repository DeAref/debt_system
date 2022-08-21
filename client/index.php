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
                            <li class="breadcrumb-item active">داشبورد ورژن 2</li>
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
                                $query = "SELECT deptValue FROM `dept` WHERE `user_id`='$user_id'";
                                $result = mysqli_query($conn,$query);
                                if(mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_assoc($result)) {
                                        $deptValue = $row["deptValue"];
                                        $sumDeptValue = $deptValue + $sumDeptValue;
                                    }

                                }else{
                                   echo "شما هیچ وامی ندارید";
                                }

                                ?>
                                <h4><?php echo $sumDeptValue."تومان"; ?></h4>

                                <p>کل پول وام های شما</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-cash"></i>
                            </div>
                            <a href="#" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
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
                                $query = "SELECT id FROM `dept` WHERE `user_id`='$user_id'";
                                $result = mysqli_query($conn,$query);
                                $countOfdept = mysqli_num_rows($result);

                                ?>
                                <h3><?php echo $countOfdept; ?> </h3>

                                <p>تعداد وام ها</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-clipboard"></i>
                            </div>
                            <a href="#" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->

                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <?php

                                // get user id from nCode
                                //----------------------
                                $query = "SELECT payed,monthCount FROM `dept` WHERE `user_id`='$user_id'";
                                $result = mysqli_query($conn,$query);
                                if(mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_assoc($result)) {
                                        $payed = $row["payed"];
                                        $monthCount = $row["monthCount"];
                                        $sumPayed = $sumPayed + $payed;
                                        $sumMonthCount = $sumMonthCount + $monthCount;
                                    }

                                }else{echo "شما وامی نگرفته اید";}

                                ?>
                                <h3><?php if(mysqli_num_rows($result) > 0) { echo (round(($sumPayed*100)/$sumMonthCount)); }else{echo "0";}  ?><sup style="font-size: 20px">%</sup></h3>

                                <p>اقساط پرداحت شده</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="#" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">

                        <div class="small-box bg-danger">
                            <div class="inner">
                                <?php
                                $sumMonthCount = 0 ;
                                // get user id from nCode
                                //----------------------
                                $query = "SELECT unPayed FROM `dept` WHERE `user_id`='$user_id'";
                                $result = mysqli_query($conn,$query);
                                if(mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_assoc($result)) {
                                        $unPayed = $row["unPayed"];
                                        $sumUnPayed = $sumUnPayed + $unPayed;
                                    }
                                }else{
                                   echo "شما وامی ندارید.";
                                }

                                ?>
                                <h3><?php echo $sumUnPayed; ?><sup style="font-size: 20px">ماه</sup></h3>

                                <p>کل اقساط مانده</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="#" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
                <!-- Main row -->
            
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">جدول وام ها</h3>

                                        <div class="card-tools">
                                            <div class="input-group input-group-sm" style="width: 150px;">
                                                <input type="text" name="table_search" class="form-control float-right" placeholder="جستجو">

                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover">
                                            <tr>
                                                <th>کد</th>
                                                <th>مقدار وام</th>
                                                <th>تاریخ</th>
                                                <th>وضعیت</th>
                                                <th>تعداد اقساط</th>
                                            </tr>
                                            <?php
                                            // get user id from nCode
                                            //----------------------

                                            $query = "SELECT `id`,`deptValue`,`date`,`status`,`monthCount` FROM `dept` WHERE `user_id`='$user_id'";
                                            $result = mysqli_query($conn,$query);
                                            if(mysqli_num_rows($result) > 0) {
                                                while($row = mysqli_fetch_assoc($result)) {
                                                    $id = $row["id"];
                                                    $deptValue = $row["deptValue"];
                                                    $date = $row["date"];
                                                    $status = $row["status"];
                                                    $monthCount = $row["monthCount"];
                                                    if ($status==0){$resultStatus="رد شد";$colorStatus="badge-danger";}elseif ($status==1){$resultStatus="تایید شده";$colorStatus="badge-success";}else{$resultStatus="درحال برسی";$colorStatus="bg-primary";}
                                                    echo ("<tr>
                                                <td>$id</td>
                                                <td>$deptValue</td>
                                                <td>$date</td>
                                                <td><span class='badge $colorStatus'>$resultStatus</span></td>
                                                <td>$monthCount</td>
                                            </tr>");
                                                }
                                            }else{
                                                echo "تعداد وام های شما صفر است .";
                                            }

                                            ?>

                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            <!-- /div -->
                        <!-- /div --><!-- /.row -->



                            <div class="card-body p-0">
                                <!--The calendar -->
                                <div id="calendar" style="width: 100%"></div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </section>
                    <!-- right col -->
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
<?php
include '../library/footer.php';
?>
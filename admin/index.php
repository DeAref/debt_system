
<?php

include 'header.php';


                                
// all of debt
//----------------------

$query = "SELECT SUM(`deptValue`) as `allDebts` FROM `dept`";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($result);
if( $row["allDebts"] > 0) {
  $allDebt = $row["allDebts"];
}else{
   $allDebt =  "شما وامی ندارید.";
}

// all of debt is paid
//----------------------
$allPayed = 0;
$query = "SELECT amountPerMonth,payed FROM `dept`";
$result = mysqli_query($conn,$query);
if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $payedInWhile = $row["payed"];
        $amountPerMonthInWhile = $row['amountPerMonth'];
        $allPayed = $allPayed + ($payedInWhile * $amountPerMonthInWhile);
    }
}else{
   $allPayed =  "شما وامی ندارید.";
}


// count of debt
//----------------------
$query = "SELECT COUNT(`id`) AS `ids` FROM dept;";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($result);
$allIds = $row['ids'];


//count of debts if active 
//......................./
$query = "SELECT COUNT(`id`) AS `ids` FROM dept WHERE `status`=1;";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($result);
$allIdsActive = $row['ids'];


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
                <span class="info-box-text">مقدار استفاده ار RAM</span>
                <span class="info-box-number" dir="ltr" align="left">
                  <?php  include '../library/resource_usage.php';
                  $result = getServerMemoryUsage();
                  $total = $result['total'];
                  echo $total;
                  ?>
                  <small></small>
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
                <span class="info-box-text">مقدار باقی مانده از حافظه </span>
                <span class="info-box-number"><?php  
                // $dat = getrusage();
                // echo $dat["ru_stime.tv_usec"]; // system time used (microseconds) 
                echo formatSizeUnits(disk_free_space("/"));
                ?></span>
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
                <span class="info-box-number"><?php  echo formatSizeUnits(disk_total_space("/")); ?></span>
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
                <span class="info-box-text">اعضا</span>
                <span class="info-box-number">
                <?php

                    $conn=mysqli_connect($host, $usernameDBmySql, $passwordDBmySql,$databaseNameMysql);

                    $query = "SELECT * FROM `user`";
                    $result = mysqli_query($conn,$query);
                    echo (mysqli_num_rows($result)); 
                //------------------- test
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
                <h5 class="card-title">گزارش هفتگی</h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse">
                    <i class="fa fa-minus"></i>
                  </button>
                  <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-wrench"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-left" role="menu">
                      <a href="#" class="dropdown-item">منو اول</a>
                      <a href="#" class="dropdown-item">منو دوم</a>
                      <a href="#" class="dropdown-item">منو سوم</a>
                      <a class="dropdown-divider"></a>
                      <a href="#" class="dropdown-item">لینک</a>
                    </div>
                  </div>
                  <button type="button" class="btn btn-tool" data-widget="remove">
                    <i class="fa fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div >
                  <!--div class="col-md-8"-->
                    <p class="text-center">
                      <strong>فروش ۱ دی ۱۳۹۷</strong>
                    </p>

                    <div class="chart">
                      <!-- Sales Chart Canvas -->
                      <canvas id="salesChart" height="180" style="height: 180px;"></canvas>
                    </div>
                    <!-- /.chart-responsive -->
                  <!--/div-->
                  <!-- /.col -->
                  
                      
                  
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- ./card-body -->
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">

                

                      <span class="description-percentage text-success"><i class="fa fa-caret-up"></i> 17%</span>
                      <h5 class="description-header">تومان <?php  echo(number_format($allDebt)); ?></h5>
                      <span class="description-text">کل وام ها </span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-warning"><i class="fa fa-caret-left"></i> 0%</span>
                      <h5 class="description-header">تومان <?php  echo(number_format($allPayed)); ?></h5>
                      <span class="description-text"> بازپرداختی ها</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-success"><i class="fa fa-caret-up"></i> 20%</span>
                      <h5 class="description-header"><?php  echo $allIds; ?></h5>
                      <span class="description-text">تعداد کل وام ها </span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block">
                      <span class="description-percentage text-danger"><i class="fa fa-caret-down"></i> 18%</span>
                      <h5 class="description-header"><?php  echo($allIdsActive); ?></h5>
                      <span class="description-text">وام های تایید شده</span>
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
        
        
            <!-- TABLE: LATEST ORDERS -->
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">آخرین سفارشات</h3>

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
                      <th>ای دی محصول</th>
                      <th>نام متقاضی</th>
                      <th>مقدار وام</th>
                      <th>تاریخ دریافت</th>
                      <th>تعداد اقساط</th>
                      <th> اقساط پرداخت شده</th>
                      <th>اقساط مانده </th>
                      <th>وضعیت</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                      // list of debts 
                      //----------------------
                      $counter = 0;
                      $query = "SELECT dept.`id`,`deptValue`,`date`,`status`,`monthCount`,`unPayed`,`payed`,`user`.`name` FROM dept INNER JOIN `user` ON dept.user_id=user.id ORDER BY `dept`.`date` DESC";
                      $result = mysqli_query($conn,$query);
                      if(mysqli_num_rows($result) > 0) {
                          while($counter < 6) {
                            $row = mysqli_fetch_assoc($result);
                            $counter ++;
                            $id = $row["id"];
                            $deptValue = $row["deptValue"];
                            $date = $row["date"];
                            $status = $row["status"];
                            $monthCount = $row["monthCount"];
                            $name = $row["name"];
                            $unPayed = $row["unPayed"];
                            $payed = $row["payed"];
                            if ($status==0){$resultStatus="رد شد";$colorStatus="badge-danger";}elseif ($status==1){$resultStatus="تایید شده";$colorStatus="badge-success";}else{$resultStatus="درحال برسی";$colorStatus="bg-primary";}
                            echo ("<tr>
                          <td>$id</td>
                          <td>$name</td>
                          <td>$deptValue</td>
                          <td>$date</td>
                          <td>$monthCount</td>
                          <td>$payed</td>
                          <td>$unPayed</td>
                          <td><span class='badge $colorStatus'>$resultStatus</span></td>
                      </tr>");
                          }
                      }else{
                          echo "تعداد وام های شما صفر است .";
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
                <a href="allDebts.php" class="btn btn-sm btn-secondary float-right">مشاهده همه وام ها</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          
          <!-- /.col -->

          </div>
          <!-- /.col -->
        
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  
<?php
include 'footer.php';
?>
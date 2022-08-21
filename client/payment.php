<?php
include '../library/config.php';
session_start();
// get user id from nCode
//----------------------
$nCode=$_SESSION['nCode'];
$query = "SELECT id FROM `user` WHERE `nCode`='$nCode'";
$result = mysqli_query($conn,$query);
if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $user_id = $row["id"];
    }
}

// get amountpermonth by user id
//----------------------
$sumAmountPerMonth = 0;
$query = "SELECT amountPerMonth FROM `dept` WHERE `user_id`='$user_id' AND `status` NOT IN(0,2)";
$result = mysqli_query($conn,$query);
if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $amountPerMonth = $row["amountPerMonth"];
        $sumAmountPerMonth = $sumAmountPerMonth + $amountPerMonth;
    }
}



include '../library/header.php';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">

            <div class="card">
                <div class="card-header">
                <div class='callout callout-success'>برای پرداخت اقساط ، وام مورد نظر را از لیست زیر انتخاب کنید</div>
                    <h3 class="card-title">وام های شما که تایید شده اند</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-condensed table-hover">
                        <tbody><tr>
                            <th style="width: 10px">#</th>
                            <th>وام</th>
                            <th>مانده</th>
                            <th>پرداختی</th>
                            <th style="width: 40px">درصد</th>
                        </tr>



                        <?php


                        // get amountpermonth by user id
                        //----------------------
                        $darsadColor = "bg-primary";
                        $sumPayed = 0;
                        $sumMonthCount =0;
                        $query = "SELECT id,deptValue,payed,monthCount,amountPerMonth FROM `dept` WHERE `user_id`='$user_id' AND `status` NOT IN(0,2)";
                        $result = mysqli_query($conn,$query);
                        if(mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                $deptValue = $row["deptValue"];
                                $id = $row["id"];
                                $payed = $row["payed"];
                                $amountPerMonth = $row["amountPerMonth"];
                                $monthCount = $row["monthCount"];
                                // درصد پرداختی ها
                                $darsad = round(($payed*100)/$monthCount);
                                // مانده
                                $remaining = $deptValue-($amountPerMonth*$payed);
                                //تا کنون چقدر پرداخت شده
                                $Paid = ($amountPerMonth*$payed);
                                //سه رقم سه رقم جدا میکنه
                                $resultRemaining = number_format($remaining);
                                $resultDeptValue = number_format($deptValue);
                                $Paid = number_format($Paid);
                                if($darsad<=25){$darsadColor = "progress-bar-danger";}elseif ($darsad<=50 && $darsad>25){$darsadColor = "bg-warning";}elseif ($darsad<=75 && $darsad>50){$darsadColor = "bg-primary";}elseif($darsad<=100 && $darsad>75){$darsadColor = "bg-success";}
                               echo ("
                                    <script type = 'text/javascript'>
                                        function href$id() {
                                            location.href='invoce.php?dept_id=$id';
                                        }
                                    </script>
                                    <tr onclick='href$id()'>
                                        <td>$id</td>
                                        <td>$resultDeptValue</td>
                                        <td>$resultRemaining</td>
                                        <td>
                                        $Paid
                                            <div class='progress progress-xs'>
                                                <div class='progress-bar $darsadColor' style='width:$darsad%'></div>
                                            </div>
                                        </td>
                                        <td><span class='badge $darsadColor'>$darsad%</span></td>
                                        
                                    </tr>
                                ");
                            }
                        }else{
                            echo "تعداد وام های تایید شده ی شما 0 میباشد";
                        }

                        ?>

                        </tbody></table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </section>

    <!-- *********************
    start invocs
    */  -->
    <section class="content-header">
        <div class="container-fluid">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">فاکتور ها  </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-condensed table-hover">
                        <tbody><tr>
                            <th style="width: 10px">#</th>
                            <th>کد فاکتور</th>
                            <th>شماره وام </th>
                            <th>تاریخ</th>
                            <th>مبلغ</th>
                            <th>وضعیت</th>
                        </tr>



                        <?php


                        // get amountpermonth by user id
                        //----------------------
                        $darsadColor = "bg-primary";
                        $sumPayed = 0;
                        $sumMonthCount =0;
                        $query = "SELECT id,paymentCode,dept_id,`date`,price,paid FROM `payment` WHERE `user_id`='$user_id'";
                        $result = mysqli_query($conn,$query);
                        if(mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                
                                $id_invoce = $row["id"];
                                $paymentCode = $row["paymentCode"];
                                $date = $row["date"];
                                $price = $row["price"];
                                $paid = $row["paid"];
                                $dept_id = $row["dept_id"];

                                if($paid == 0){$paidColor = "bg-primary";}if ($paid == 1){$paidColor = "bg-success";}
                                if($paid == 0){$paidText = "در انتظار پرداخت";}if ($paid == 1){$paidText = "پرداخت شده";}
                               echo ("
                                    <script type = 'text/javascript'>
                                        function href$id() {
                                            location.href='invoce.php?dept_id=$id';
                                        }
                                    </script>
                                    <tr>
                                        <td>$id_invoce</td>
                                        <td>$paymentCode</td>
                                        <td>$dept_id</td>
                                        <td>$date</td>
                                        <td>
                                        $price
                                        </td>
                                        <td><span class='badge $paidColor'>$paidText</span></td>
                                        
                                    </tr>
                                ");
                            }
                        }else{
                            echo "تعداد فاکتور های شما 0 میباشد.";
                        }

                        ?>

                        </tbody></table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </section>
</div>

<?php
include '../library/footer.php';

?>








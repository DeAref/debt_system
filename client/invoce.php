<?php
include '../library/config.php';
include '../library/rndStr.php';
include '../library/dateTime.php';
include '../library/tax.php';
session_start();
$installments = 0;

$dept_id = $_GET['dept_id'];
include '../library/header.php';
$Query = "SELECT id,amountPerMonth,`date`,payed,`monthCount` FROM `dept` WHERE `id` = '$dept_id' AND `user_id`='$user_id'";
$result = mysqli_query($conn,$Query);
if (mysqli_num_rows($result) > 0) {
    while ($Row = mysqli_fetch_assoc($result)) {
        $amountPerMonth = $Row['amountPerMonth'];
        $dateDept = $Row['date'];
        $payed = $Row['payed'];
        $monthCount = $Row['monthCount'];
    }
if($monthCount == $payed){
    echo "<script>location.href='payment.php';</script>";
    //header("Location: payment.php");
}


    /* get installments   */
    $payedPlusOne = $payed+1;
    $query = "SELECT installments,paid FROM `payment` WHERE `dept_id` = '$dept_id' AND `installments` = '$payedPlusOne' ";
    $result = mysqli_query($conn, $query);
    
    $row = mysqli_fetch_assoc($result);
    $paidInSql = $row["paid"];
    $installments = $row["installments"];
    
    
    /**************************************/
    if(mysqli_num_rows($result) > 0 && $paidInSql == 0)
    {
       
        $query = "SELECT * FROM `payment` WHERE `dept_id` = '$dept_id' AND `installments` = '$payedPlusOne' ";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0)
        {
            while ($row = mysqli_fetch_assoc($result))
            {
                $id = $row["id"];
                $dept_id = $row["dept_id"];
                $paymentCode = $row["paymentCode"];
                $date = $row["date"];
                $price = $row['price'];
            }
        }
        else {
            $paymentCodeRnd = randomString();
            $curentDate = date('y-m-d');
            $installmentsPlusPlus = $installments+1;
            $query = "INSERT INTO `payment` (`id`, `user_id`, `dept_id`, `paymentCode`, `date`, `price`) VALUES (NULL, '$user_id', '$dept_id', '$paymentCodeRnd', '$curentDate', '$amountPerMonth');";
            $result = mysqli_query($conn, $query);
            if ($result === TRUE)
            {

                echo("");
            }
            else
            {
                echo "Error: " . $query . "<br>" . $result->error;
            }
        }
    }
    else {
        $paymentCodeRnd = randomString();
        $curentDate = date('y-m-d');
        $installmentsPlusPlus = $installments + 1;
        $query = "INSERT INTO `payment` (`id`, `user_id`, `dept_id`, `paymentCode`, `date`, `price`,`installments`) VALUES (NULL, '$user_id', '$dept_id', '$paymentCodeRnd', '$curentDate', '$amountPerMonth','$payedPlusOne');";
        $result = mysqli_query($conn, $query);
        if ($result === TRUE)
        {

            $query = "SELECT * FROM `payment` WHERE `dept_id` = '$dept_id' ";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0)
            {
                while ($row = mysqli_fetch_assoc($result))
                {
                    $id = $row["id"];
                    $dept_id = $row["dept_id"];
                    $paymentCode = $row["paymentCode"];
                    $date = $row["date"];
                    $price = $row['price'];
                }
            }
        }
        else
        {
            echo "Error: " . $query . "<br>" . $result->error;
        }
    }


    //when pay button clicked
    if (isset($_POST['pay'])){

        if($monthCount == $payed){
            echo "<script>location.href='payment.php';</script>";
            
        }else{
            $payed = $payed + 1;
            $query = "UPDATE `dept` SET `payed` = '$payed' WHERE `id` = '$dept_id';";
            if(mysqli_query($conn, $query)){
                echo "Record updated successfully";
            }else{
                echo "Error updating record: " . mysqli_error($conn);
            }
            $query = "UPDATE `payment` SET `paid` = '1' WHERE `paymentCode` = '$paymentCode'";
                if(mysqli_query($conn, $query)){
                    echo "Record updated successfully";
                }else{
                    echo "Error updating record: " . mysqli_error($conn);
                }
            echo "<script>location.href='payment.php';</script>";
        }
    }
}
else
{
    header("Location: payment.php");
    echo '<h2> dont tuch my url</h2>';
}

$query = "SELECT * FROM `user` WHERE `id` = '$user_id'";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $name = $row["name"];
        $lName= $row["lName"];
        $nCode = $row["nCode"];
        $email = $row["email"];
        $fatherName = $row['fatherName'];
    }
}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>صورتحساب</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">خانه</a></li>
                        <li class="breadcrumb-item active">صورتحساب</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="callout callout-info">
                        <h5><i class="fa fa-info"></i> نکته :</h5>
                        <?php
                            $now = date('y-m-d');
                            $dateDept = customNextMonth($dateDept,$payed+1);
                            $daysLeft = differenceDate($now,$dateDept);
                            echo "شما تا تاریخ  ($dateDept)  فرصت دارید تا این قسط را پرداخت کنید .($daysLeft روز مانده) ";
                        ?>
                    </div>


                    <!-- Main content -->
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fa fa-globe"></i> سیستم وام دهی   
                                    <small class="float-left">Date: <?php echo $date; ?></small>
                                </h4>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                از
                                <address>
                                    <strong>بانک فلانی</strong><br>
                                    آدرس<br>
                                    خیابان<br>
                                    تلفن : (804) 123-5432<br>
                                    ایمیل : info@roocket.ir
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                به
                                <address>
                                    <strong><?php echo $name." ".$lName;?></strong><br>
                                    کدملی:<?php echo $nCode;?></br>
                                    نام پدر : <?php echo $fatherName;?><br>
                                    ایمیل : <?php echo $email;?>
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <b>کد فاکتور #<?php echo $paymentCode;?></b><br>
                                <br>
                                <b>کد وام :</b> <?php echo $dept_id; ?><br>
                                <b>تاریخ پرداخت :</b> <span rel="ltr"><?php echo $dateDept; ?></span><br>
                                <b>اکانت :</b> <?php echo $user_id;?>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>آیدی</th>
                                        <th>محصول</th>
                                        <th>سریال #</th>
                                        <th>توضیحات</th>
                                        <th>قسط این ماه</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $query = "SELECT id,deptValue,payed,monthCount,amountPerMonth FROM `dept` WHERE `id`='$dept_id'";
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
                                        $resultAmountPerMonth = number_format($amountPerMonth);
                                        $Paid = number_format($Paid);
                                        if($darsad<=25){$darsadColor = "progress-bar-danger";}elseif ($darsad<=50 && $darsad>25){$darsadColor = "bg-warning";}elseif ($darsad<=75 && $darsad>50){$darsadColor = "bg-primary";}elseif($darsad<=100 && $darsad>75){$darsadColor = "bg-success";}
                                        echo ("
                                        
                                        <tr>
                                            <td>$dept_id</td>
                                            <td>$resultDeptValue وام </td>
                                            <td>$paymentCode</td>
                                            <td>وام خرد</td>
                                            <td>$resultAmountPerMonth تومان</td>
                                        </tr>
                                        ");
                                        }
                                        }
                                    ?>


                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <!-- accepted payments column -->
                            <div class="col-6">
                                <p class="lead">روش های پرداخت :</p>
                                <img src="../dist/img/credit/visa.png" alt="Visa">
                                <img src="../dist/img/credit/mastercard.png" alt="Mastercard">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/b/b9/Bank_Melli_Iran_New_Logo.png" width="50px" alt="American Express">
                                <img src="../dist/img/credit/paypal2.png" alt="Paypal">
                                <img src="https://www.zarinpal.com/blog/wp-content/uploads/2021/07/cropped-Asset-1@10x.png" width="50px" alt="ZarinPAl">

                                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                                    پرداخت از طریق کلیه کارت های بانکی عضو شتاب امکان پذیر می باشد.
                                </p>
                            </div>
                            <!-- /.col -->
                            <div class="col-6">
                                <p class="lead">مهلت پرداخت : <?php echo($dateDept); ?></p>

                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:50%">مبلغ کل :</th>
                                            <td><?php echo $resultAmountPerMonth;?> تومان</td>
                                        </tr>
                                        <tr>
                                            <th>مالیات (9.3%)</th>
                                            <td><?php echo (tax(9.3,$amountPerMonth)); ?> تومان</td>
                                        </tr>
                                        <tr>
                                            <th>تخفیف :</th>
                                            <td>0 تومان</td>
                                        </tr>
                                        <tr>
                                            <th>مبلغ قابل پرداخت:</th>
                                            <?php
                                                $finalPrice = $amountPerMonth + ((9.3*$amountPerMonth)/100);
                                                $finalPrice = number_format($finalPrice);
                                            ?>
                                            <td><?php echo $finalPrice; ?> تومان</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- this row will not appear when printing -->
                        <div class="row no-print">
                            <div class="col-12">
                                <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> پرینت </a>
                                <form action="" method="post">
                                <button type="submit" name="pay" class="btn btn-success float-left"><i class="fa fa-credit-card"></i> پرداخت صورتحساب
                                </button>
                                </form>
                                <button type="button" class="btn btn-primary float-left ml-2" style="margin-right: 5px;">
                                    <i class="fa fa-download"></i> تولید PDF
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
include '../library/footer.php';
?>

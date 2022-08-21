<?php
include '../library/config.php';

session_start();
if(!isset($_SESSION['Validation'])){
    header("Location: http://localhost/dept/client/login.php");

}
if (isset($_POST['getDeptSubmit'])){

    if(isset($_POST['faq'])){
        $priceOfDept=$_POST['priceOfDept'];
        $refund=$_POST['refund'];
        $priceOfDeptPerMonth=$priceOfDept/$refund;

        // get user id from nCode
        //----------------------
        $nCode=$_SESSION['nCode'];
        $query = "SELECT id FROM `user` WHERE `nCode`='$nCode'";
        $result = mysqli_query($conn,$query);
        if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $user_id = $row["id"];
            }
        }else{
            header("Location: http://localhost/dept/client/login.php");
        }

        $sqlquery="INSERT INTO `dept` (`id`, `user_id`, `deptValue`, `monthCount`, `unPayed`, `payed`, `amountPerMonth`, `date`) VALUES (NULL, '$user_id', '$priceOfDept', '$refund', '$refund', '0', '$priceOfDeptPerMonth','$systemDate');";



        $result = mysqli_query($conn, $sqlquery);
        if ($result === TRUE) {
            echo "<script>alert('ثبت نام برای وام با موفقیت انجام شد');</script>";
            header("Location: http://localhost/dept");

        } else {
            echo "Error: " . $sqlquery . "<br>" . $result->error;
        }

    }else{
        echo "<script>alert('شما باید قوانین را بپذیرید ');</script>";
    }

}
include "../library/header.php";
?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">دریافت وام</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="#">خانه</a></li>
                            <li class="breadcrumb-item active">وام</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->



        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">فرم دریافت وام</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <!--button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-remove"></i></button-->
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <form action="" method="post">
                            <div class="form-group">
                                <label>مبلغ وام</label>
                                <select name="priceOfDept" class="form-control select2" style="width: 100%;">
                                    <option value="5000000">5 میلیون</option>
                                    <option value="10000000" selected="selected">10 میلیون</option>
                                    <option value="15000000">15 میلیون</option>
                                    <option value="20000000">20میلیون</option>
                                    <option value="25000000">25میلیون</option>
                                    <option value="30000000">30میلیون</option>
                                </select>
                            </div>
                            <!-- /.form-group -->
                            <div class="form-group">
                                <label>بازپرداخت</label>
                                <select name="refund" class="form-control select2"  style="width: 100%;">
                                    <option value="6">6ماهه</option>
                                    <option value="12" selected="selected">12ماهه</option>
                                    <option value="24">24ماهه</option>

                                </select>
                                </br>
                                <div class="checkbox icheck">
                                    <label>
                                        <input name="faq" type="checkbox"> با <a href="#">قوانین </a>دریافت وام موافق هستم
                                    </label>
                                </div>

                                <div class="col-4">
                                    <button type="submit" name="getDeptSubmit" class="btn btn-primary btn-block btn-flat">ثبت</button>
                                </div>
                            </div>
                            <!-- /.form-group -->
                        </form>
                        <!--  /.form tag  -->


                    </div>
                    <!-- /.col -->
                </div>
            </div>
        </div>




 <?php
include "../library/footer.php";
?>
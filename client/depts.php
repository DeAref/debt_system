<?php
session_start();
include "../library/header.php";
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>وام های شما</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="index.php">خانه</a></li>
                        <li class="breadcrumb-item active">وام های شما</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
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
                                <thead>
                                    <tr>
                                        <th>کد</th>
                                        <th>مقدار وام</th>
                                        <th>تاریخ</th>
                                        <th>وضعیت</th>
                                        <th>تعداد اقساط</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Get user debts
                                    //----------------------
                                    $stmt = mysqli_prepare($conn, "SELECT `id`,`deptValue`,`date`,`status`,`monthCount` FROM `dept` WHERE `user_id`=?");
                                    mysqli_stmt_bind_param($stmt, "i", $user_id);
                                    mysqli_stmt_execute($stmt);
                                    $result = mysqli_stmt_get_result($stmt);
                                    
                                    if(mysqli_num_rows($result) > 0) {
                                        while($row = mysqli_fetch_assoc($result)) {
                                            $id = $row["id"];
                                            $deptValue = number_format($row["deptValue"]);
                                            $date = $row["date"];
                                            $status = $row["status"];
                                            $monthCount = $row["monthCount"];
                                            
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
                                                <td>$deptValue</td>
                                                <td>$date</td>
                                                <td><span class='badge $colorStatus'>$resultStatus</span></td>
                                                <td>$monthCount</td>
                                                <td>
                                                    <a href='deptDetails.php?id=$id' class='btn btn-info btn-sm'>جزئیات</a>
                                                </td>
                                            </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='6' class='text-center'>شما هیچ وامی ندارید.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
</div>
<!-- /.content-wrapper -->

<?php
include "../library/footer.php";
?>
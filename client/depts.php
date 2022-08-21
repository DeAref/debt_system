<?php
session_start();
include "../library/header.php";
?>

                                                    <!-- Content Wrapper. Contains page content -->
                        <div class="content-wrapper">
                            <!-- Content Header (Page header) -->
                            <section class="content-header">
                                <div class="container-fluid">

                                 <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">وام های شما</h3>

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
                            </div>
                            <!-- /.container-fluid -->
                        </section>
                    </div>
                    <!-- /.content-wrapper  -->
<?php
include "../library/footer.php";

?>
<?php
include 'header.php';
$searchButtonIsClick = false;
$table_search = "";
if (isset($_POST['search'])){

    $searchButtonIsClick = true;
    $table_search = $_POST['table_search'];
}


?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">

            <!-- TABLE: LATEST ORDERS -->
            <div class="card">
                    <div class="card-header border-transparent">
                    <h3 class="card-title">همه ی وام ها</h3>

                    <div class="card-tools">
                   
                        <div class="input-group input-group-sm" style="width: 200px;">
                        <form action="" method="post" style="display: flex;">
                        
                            <input type="text" name="table_search" class="form-control float-right" placeholder="جستجو بر اساس نام">

                            <div class="input-group-append">
                                <button type="submit" name="search" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                        </div>
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
                            if(!$searchButtonIsClick){
                                $conn = mysqli_connect($host, $usernameDBmySql, $passwordDBmySql,$databaseNameMysql);
                                $query = "SELECT dept.`id`,`deptValue`,`date`,`status`,`monthCount`,`unPayed`,`payed`,`user`.`name` FROM dept INNER JOIN `user` ON dept.user_id=user.id ORDER BY `dept`.`date` DESC";
                                $result = mysqli_query($conn,$query);
                                if(mysqli_num_rows($result) > 0) {
                                    while( $row = mysqli_fetch_assoc($result)) {
                                    $id = $row["id"];
                                    $deptValue = $row["deptValue"];
                                    $date = $row["date"];
                                    $status = $row["status"];
                                    $monthCount = $row["monthCount"];
                                    $name = $row["name"];
                                    $unPayed = $row["unPayed"];
                                    $payed = $row["payed"];
                                    if ($status==0){$resultStatus="رد شد";$colorStatus="badge-danger";}elseif ($status==1){$resultStatus="تایید شده";$colorStatus="badge-success";}else{$resultStatus="درحال برسی";$colorStatus="bg-primary";}
                                    if ($payed == $monthCount){
                                        $paidColor = "backGreen50Op";
                                    }else{$paidColor = "";}
                                    echo ("<tr class='$paidColor'>
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

                           
                            }else{

                                $conn = mysqli_connect($host, $usernameDBmySql, $passwordDBmySql,$databaseNameMysql);
                                $query = "SELECT dept.`id`,`deptValue`,`date`,`status`,`monthCount`,`unPayed`,`payed`,`user`.`name` FROM dept INNER JOIN `user` ON dept.user_id=user.id WHERE `user`.`name` = '$table_search' ORDER BY `dept`.`date` DESC";
                                $result = mysqli_query($conn,$query);
                                if(mysqli_num_rows($result) > 0) {
                                    while( $row = mysqli_fetch_assoc($result)) {
                                    $id = $row["id"];
                                    $deptValue = $row["deptValue"];
                                    $date = $row["date"];
                                    $status = $row["status"];
                                    $monthCount = $row["monthCount"];
                                    $name = $row["name"];
                                    $unPayed = $row["unPayed"];
                                    $payed = $row["payed"];
                                    if ($status==0){$resultStatus="رد شد";$colorStatus="badge-danger";}elseif ($status==1){$resultStatus="تایید شده";$colorStatus="badge-success";}else{$resultStatus="درحال برسی";$colorStatus="bg-primary";}
                                    if ($payed == $monthCount){
                                        $paidColor = "backGreen50Op";
                                    }else{$paidColor = "";}
                                    echo ("<tr class='$paidColor'>
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
                    
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
                
                <!-- /.col -->

                </div>
                <!-- /.col -->
                    
            </div><!--/. container-fluid -->
            
    </div>
</section>
</div>

    


<?php
include 'footer.php';
?>

<?php
include 'header.php';

$conn = mysqli_connect($host, $usernameDBmySql, $passwordDBmySql,$databaseNameMysql);
if (isset($_GET['dept_id']) && isset($_GET['status']))
{
    
    $status = $_GET['status'];
    $dept_id = $_GET['dept_id'];
    if($status == 1 || $status == 0){
        $query = "UPDATE `dept` SET `status` = '$status' WHERE `dept`.`id` = $dept_id;";
        if(mysqli_query($conn, $query)){
            echo "
             <script type = 'text/javascript'>
            
            location.href='statusDebts.php';
            
            </script>
        ";
            echo "با موفقیت آپدیت شد";
            
        }else{
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
    

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
                            <th>وضعیت</th>
                            <th>تایید</th>
                            <th>رد</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            // list of debts 
                            //----------------------
                            
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
                                echo ("
                                
                                <tr>
                                <td>$id</td>
                                <td>$name</td>
                                <td>$deptValue</td>
                                <td>$date</td>
                                <td>$monthCount</td>
                                <td><span class='badge $colorStatus'>$resultStatus</span></td>
                                <td><a href='statusDebts.php?dept_id=$id&status=1' class='backGreen btn btn-sm btn-info float-left'>تایید</a></td>
                                <td><a href='statusDebts.php?dept_id=$id&status=0' class='backRed btn btn-sm btn-info float-left'>رد</a></td>
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

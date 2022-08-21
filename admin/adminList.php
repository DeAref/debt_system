<?php
include 'header.php';




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
                            <th>نام کاربری</th>
                            <th>نقش کاربر</th>
                            <th>نام</th>
                            <th>نام خانوادگی</th>
                            <th>وام ها</th>
                            
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            // list of debts 
                            //----------------------
                            
                            $query = "SELECT `username`,`role`,`name`,`lName`,`countOfDept`,`profilePicture` FROM `admin`";
                            $result = mysqli_query($conn,$query);
                            if(mysqli_num_rows($result) > 0) {
                                while( $row = mysqli_fetch_assoc($result)) {
                                $username = $row["username"];
                                $role = $row["role"];
                                $name = $row["name"];
                                $lName = $row["lName"];
                                $countOfDept = $row["countOfDept"];
                                $profilePicture = $row["profilePicture"];
                                
                                echo ("<tr>
                                <td>$username</td>
                                <td>$role</td>
                                <td>$name</td>
                                <td>$lName</td>
                                <td>$countOfDept</td>
                                <td>$profilePicture</td>
                            </tr>");
                                }
                            }else{
                                echo "لیست قابل نمایش نیست";
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

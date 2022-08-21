<?php
session_start();
include('../library/header.php');


?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>ایمیل ها</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">خانه</a></li>
              <li class="breadcrumb-item active">ایمیل‌ها</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <a href="ticket.php" class="btn btn-primary btn-block mb-3">  باز کردن تیکت جدید</a>

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">پوشه‌ها</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <ul class="nav nav-pills flex-column">
                <li class="nav-item active">
                  <a href="#" class="nav-link">
                    <i class="fa fa-inbox"></i> اینباکس
                    <span class="badge bg-primary float-left">12</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="ticket.php" class="nav-link">
                    <i class="fa fa-envelope-o"></i>ارسال تیکت
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="fa fa-file-text-o"></i> پیش نویس
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="fa fa-filter"></i> هرزنامه
                    <span class="badge bg-warning float-left">65</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="fa fa-trash-o"></i> سطل زباله
                  </a>
                </li>
              </ul>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /. box -->
          
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">اینباکس</h3>

              <div class="card-tools">
                <div class="input-group input-group-sm">
                  <input type="text" class="form-control" placeholder="جستجو ایمیل">
                  <div class="input-group-append">
                    <div class="btn btn-primary">
                      <i class="fa fa-search"></i>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="mailbox-controls">
                
                
                <!-- /.btn-group -->
                <button type="button" onclick="window.location.reload();" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                <div class="float-left">
                  
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.float-right -->
              </div>
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>
                  <tr>
                            <th style="width: 10px">#</th>
                            
                            <th>وضعیت</th>
                            <th>موضوع</th>
                            <th>تاریخ</th>
                           
                           
                        </tr>

                    <?php
                        $query = "SELECT * FROM `ticket` WHERE `user_id`='$user_id'";
                        $result = mysqli_query($conn,$query);
                        if(mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                            
                            $id = $row["id"];
                            $ticket_status = $row["ticket_status"];
                            $ticket_creation_date = $row["ticket_creation_date"];
                            $label = $row["label"];
                            if ($ticket_status==0){$resultStatus="باز";$colorStatus="badge-danger";}elseif ($ticket_status==1){$resultStatus="پاسخ داده شد ";$colorStatus="badge-success";}else{$resultStatus="درحال برسی";$colorStatus="bg-primary";}
                                    echo("
                                    <script type = 'text/javascript'>
                                    function href$id() {
                                        location.href='readTicket.php?ticket_id=$id';
                                    }
                                </script>

                                        <tr onclick='href$id()'>
                                <td>$id</td>
                                <td><span class='badge $colorStatus'>$resultStatus</span></td>
                                <td>$label</td>
                                <td>$ticket_creation_date</td>
                            
                                </tr>
                            ");
                            }
                        }
                    ?>
                  
                  
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer p-0">
              
              </div>
            </div>
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
    include('../library/footer.php');
?>
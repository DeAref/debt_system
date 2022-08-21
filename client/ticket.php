<?php
session_start();
include '../library/header.php';


if(isset($_POST['sendTicket'])){
    
    $ticketTitle = $_POST['ticketTitle'];
    $ticketText = $_POST['ticketText'];
    $query ="INSERT INTO `ticket` (`id`, `ticket_status`, `ticket_creation_date`, `label`, `Text`, `user_id`) VALUES (NULL, '0', '$systemDateTime', '$ticketTitle', '$ticketText', '$user_id');";
    $result = mysqli_query($conn,$query);
    if($result === true){
        echo "تیکت با موفقیت ارسال شد";
    }else{
        echo "مشکل غیرمنتظره";
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
            <h1>ارسال ایمیل</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="#">خانه</a></li>
              <li class="breadcrumb-item active">ارسال ایمیل</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <a href="ticketList.php" class="btn btn-primary btn-block mb-3">برگشت به تیکت ها</a>

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
                    <a href="ticketList.php" class="nav-link">
                      <i class="fa fa-inbox"></i> اینباکس
                      <span class="badge bg-primary float-left">12</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="fa fa-envelope-o"></i> ارسال شده
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
            <form action="" method="post">
           
          </div>
          <!-- /.col -->
          
          <div class="col-md-9">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">ایجاد ایمیل جدید</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              
                <div class="form-group">
                  <input class="form-control" name="ticketTitle" placeholder="عنوان تیکت :">
                </div>
                <div class="form-group">
                    <textarea name="ticketText" id="compose-textarea" class="form-control" style="height: 600px">
                      
                    </textarea>
                </div>
                <div class="form-group">
                  <div class="btn btn-default btn-file">
                    <i class="fa fa-paperclip"></i> فایل ضمیمه
                    <input type="file" name="attachment">
                  </div>
                  <p class="help-block">حداکثر 32MB</p>
                </div>
              
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <div class="float-left">
                  <button type="button" class="btn btn-default"><i class="fa fa-pencil"></i> پیش‌نویس</button>
                  <button name="sendTicket" type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> ارسال</button>
                </div>
                <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> لغو</button>
              </div>
              <!-- /.card-footer -->
              </form>
            </div>
            <!-- /. box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<?php

include '../library/footer.php';

?>
<?php
session_start();
include '../library/header.php';

if(isset($_GET['ticket_id'])){
$ticket_id = $_GET['ticket_id'];
}else{
    $ticket_id =""; 
    header("location: ticketList.php");
}
$query = "SELECT ticket.`id`,`ticket_status`,`ticket_creation_date`,`label`,`Text`,`user_id`,`user`.name,`user`.lName FROM ticket INNER JOIN `user` ON ticket.user_id = user.id WHERE `ticket`.id = '$ticket_id'";
$result = mysqli_query($conn,$query);
if(mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $ticket_status = $row["ticket_status"];
    $ticket_creation_date = $row["ticket_creation_date"];
    $label = $row["label"];
    $Text = $row["Text"];
    $name= $row["name"];
    $lName = $row["lName"];
    $user_id = $row["user_id"];
    $message = " تیکت";
    
}else{
    $ticket_status = "";
    $ticket_creation_date = "";
    $label = "";
    $Text = "";
    $name= "";
    $lName = "";
    $user_id ="";
    $message = "تیکتی یافت نشد";
}

if(isset($_POST['sendReplyTicket'])){
    $textReply = $_POST['ReplyticketText'];
    $query ="INSERT INTO `conversation` (`id`, `Ticket_ID`, `date`, `name`, `Text`) VALUES (NULL, '$ticket_id', '$systemDate', '$name $lName', '$textReply');";
    $result = mysqli_query($conn,$query);
    if($result === true){
        echo 'پیام ارسال شد';
    }else{
        echo'پیام غیرمنظره';
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
            <h1>خواندن ایمیل</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">خانه</a></li>
              <li class="breadcrumb-item active">خواندن ایمیل</li>
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
            
      
          </div>
          <!-- /.col -->

          <div class="col-md-9">


          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title"><?php  echo ($message); ?></h3>

              <div class="card-tools">
                <a href="#" class="btn btn-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-right"></i></a>
                <a href="#" class="btn btn-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-left"></i></a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="mailbox-read-info">
                <h5><?php  echo ($label); ?></h5>
                <h6>ایجاد شده توسط : <?php  echo ($name." ".$lName); ?>
                  <span class="mailbox-read-time float-left"><?php  echo ($ticket_creation_date); ?></span></h6>
              </div>
              <!-- /.mailbox-read-info -->
              
              <div class="mailbox-read-message">
              <?php  echo ($Text); ?>
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer bg-white">
              
            </div>
            <!-- /.card-footer -->
            <div class="card-footer">
              <div class="float-left">
                <button type="button" class="btn btn-default"><i class="fa fa-reply"></i> پاسخ</button>
                <button type="button" class="btn btn-default"><i class="fa fa-share"></i> جلو</button>
              </div>
              <button type="button" class="btn btn-default"><i class="fa fa-trash-o"></i> حذف</button>
              <button type="button" class="btn btn-default"><i class="fa fa-print"></i> پرینت</button>
            </div>
            <!-- /.card-footer -->
          </div>
          <!-- /. box -->

<?php 
//Conversion
$query = "SELECT * FROM `conversation` WHERE `Ticket_ID`='$ticket_id'";
$result = mysqli_query($conn,$query);
if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
    
    $date = $row["date"];
    $nameC = $row["name"];
    $TextC = $row["Text"];
   
    ?>
    
<!-- Conversion -->

          <div class="card card-primary card-outline">
            <div class="card-header">
              

              
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="mailbox-read-info">
                
                <h6>ایجاد شده توسط : <?php  echo ($nameC); ?>
                  <span class="mailbox-read-time float-left"><?php  echo ($date); ?></span></h6>
              </div>
              <!-- /.mailbox-read-info -->
             
              <!-- /.mailbox-controls -->
              <div class="mailbox-read-message">
              <?php  echo ($TextC); ?>
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer bg-white">
              
            </div>
            <!-- /.card-footer -->
            <div class="card-footer">
              <div class="float-left">
                <button type="button" class="btn btn-default"><i class="fa fa-reply"></i> پاسخ</button>
                <button type="button" class="btn btn-default"><i class="fa fa-share"></i> جلو</button>
              </div>
              <button type="button" class="btn btn-default"><i class="fa fa-trash-o"></i> حذف</button>
              <button type="button" class="btn btn-default"><i class="fa fa-print"></i> پرینت</button>
            </div>
            <!-- /.card-footer -->
          </div>
          <!-- /. box -->
        
    <!-- /.conversion  -->
    <?php
    }
}else{
    $date = "";
    $nameC = "";
    $TextC = "";
    
  //  $message = "تیکتی یافت نشد";
}

?>
  
        
          <div class="card-header">
              <h3 class="card-title"> پاسخ </h3>
            </div>
            <!-- /.card-header -->
            <form action="" method="post">
          <div class="form-group">
                    <textarea name="ReplyticketText" id="compose-textarea" class="form-control" style="height: 600px">
                      پاسخ شما
                    </textarea>
                </div>
                <div class="float-left">
                  
                  <button name="sendReplyTicket" type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> ارسال</button>
                </div>
            
            </form>     
                <!-- /. reply -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



<?php

include '../library/footer.php';

?>
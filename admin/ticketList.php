<?php

include('header.php');
//header('Content-Type: text/html; charset=UTF-8');
mysqli_query($conn, "SET NAMES utf-8");
if (isset($_GET['ticket_id']))
{
    
  
    $ticket_id_for_status = $_GET['ticket_id'];
    
    $query2="UPDATE `ticket` SET `ticket_status` = '2' WHERE `ticket`.`id` = '$ticket_id_for_status';";
    
    if(mysqli_query($conn,$query2)){
        echo "
            <script type = 'text/javascript'>
        
        location.href='ticketList.php';
        
        </script>
    ";
        echo "با موفقیت آپدیت شد";
        
    }else{
        echo "Error updating record: " . mysqli_error($conn);
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
        
        <div class="col-md-12">
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
               
               </div>
               <!-- /.float-right -->
             
                <!-- /.float-right -->
              </div>
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>
                  <tr>
                            <th style="width: 10px">#</th>
                            <th>ایجاد شده توسط</th>
                            <th>وضعیت</th>
                            <th>موضوع</th>
                            <th>تاریخ</th>
                            <th>تغییر وضعیت به درحال برسی</th>
                        </tr>

                    <?php
                        $query = "SELECT ticket.`id`,`ticket_status`,`ticket_creation_date`,`label`,name,lName FROM `ticket` INNER JOIN `user` ON ticket.user_id = `user`.`id`";
                        $result = mysqli_query($conn,$query);
                        if(mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                            
                            $id = $row["id"];
                            $ticket_status = $row["ticket_status"];
                            $ticket_creation_date = $row["ticket_creation_date"];
                            $label = $row["label"];
                            $nameUser = $row["name"];
                            $lNameUser = $row["lName"];
                            $nlUser = $nameUser." ".$lNameUser;
                            if ($ticket_status==0){$resultStatus="باز";$colorStatus="badge-danger";}elseif ($ticket_status==1){$resultStatus="پاسخ داده شد ";$colorStatus="badge-success";}else{$resultStatus="درحال برسی";$colorStatus="bg-primary";}
                                    echo("
                                    <script type = 'text/javascript'>
                                    function href$id() {
                                        location.href='readTicket.php?ticket_id=$id';
                                    }
                                </script>

                                        <tr onclick='href$id()'>
                                <td>$id</td>
                                <td>$nlUser</td>
                                <td><span class='badge $colorStatus'>$resultStatus</span></td>
                                <td>$label</td>
                                <td>$ticket_creation_date</td>
                                    <td><a href='ticketList.php?ticket_id=$id' class='backGreen btn btn-sm btn-info float-left'>تغییر</a></td>
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
              <div class="mailbox-controls">
               
                <!-- /.btn-group -->
                <button type="button" onclick="window.location.reload();" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                
                </div>
                <!-- /.float-right -->
              </div>
            </div>
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </!--div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
    include('footer.php');
?>
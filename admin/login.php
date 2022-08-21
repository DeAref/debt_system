<?php
session_start();

if(isset($_POST['loginAdmin']))
{
    $password = md5($_POST['password']);
    //$conn=mysqli_connect("localhost","root","","deptsystem");
    include 'config.php';
    $query = "SELECT * FROM `admin` WHERE `username`='aref' AND `password`='$password'";
    $result = mysqli_query($conn,$query);

    if(mysqli_num_rows($result) > 0)
    {
        $_SESSION['adminUserName']= "aref";
        $_SESSION['ValidationAdmin']= "true";
        header("Location: index.php");
    }else{

        echo "<div class='callout callout-danger'>user name or password not correct</div>";
        unset($_SESSION['ValidationAdmin']);
        echo "<audio src='http://freesoundeffect.net/sites/default/files/incorrect-answer--6-sound-effect-99679566.mp3' autoplay ></audio>";
    }


}

if(isset($_SESSION['ValidationAdmin'])){
  header("Location: index.php");
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>پنل مدیریت | صفحه قفل</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- bootstrap rtl -->
  <link rel="stylesheet" href="../dist/css/bootstrap-rtl.min.css">
  <!-- template rtl version -->
  <link rel="stylesheet" href="../dist/css/custom-style.css">
</head>
<body class="hold-transition lockscreen">
<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
  <div class="lockscreen-logo">
    <a href="../../index2.html"><b>پنل مدیریت</b></a>
  </div>
  <!-- User name -->
  <div class="lockscreen-name"> عارف سلیمانی</div>

  <!-- START LOCK SCREEN ITEM -->
  <div class="lockscreen-item">
    <!-- lockscreen image -->
    <div class="lockscreen-image">
      <img src="../dist/img/2022.jpg" alt="User Image">
    </div>
    <!-- /.lockscreen-image -->

    <!-- lockscreen credentials (contains the form) -->
    <form class="lockscreen-credentials" action="" method="post">
      <div class="input-group">
        <input type="password" name="password" class="form-control" placeholder="رمز عبور">

        <div class="input-group-append">
          
          <button type="submit" name="loginAdmin" class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
      
         
        </div>
      </div>
    </form>
    <!-- /.lockscreen credentials -->

  </div>
  <!-- /.lockscreen-item -->
  <div class="help-block text-center">
  برای ورود با عنوان مدیر کل رمز عبور خود را وارد کنید
  </div>
  <div class="text-center">
    <a href="login2.php">و یا با یک یوزرنیم دیگر وارد شوید</a>
  </div>
  <div class="lockscreen-footer text-center mt-4">
    <strong>Copyright&copy; 2022 <a href="http://github.com/DeAref/">Aref Solaimany</a>.</strong>
  </div>
</div>
<!-- /.center -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>

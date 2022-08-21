<?php
session_start();
if ( isset($_SESSION['logout']))
{
    echo "<h3><strong>شما از اکانت خارج شدید</strong></h3>";
    unset($_SESSION['logout']);
}

//register
if(isset($_POST['register'])){
  $_SESSION['register'] = "true";
  header("location: register.php");
}


//$user = 'aref';
//$pass = 'aref';


if ( isset($_SESSION['sign-up']))
{
    echo "<h3><strong>ثبت نام با موفقیت انجام شد</strong></h3>";
    unset($_SESSION['sign-up']);
}


if(isset($_POST['submit']))
{
    include '../library/config.php';
    //$conn=mysqli_connect("localhost","root","","deptsystem");
    $nCodelogin=$_POST['nCode'];
    $password =md5($_POST['password']);
    $query = "SELECT * FROM `user` WHERE `nCode`='$nCodelogin' AND `password`='$password'";
    $result = mysqli_query($conn,$query);

    if(mysqli_num_rows($result) > 0)
    {
        $_SESSION['nCode']= $_POST['nCode'];
        $_SESSION['Validation']= "true";
        header("Location: ../index.php");
    }else{

        echo "<div class='callout callout-danger'>user name or password not correct</div>";
        unset($_SESSION['Validation']);
        echo "<audio src='http://freesoundeffect.net/sites/default/files/incorrect-answer--6-sound-effect-99679566.mp3' autoplay ></audio>";
    }


}

if(isset($_SESSION['Validation'])){
    header("Location: ../index.php");
}


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>پنل مدیریت | صفحه ورود</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- client css -->
  <link rel="stylesheet" href="../dist/css/client.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/iCheck/square/blue.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- bootstrap rtl -->
  <link rel="stylesheet" href="../dist/css/bootstrap-rtl.min.css">
  <!-- template rtl version -->
  <link rel="stylesheet" href="../dist/css/custom-style.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../index2.html"><b>ورود به سایت</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">فرم زیر را تکمیل کنید و ورود بزنید</p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="number" class="form-control" name="nCode" placeholder="کدملی">
          <div class="input-group-append">
            <span class="fa fa-envelope input-group-text"></span>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="رمز عبور">
          <div class="input-group-append">
            <span class="fa fa-lock input-group-text"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="checkbox icheck">
              <label>
                <input type="checkbox"> یاد آوری من
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">ورود</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fa fa-facebook mr-2"></i> ورود با اکانت فیسوبک
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fa fa-google-plus mr-2"></i> ورود با اکانت گوگل
        </a>
      </div>
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="#">رمز عبورم را فراموش کرده ام.</a>
      </p>
      <p class="mb-0">
      <form action="" method="post">
  <button type="submit" class="link" name="register" value="ثبت نام">ثبت نام</button>
</form>
       
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- iCheck -->
<script src="../plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass   : 'iradio_square-blue',
      increaseArea : '20%' // optional
    })
  })
</script>
</body>
</html>

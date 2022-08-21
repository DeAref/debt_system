<?php



session_start();
if(isset($_SESSION['Validation'])){
    header("Location: ../index.php");
 // echo "hello hello yaaa";
}else{
    header("Location: http://localhost/dept/client/login.php");
}



if ( isset($_SESSION['logout']))
{
    echo "<h3><strong>شما از اکانت خارج شدید</strong></h3>";
    unset($_SESSION['logout']);
}
if ( isset($_SESSION['sign-up']))
{
    echo "<h3><strong>ثبت نام با موفقیت انجام شد</strong></h3>";
    unset($_SESSION['sign-up']);
}
//if(isset($_SESSION['Validation'])){
//    header("Location: http://localhost/Dept/index.php");
//}




?>
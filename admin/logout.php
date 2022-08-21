<?php


    session_start();
    unset($_SESSION['ValidationAdmin']);
    unset($_SESSION['Validation']);
    $_SESSION['logout']="true";
    header("Location: login.php");
?>








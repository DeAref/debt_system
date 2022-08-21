<?php


    session_start();
    unset($_SESSION['Validation']);
    $_SESSION['logout']="true";
    header("Location: login.php");
?>








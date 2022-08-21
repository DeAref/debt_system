<?php
$host = "localhost";
$usernameDBmySql = "ipir_debt";
$passwordDBmySql = "nqg[M0=g}Sr(";
$databaseNameMysql = "ipir_debt";
//.............................. localhost...username.......password..............database name.....//
$conn = mysqli_connect($host, $usernameDBmySql, $passwordDBmySql,$databaseNameMysql);

//mysqli_set_charset($conn,'utf8');
// mysqli_query($conn, "SET NAMES utf8");
// mysqli_query($conn, "SET CHARACTER SET utf8");
//mysqli_query($conn, "SET character_set_connection = utf8");
$sumDeptValue = 0;
$sumPayed = 0;
$sumMonthCount = 0;
$sumUnPayed= 0 ;
$systemDate = date('y-m-d');
$systemTime = date('h:i:s');
$loginAddress = "http://5ip.ir/dept/client/login.php";


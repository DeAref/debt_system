<?php

//..................... localhost...username...password.....database name.....//
$conn = mysqli_connect("localhost", "ipir_debt", "nqg[M0=g}Sr(", "ipir_debt");
//mysql_set_charset('utf8', $conn);
// mysqli_query($conn, "SET NAMES utf8");
// mysqli_query($conn, "SET CHARACTER SET utf8");
//mysqli_query($conn, "SET character_set_connection = utf8");
$sumDeptValue = 0;
$sumPayed = 0;
$sumMonthCount = 0;
$sumUnPayed= 0 ;
$systemDate = date('y-m-d');
$systemTime = date('h:i:s');
$systemDateTime = date('y-m-d | h:i:s');
$loginAddress = "http://5ip.ir/debt/client/login.php";
$Domain= "http://5ip.ir/debt";



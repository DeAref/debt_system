<?php
function getAllDebtsSum($conn) {
    $stmt = mysqli_prepare($conn, "SELECT SUM(`deptValue`) as `allDebts` FROM `dept`");
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    
    return $row["allDebts"] ?? 0;
}

function getAllPaidAmounts($conn) {
    $allPayed = 0;
    $stmt = mysqli_prepare($conn, "SELECT amountPerMonth,payed FROM `dept`");
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $payedInWhile = $row["payed"];
            $amountPerMonthInWhile = $row['amountPerMonth'];
            $allPayed += ($payedInWhile * $amountPerMonthInWhile);
        }
    }
    
    return $allPayed;
}

function getTotalDebtsCount($conn) {
    $stmt = mysqli_prepare($conn, "SELECT COUNT(`id`) AS `ids` FROM dept");
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    
    return $row['ids'];
}

function getActiveDebtsCount($conn) {
    $stmt = mysqli_prepare($conn, "SELECT COUNT(`id`) AS `ids` FROM dept WHERE `status`=1");
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    
    return $row['ids'];
}

function getUserCount($conn) {
    $stmt = mysqli_prepare($conn, "SELECT * FROM `user`");
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    return mysqli_num_rows($result);
}

function getLatestDebts($conn, $limit = 6) {
    $debts = [];
    $stmt = mysqli_prepare($conn, "SELECT dept.`id`,`deptValue`,`date`,`status`,`monthCount`,`unPayed`,`payed`,`user`.`name` 
                                   FROM dept 
                                   INNER JOIN `user` ON dept.user_id=user.id 
                                   ORDER BY `dept`.`date` DESC 
                                   LIMIT ?");
    mysqli_stmt_bind_param($stmt, "i", $limit);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $debts[] = $row;
        }
    }
    
    return $debts;
}
?>
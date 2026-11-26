<?php

class DebtManager {
    private $conn;
    
    public function __construct($connection) {
        $this->conn = $connection;
    }
    
    // دریافت وضعیت وام
    public function getDeptStatus($status) {
        switch($status) {
            case 0:
                return ["رد شد", "badge-danger"];
            case 1:
                return ["تایید شده", "badge-success"];
            default:
                return ["درحال بررسی", "bg-primary"];
        }
    }
    
    // تعیین رنگ ردیف بر اساس تسویه حساب
    public function getPaidColorClass($payed, $monthCount) {
        return ($payed == $monthCount) ? "backGreen50Op" : "";
    }
    
    // دریافت تمام وام‌ها
    public function getAllDebts($search = null) {
        if (empty($search)) {
            $query = "SELECT dept.`id`,`deptValue`,`date`,`status`,`monthCount`,`unPayed`,`payed`,`user`.`name` 
                     FROM dept 
                     INNER JOIN `user` ON dept.user_id=user.id 
                     ORDER BY `dept`.`date` DESC";
            $result = mysqli_query($this->conn, $query);
        } else {
            $query = "SELECT dept.`id`,`deptValue`,`date`,`status`,`monthCount`,`unPayed`,`payed`,`user`.`name` 
                     FROM dept 
                     INNER JOIN `user` ON dept.user_id=user.id 
                     WHERE `user`.`name` LIKE ? 
                     ORDER BY `dept`.`date` DESC";
            $stmt = mysqli_prepare($this->conn, $query);
            $searchParam = "%$search%";
            mysqli_stmt_bind_param($stmt, "s", $searchParam);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
        }
        
        $debts = [];
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $debts[] = $row;
            }
        }
        
        return $debts;
    }
    
    // دریافت آخرین وام‌ها
    public function getLatestDebts($limit = 6) {
        $debts = [];
        $stmt = mysqli_prepare($this->conn, "SELECT dept.`id`,`deptValue`,`date`,`status`,`monthCount`,`unPayed`,`payed`,`user`.`name` 
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
}

?>
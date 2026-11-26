<?php
require_once '../library/db.php';

class AdminAuthService {
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
    }

    public function login($username, $password) {
        // First check if we're using the old MD5 method
        $md5Password = md5($password);
        $stmt = $this->db->prepare('SELECT * FROM `admin` WHERE `username` = ? AND `password` = ?');
        $stmt->bind_param('ss', $username, $md5Password);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0) {
            $admin = $result->fetch_assoc();
            // Starting session and setting session variables
            session_start();
            $_SESSION['adminUserName'] = $admin['username'];
            $_SESSION['ValidationAdmin'] = 'true';
            header("Location: index.php");
            exit;
        }
        
        return 'User name or password not correct';
    }
}
?>
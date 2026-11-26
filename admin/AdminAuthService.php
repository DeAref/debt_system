<?php
require_once '../library/db.php';

class AdminAuthService {
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
    }

    public function login($username, $password) {
        $stmt = $this->db->prepare('SELECT * FROM `admin` WHERE `username` = ?');
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0) {
            $admin = $result->fetch_assoc();
            // Check password with password_verify (more secure)
            if (password_verify($password, $admin['password'])) {
                // Starting session and setting session variables
                session_start();
                $_SESSION['adminUserName'] = $admin['username'];
                $_SESSION['ValidationAdmin'] = 'true';
                header("Location: index.php");
                exit;
            }
        }
        
        return 'User name or password not correct';
    }
}
?>
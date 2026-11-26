<?php
require_once 'db.php';

class AuthService {
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
    }

    public function login($email, $password) {
        $stmt = $this->db->prepare('SELECT * FROM `user` WHERE `email` = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                // Starting session and setting session variables
                session_start();
                $_SESSION['email'] = $user['email'];
                $_SESSION['Validation'] = 'true';
                header("Location: ../index.php");
                exit;
            }
        }
        return 'User name or password not correct';
    }
}
?>
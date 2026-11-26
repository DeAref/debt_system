<?php
require_once 'AuthService.php';

if(isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $authService = new AuthService();
    $loginMessage = $authService->login($email, $password);
    if ($loginMessage) {
        echo $loginMessage;
    }
}
?>
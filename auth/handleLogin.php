<?php
session_start();
include '../connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (isset($_POST['email']) && isset($_POST['password'])) {

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        // if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user['email'];

            if (str_contains($user['email'], '@admin')) {
                header("Location: ../admin/admin-products.php");
            } else {
                header("Location: ../index.php");
            }
            exit();
        // } else {
        //     header("Location: /demo-web/login.php?error=1");
        //     exit();
        // }
    } 
}

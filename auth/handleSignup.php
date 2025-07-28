<?php
session_start();
include '../connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // lay data tu form
    $name = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // kt data rong
    if (!empty($name) && !empty($email) && !empty($password)) {

        // k chua @admin
        if (strpos($email, '@admin') !== false) {
            echo "<script>
                alert('Email không được chứa @admin');
                window.location.href = '../index.php#signup';
            </script>";
            exit();
        }

        // email phai bac buoc co @gmail.com
        if (!preg_match('/@gmail\.com$/', $email)) {
            echo "<script>
                alert('Email phải có đuôi @gmail.com');
                window.location.href = '../index.php#signup';
            </script>";
            exit();
        }

        // ma hoa mk
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // chua cac placeholder de tranh loi injection
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:name, :email, :password)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);

        if ($stmt->execute()) {
            header("Location: ../index.php#login");
            exit();
        } else {
            echo "<script>
                alert('Đăng ký thất bại!');
                window.location.href = '../index.php#signup';
            </script>";
        }
    } else {
        echo "<script>
            alert('Vui lòng nhập đầy đủ thông tin!');
            window.location.href = '../index.php#signup';
        </script>";
    }
}
?>


<?php
session_start();
include '../connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($email) && !empty($password)) {
        // Tìm user theo email
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Kiểm tra user tồn tại và mật khẩu đúng
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['email'] = $user['email'];

            // kt email
            if (substr($email, -10) === '@gmail.com') {
                header("Location: ../index.php#home");
                exit();
            } elseif (substr($email, -6) === '@admin') {
                header("Location: ../admin/admin-products.php"); // trang admin
                exit();
            } else {
                echo "<script>
                    alert('Email không hợp lệ. Chỉ cho phép @gmail.com hoặc @admin');
                    window.location.href = '/demo-web/index.php#login';
                </script>";
                exit();
            }

        } else {
            echo "<script>
                alert('Sai email hoặc mật khẩu!');
                window.location.href = '/demo-web/index.php#login';
            </script>";
            exit();
        }
    } else {
        echo "<script>
            alert('Vui lòng nhập đầy đủ thông tin!');
            window.location.href = '/demo-web/index.php#login';
        </script>";
        exit();
    }
}
?>

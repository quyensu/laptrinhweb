<style>
    body {
        font-family: Arial, sans-serif;
        background: #f9f9f9;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .container {
        background: #fff;
        padding: 30px 40px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        text-align: center;
        max-width: 500px;
        width: 100%;
    }

    .container h2 {
        color: #28a745;
        margin-bottom: 15px;
    }

    .container p {
        font-size: 15px;
        margin-bottom: 20px;
        color: #444;
    }

    .container a {
        display: inline-block;
        background: #007bff;
        color: #fff;
        padding: 12px 20px;
        text-decoration: none;
        border-radius: 6px;
        transition: background 0.3s;
    }

    .container a:hover {
        background: #0056b3;
    }
</style>

<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['name'] ?? '';
    $cart = $_SESSION['cart'] ?? [];


    if (empty($cart)) {
        echo "<h2>Giỏ hàng đang trống. Không thể đặt hàng.</h2>";
        echo "<a href='/demo-web/cart.php'>Quay lại giỏ hàng</a>";
        exit;
    }

    unset($_SESSION['cart']);

    echo "<h2>Cảm ơn bạn <strong>$name</strong> đã đặt hàng!</h2>";
    echo "<p>Chúng tôi sẽ sớm liên hệ để xác nhận và giao hàng.</p>";
    echo "<a href='/demo-web/index.php'>Về trang chủ</a>";
} else {
    header("Location: ../demo-web/pages/checkout.php");
    exit;
}

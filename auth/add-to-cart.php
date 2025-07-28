<?php
session_start();
include '../connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_product'], $_POST['quantity'])) {
    $id = $_POST['id_product'];
    $quantity = max(1, (int)$_POST['quantity']);

    $stmt = $pdo->prepare("SELECT * FROM products WHERE id_product = ?");
    $stmt->execute([$id]);
    $product = $stmt->fetch();

    if ($product) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity'] += $quantity;
        } else {
            $_SESSION['cart'][$id] = [
                'name' => $product['name'],
                'price' => $product['price'],
                'image' => $product['image'],
                'quantity' => $quantity
            ];
        }

        echo json_encode(['success' => true, 'message' => 'Đã thêm vào giỏ hàng']);
        exit;
    }
}

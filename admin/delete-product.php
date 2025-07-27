<?php
include '../connect.php';
$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM products WHERE id_product = ?");
$stmt->execute([$id]);
header("Location: admin-products.php");
exit();
?>
<?php
$host = 'localhost';
$db   = 'demo-web1';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $user, $pass);
} catch (PDOException $e) {
    echo "Lỗi kết nối CSDL: " . $e->getMessage();
    exit();
}
if(!$pdo) {
    echo "hehe";
}
?>
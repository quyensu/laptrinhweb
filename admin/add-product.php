<link rel="stylesheet" href="../styles/add-product.css">

<?php
include '../connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $image = $_FILES['image']['name'];

    $stmt = $pdo->prepare("INSERT INTO products (id_product, name, type, price, description, image) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$id, $name, $type, $price, $description, $image]);

    header("Location: admin-products.php");
    exit();
}
?>

<form method="post" enctype="multipart/form-data">
    <label>ID: </label>
    <input name="id"><br>
    <label>Tên: </label>
    <input name="name"><br>
    <label>Loại: </label>
    <select name="type">
        <option value="áo">Áo</option>
        <option value="quần">Quần</option>
        <option value="phụ kiện">Phụ kiện</option>
    </select><br>
    <label>Giá: </label>
    <input name="price" type="number"><br>
    <label>Mô tả: </label>
    <textarea name="description"></textarea><br>
    <label>Ảnh: </label>
    <input type="file" name="image"><br>
    <button type="submit">Thêm</button>
</form>
<?php
include '../connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // upload ảnh
    $image = $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], "../assets/products/" . $image);

    $stmt = $pdo->prepare("INSERT INTO products (id_product, name, type, price, description, image) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$id, $name, $type, $price, $description, $image]);
    header("Location: admin-products.php");
    exit();
}
?>

<form method="post" enctype="multipart/form-data">
    ID: <input name="id"><br>
    Tên: <input name="name"><br>
    Loại:
    <select name="type">
        <option value="áo">Áo</option>
        <option value="quần">Quần</option>
        <option value="phụ kiện">Phụ kiện</option>
    </select><br>
    Giá: <input name="price" type="number"><br>
    Mô tả: <textarea name="description"></textarea><br>
    Ảnh: <input type="file" name="image"><br>
    <button type="submit">Thêm</button>
</form>
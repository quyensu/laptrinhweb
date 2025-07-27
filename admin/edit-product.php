<?php
include '../connect.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM products WHERE id_product = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    if ($_FILES['image']['name']) {
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../assets/products/" . $image);
    } else {
        $image = $product['image'];
    }

    $stmt = $pdo->prepare("UPDATE products SET name=?, type=?, price=?, description=?, image=? WHERE id_product=?");
    $stmt->execute([$name, $type, $price, $description, $image, $id]);

    header("Location: admin-products.php");
    exit();
}
?>

<form method="post" enctype="multipart/form-data">
    <label for="id">ID: </label>
    <input name="id" id="id" value="<?php echo $product['id_product']; ?>"><br>
    <label for="name">Tên: </label>
    <input name="name" id="name" value="<?php echo $product['name']; ?>"><br>
    <label for="type">Loại: </label>
    <input name="type" id="type" value="<?php echo $product['type']; ?>"><br>
    <label for="price">Giá: </label>
    <input name="price" id="price" type="number" value="<?php echo $product['price']; ?>"><br>
    <label for="description">Mô tả: </label>
    <textarea name="description" id="description"><?php echo $product['description']; ?></textarea><br>
    <label for="image">Ảnh: </label>
    <input type="file" id="image" name="image"><br>
    <img src="../assets/products/<?php echo $product['image']; ?>" width="100"><br>
    <button type="submit">Cập nhật</button>
</form>
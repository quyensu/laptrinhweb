<link rel="stylesheet" href="./styles/product-detail.css">

<?php
session_start();
include '../connect.php';

if (!isset($_GET['id'])) {
    echo "Không tìm thấy sản phẩm.";
    exit();
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM products WHERE id_product = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();
?>

<section id="product-detail">
    <img src="./assets/products/<?php echo htmlspecialchars($product['image']); ?>" width="200">
    <div id="product-d-right">
        <h2><?php echo htmlspecialchars($product['name']); ?></h2>
        <p>Loại: <?php echo htmlspecialchars($product['type']); ?></p>
        <p>Giá: <?php echo number_format($product['price'], 0, ',', '.'); ?> VNĐ</p>
        <p>Mô tả: <?php echo htmlspecialchars($product['description']); ?></p>

        <!-- ✅ Thêm ID để JS nhận diện -->
        <form id="add-to-cart-form" action="/demo-web/auth/add-to-cart.php" method="POST">
            <input type="hidden" name="id_product" value="<?= $product['id_product'] ?>">
            <label for="quantity">Số lượng: </label>
            <input type="number" name="quantity" value="1" min="1"> <br>
            <button type="submit">Thêm vào giỏ</button>
        </form>
    </div>
</section>

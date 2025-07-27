<link rel="stylesheet" href="./styles/products.css">

<?php
include '../connect.php';

$sql = "SELECT * FROM products";
$stmt = $pdo->query($sql);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section id="products">
    <h1>Sản phẩm</h1>
    <div id="products-list">
        <?php foreach ($products as $product): ?>
            <div class="product">
                <img src="./assets/products/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                <div class="product-info-row">
                    <p>Loại: <?php echo $product['type']; ?></p>
                    <p>Giá: <?php echo number_format($product['price'], 0, ',', '.') ?> VNĐ</p>
                    <p><?php echo htmlspecialchars($product['description']); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</section>
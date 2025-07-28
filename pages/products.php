<link rel="stylesheet" href="./styles/products.css">

<?php
include '../connect.php';

$sql = "SELECT * FROM products";
$stmt = $pdo->query($sql);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section id="products">
    <div>
        <h1>Sản phẩm</h1>
        <label for="filter">Lọc: </label>
        <select id="filter">
            <option value="all">Tất cả</option>
            <option value="áo">Áo</option>
            <option value="quần">Quần</option>
            <option value="phụ kiện">Phụ kiện</option>
        </select>
    </div>

    <div id="products-list">
    <?php foreach ($products as $product): ?>
        <a href="#product-detail&id=<?php echo $product['id_product']; ?>" data-detail="<?php echo $product['id_product']; ?>">
            <div class="product" data-type="<?php echo strtolower($product['type']); ?>">
                <img src="./assets/products/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                <div class="product-info-row">
                    <p>Loại: <?php echo $product['type']; ?></p>
                    <p>Giá: <?php echo number_format($product['price'], 0, ',', '.') ?> VNĐ</p>
                    <p><?php echo htmlspecialchars($product['description']); ?></p>
                </div>
            </div>
        </a>
    <?php endforeach; ?>
</div>
</section>

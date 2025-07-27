<link rel="stylesheet" href="../styles/admin-product.css">

<!-- FONT AWSOME  -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<?php
include '../connect.php';
$sql = "SELECT * FROM products";
$products = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="header">
    <img class="logo" src="../assets/Coca-Cola_logo.svg.png" alt="logo" data-page="home">
    <h1>QUẢN LÍ SẢN PHẨM</h1>
    <a class="user-icon" href="#"><i class="fa-solid fa-user"></i></a>
</div>

<div class="admin">
    <a class="add-product" href="add-product.php">Thêm sản phẩm</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Ảnh</th>
            <th>Tên</th>
            <th>Loại</th>
            <th>Giá</th>
            <th>Mô tả</th>
            <th>Hành động</th>
        </tr>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?php echo htmlspecialchars($product['id_product']); ?></td>
                <td><img src="../assets/products/<?php echo $product['image']; ?>"></td>
                <td><?php echo htmlspecialchars($product['name']); ?></td>
                <td><?php echo htmlspecialchars($product['type']); ?></td>
                <td><?php echo number_format($product['price']); ?> VNĐ</td>
                <td><?php echo htmlspecialchars($product['description']); ?></td>
                <td>
                    <?php
                    echo '<a href="edit-product.php?id=' . $product['id_product'] . '">Sửa</a> | 
                     <a href="delete-product.php?id=' . $product['id_product'] . '" onclick="return confirm(\'Bạn có chắc muốn xóa?\')">Xóa</a>';
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
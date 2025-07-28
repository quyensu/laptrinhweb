<link rel="stylesheet" href="./styles/cart.css">

<?php
session_start();
$cart = $_SESSION['cart'] ?? [];
$total = 0;
?>

<section id="cart">
    <h1>Giỏ hàng</h1>

    <?php if (empty($cart)): ?>
        <p id="empty">Giỏ hàng trống.</p>
    <?php else: ?>
        <table>
            <tr>
                <th>Sản phẩm</th>
                <th>Ảnh</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Tổng</th>
                <th></th>
            </tr>
            <?php foreach ($cart as $id => $item):
                $subtotal = $item['price'] * $item['quantity'];
                $total += $subtotal;
            ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                    <td><img src="./assets/products/<?php echo htmlspecialchars($item['image']); ?>"></td>
                    <td><?php echo number_format($item['price'], 0, ',', '.'); ?> VNĐ</td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td><?php echo number_format($subtotal, 0, ',', '.'); ?> VNĐ</td>
                    <td>
                        <form class="remove-item-form" method="POST" action="/demo-web/auth/remove-from-cart.php">
                            <input type="hidden" name="id_product" value="<?= $id ?>">
                            <button type="submit">Xóa sản phẩm</button>
                        </form>
                    </td>

                </tr>
            <?php endforeach; ?>
        </table>

        <h3>Tổng cộng: <?php echo number_format($total, 0, ',', '.'); ?> VNĐ</h3>
        <button id="checkout-btn">Thanh toán</button>
    <?php endif; ?>

</section>
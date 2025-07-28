<link rel="stylesheet" href="./styles/checkout.css">
<style>
   
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    background: #f5f5f5;
}


#checkout {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 40px 0;
}

.checkout-container {
    display: flex;
    gap: 30px;
    background: #fff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    max-width: 900px;
    width: 100%;
}


.checkout-left {
    flex: 1;
}

.checkout-left h2 {
    margin-bottom: 15px;
    font-size: 22px;
    color: #333;
}

.checkout-left form {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.checkout-left input,
.checkout-left textarea {
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 14px;
}

.checkout-left button {
    color: black;
    padding: 12px;
    border-radius: 6px;
    cursor: pointer;
    font-size: 15px;
    border: 1px solid #ccc;
    color: black;
}
  


.checkout-left button:hover {
    background-color: rgb(0, 0, 0);
    color: white;
    transition: all 0.5s ease;
}


.checkout-right {
    flex: 1;
    background: #fafafa;
    border-radius: 8px;
    padding: 20px;
    border: 1px solid #eee;
}

.checkout-right h2 {
    margin-bottom: 15px;
    font-size: 22px;
    color: #333;
}

.checkout-right ul {
    list-style: none;
    margin-bottom: 20px;
}

.checkout-right li {
    margin-bottom: 15px;
    padding-bottom: 10px;
    border-bottom: 1px solid #ddd;
    font-size: 14px;
    color: #444;
}

.checkout-right h3 {
    font-size: 20px;
    color: #d9534f;
    text-align: right;
}

</style>
<?php
session_start();
$cart = $_SESSION['cart'] ?? [];
$total = 0;
?>

<section id="checkout">
    <div class="checkout-container">
        <!-- Bên trái: Thông tin khách hàng -->
        <div class="checkout-left">
            <h2>Thông tin nhận hàng</h2>
            <form action="/demo-web/auth/handle-checkout.php" method="POST">
                <input type="text" name="name" placeholder="Họ tên" required>
                <input type="tel" name="phone" placeholder="Số điện thoại" required>
                <input type="email" name="email" placeholder="Email" required>
                <textarea name="address" placeholder="Địa chỉ nhận hàng" required></textarea>
                <button type="submit">Xác nhận đặt hàng</button>
            </form>
        </div>

        <!-- Bên phải: Danh sách sản phẩm trong giỏ -->
        <div class="checkout-right">
            <h2>Đơn hàng của bạn</h2>
            <?php if (empty($cart)): ?>
                <p>Giỏ hàng trống.</p>
            <?php else: ?>
                <ul>
                <?php foreach ($cart as $item): 
                    $subtotal = $item['price'] * $item['quantity'];
                    $total += $subtotal;
                ?>
                    <li>
                        <strong><?= htmlspecialchars($item['name']) ?></strong><br>
                        Số lượng: <?= $item['quantity'] ?><br>
                        Giá: <?= number_format($item['price'], 0, ',', '.') ?> VNĐ<br>
                        Thành tiền: <?= number_format($subtotal, 0, ',', '.') ?> VNĐ
                    </li>
                <?php endforeach; ?>
                </ul>
                <h3>Tổng cộng: <?= number_format($total, 0, ',', '.') ?> VNĐ</h3>
            <?php endif; ?>
        </div>
    </div>
</section>

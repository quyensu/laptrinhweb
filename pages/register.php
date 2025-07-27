<form action="/demo-web/auth/handleLogin.php" method="post">
    <h1>Đăng ki</h1>
    <input type="text" name="email" id="email" placeholder="Email" required> <br>
    <input type="password" name="password" id="password" placeholder="Mật khẩu" required> <br>
    <button type="submit">Đăng nhập</button> <br>
    <a href="index.php">Trở về</a> <br>
    <a href="#">Đăng kí</a>
    <?php if (isset($_GET['error'])): ?>
        <p>Tên đăng nhập hoặc mật khẩu không đúng.</p>
    <?php endif; ?>
</form>
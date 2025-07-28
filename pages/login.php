<link rel="stylesheet" href="./styles/login.css">

<form action="/demo-web/auth/handleLogin.php" method="post">
    <fieldset>
        <legend>ĐĂNG NHẬP</legend>
        <input type="text" name="email" id="email" placeholder="Email" required> <br>
        <input type="password" name="password" id="password" placeholder="Mật khẩu" required> <br>
        <button type="submit">Đăng nhập</button> <br>
        <a href="index.php">Trở về</a> <br>
        <a href="#" class="nav-link" data-page="signup">Đăng ký</a>
    </fieldset>

</form>
<link rel="stylesheet" href="./styles/login.css">

<form action="/demo-web/auth/handleSignup.php" method="post">
    <fieldset>
        <legend>ĐĂNG KÝ</legend>
        <input type="text" name="username" id="username" placeholder="Username" required> <br>
        <input type="email" name="email" id="email" placeholder="Email" required> <br>
        <input type="password" name="password" id="password" placeholder="Mật khẩu" required> <br>
        <button type="submit">Đăng ký</button> <br>
        <a href="index.php">Trở về</a> <br>
        <a href="#" class="nav-link" data-page="login">Đăng nhập</a>
    </fieldset>

</form>
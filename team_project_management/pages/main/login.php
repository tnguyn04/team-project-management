



<div class="login-container">
        <div class="login-form" id="loginForm">
            <h1>Đăng nhập</h1>
            <div class="social-icons">
                <a href="#" class="icon"><i class='bx bxl-google-plus'></i></a>
                <a href="#" class="icon"><i class='bx bxl-facebook'></i></a>
                <a href="#" class="icon"><i class='bx bxl-github'></i></a>
                <a href="#" class="icon"><i class='bx bxl-linkedin'></i></a>
            </div>

            <div class="form-message-container">
                <span>Hoặc sử dụng Email và mật khẩu</span>
            </div>

            <form action="" method="post">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Mật khẩu" required>
                <?php if (!empty($message)) echo $message; ?>
                <button type="submit" name="login">Đăng nhập</button>
                <a href="#">Quên mật khẩu?</a>
            </form>
            <p>Không có tài khoản? <a href="?page=register" id="showSignup">Đăng ký</a></p>
        </div>
</div>
<script src="././js/login.js"></script>
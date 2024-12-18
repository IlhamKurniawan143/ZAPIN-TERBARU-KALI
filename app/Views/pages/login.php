<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZAPIN-Masuk Akun</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <div class="container">
        <div class="left-side">
            <!-- Menambahkan logo-logo di atas gambar utama -->
            <img src="/assets/logo.png" alt="Logo ZAPIN" class="logo logo-zapin">
        </div>
        <div class="right-side">
            <form action="<?= base_url('/login/authenticate') ?>" method="POST" class="login-email">
                <p class="header-text" style="font-size: 3rem;">Masuk Akun</p>

                <!-- Error Message Display -->
                <?php if (isset($login_message)): ?>
                    <p class="error-message"><?= esc($login_message) ?></p>
                <?php endif; ?>
                
                <div class="input-group">
                    <input type="username" placeholder="Masukkan username" name="username" />
                </div>
                <div class="input-group">
                    <input type="email" placeholder="Masukkan email" name="email" />
                </div>
                <div class="input-group">
                    <input type="password" placeholder="Masukkan password" name="password" />
                </div>
                <!-- <p class="login-register-text">
                    <a href="forgot-password.php">Lupa Password?</a>
                </p> -->
                <div class="input-group">
                    <button class="btn" type="submit" name="Login">Masuk</button>
                </div>
                <p class="login-register-tex">Belum punya akun? <a href="<?= base_url('/register') ?>">Daftar</a></p>
            </form>
        </div>
    </div>
</body>
</html>
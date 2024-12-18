<?php if (session()->getFlashdata('register_message')) : ?>
    <i><?= session()->getFlashdata('register_message') ?></i>
<?php endif; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZAPIN-Daftar Akun</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <div class="container">
        <div class="left-side">
            <img src="/assets/logo.png" alt="Logo ZAPIN" class="logo logo-zapin">
        </div>
        <div class="right-side">
            <form action="<?= base_url('/register/authenticateRegister') ?>" method="POST" class="login-email">
                <p class="header-text" style="font-size: 3rem;">Buat Akun</p>

                <div class="input-group">
                    <input type="username" placeholder="Masukkan username" name="username" required />
                </div>
                <div class="input-group">
                    <input type="email" placeholder="Masukkan email" name="email" required />
                </div>
                <div class="input-group">
                    <input type="password" placeholder="Masukkan password" name="password" required />
                </div>

                <div class="input-group">
                    <label for="role">Daftar Sebagai:</label>
                    <select name="role" required>
                        <option value="">Pilih Peran</option>
                        <option value="pegawai">Pegawai</option>
                        <option value="pengajar">Pengajar</option>
                    </select>
                </div>

                <div class="input-group">
                    <label for="security_question">Pertanyaan Keamanan</label>
                    <select name="security_question" required>
                        <option value="Siapa nama hewan peliharaan pertama Anda?">Siapa nama hewan peliharaan pertama Anda?</option>
                        <option value="Di mana kota kelahiran ibu Anda?">Di mana kota kelahiran ibu Anda?</option>
                        <option value="Apa makanan favorit Anda?">Apa makanan favorit Anda?</option>
                    </select>
                </div>
                <div class="input-group">
                    <input type="text" placeholder="Jawaban keamanan" name="security_answer" required>
                </div>
                <div>
                    <p><a href="forgot-password.php">Lupa password?</a></p>
                </div>
                <div class="input-group">
                    <button class="btn" type="submit" name="register">Buat</button>
                </div>
                <p class="login-register-text">Sudah punya akun? <a href="<?= base_url('/login') ?>">Log in</a></p>
            </form>
        </div>
    </div>
</body>

</html>
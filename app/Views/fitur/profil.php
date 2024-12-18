<?= $this->extend('layout/temp'); ?>

<?= $this->section('content'); ?>
<div class="wrapper">
    <main class="content">
        <h2>Profil Anda</h2>

        <div class="input-group">
            <label>Nama:</label>
            <p><?= esc($username); ?></p> <!-- Menampilkan nama pengguna -->
        </div>
        <div class="input-group">
            <label>Email:</label>
            <p><?= esc($email); ?></p> <!-- Menampilkan email pengguna -->
        </div>
        <div class="input-group">
            <label>Role:</label>
            <p><?= esc($role); ?></p> <!-- Menampilkan role pengguna -->
        </div>

        <!-- Form untuk logout -->
        <form action="<?= site_url('logout'); ?>" method="POST">
            <button type="submit" class="btn">Logout</button>
        </form>
    </main>
</div>

<style>
    /* Wrapper untuk seluruh konten */
.wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: #f4f4f4;
}

/* Bagian konten utama */
.content {
    max-width: 500px;
    width: 100%;
    background-color: #ffffff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    margin-top: 30px;
    text-align: center;
}

/* Judul halaman */
h2 {
    font-size: 24px;
    color: #333;
    margin-bottom: 20px;
    font-weight: bold;
}

/* Grup input untuk setiap elemen profil */
.input-group {
    margin-bottom: 20px;
    text-align: left;
}

/* Gaya label untuk setiap bagian profil */
.input-group label {
    display: block;
    font-size: 16px;
    color: #333;
    margin-bottom: 8px;
    font-weight: bold;
}

/* Menampilkan data profil pengguna */
.input-group p {
    font-size: 16px;
    color: #666;
    margin-top: 5px;
}

/* Gaya untuk tombol logout */
.btn {
    display: inline-block;
    width: 100%;
    padding: 12px;
    background-color: #333;
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 14px;
    font-weight: bold;
    text-transform: uppercase;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn:hover {
    background-color: #555;
}

/* Responsif untuk tampilan layar kecil */
@media screen and (max-width: 768px) {
    .content {
        padding: 15px;
    }

    .btn {
        width: 100%;
        margin-top: 20px;
    }

    .input-group {
        margin-bottom: 20px;
    }
}

</style>
<?= $this->endSection(); ?>
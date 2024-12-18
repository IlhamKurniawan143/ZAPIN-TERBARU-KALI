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
<?= $this->endSection(); ?>
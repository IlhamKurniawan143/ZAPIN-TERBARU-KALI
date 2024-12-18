<?= $this->extend('layout/temp'); ?>

<?= $this->section('content'); ?>
<div class="wrapper">
    <main class="content">
        <h2>Buat Kelas Baru</h2>

        <!-- Menampilkan pesan jika ada -->
        <?php if (!empty($create_message)): ?>
        <i><?= esc($create_message); ?></i>
        <?php endif; ?>

        <form action="<?= site_url('/dashboard_pengajar/create-kelas'); ?>" method="POST">
            <div class="input-group">
                <label for="class_name">Nama Kelas</label>
                <input type="text" name="class_name" id="class_name" required>
            </div>
            <div class="input-group">
                <label for="class_description">Deskripsi Kelas</label>
                <textarea name="class_description" id="class_description" required></textarea>
            </div>
            <div class="input-group">
                <button type="submit" class="btn">Buat</button>
                <button type="button" class="btn"
                    onclick="window.location.href='<?= site_url('/dashboard-pengajar/buatkelas'); ?>'">Batal</button>
            </div>
        </form>
    </main>
</div>

<?= $this->endSection(); ?>
<?= $this->extend('layout/temp'); ?>

<?= $this->section('content'); ?>

<div class="wrapper">
    <main class="content">
        <!-- <h2>Daftar Kelas Anda</h2> -->
        <div class="class-grid">
            <?php if (!empty($classes)): ?>
                <?php foreach ($classes as $class): ?>
                    <div class="class-box">
                        <h3><?= $class['class_name'] ?></h3>
                        <p><?= $class['class_description'] ?></p>
                        <a href="/dashboard_pegawai/detailkelas/<?= $class['id'] ?>" class="btn">Lihat Detail</a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="no-classes">
                    <p>Anda belum bergabung ke kelas mana pun.</p>
                    <!-- <a href="/kelas" class="btn">Jelajahi Kelas</a> -->
                </div>
            <?php endif; ?>
        </div>
    </main>
</div>

<?= $this->endSection(); ?>
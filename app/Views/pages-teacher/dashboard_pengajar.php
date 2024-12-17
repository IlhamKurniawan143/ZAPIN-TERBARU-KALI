<?= $this->extend('layout/temp'); ?>

<?= $this->section('content'); ?>

<div class="wrapper">
    <main class="content">
        <div class="class-grid">
            <?php if (!empty($classes)): ?>
                <?php foreach ($classes as $class): ?>
                    <div class="class-box">
                        <h3><?= $class['class_name'] ?></h3>
                        <p><?= $class['class_description'] ?></p>
                        <a href="#" class="btn">Lihat Detail</a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Anda belum membuat kelas.</p>
            <?php endif; ?>
        </div>
    </main>
</div>

<?= $this->endSection(); ?>
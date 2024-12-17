<?= $this->extend('layout/temp'); ?>

<?= $this->section('content'); ?>

<div class="wrapper">
    <main class="content">
        <h2>Gabung Kelas</h2>
        <i><?= esc($join_message) ?></i>
        <form action="<?= ('fitur/gabungKelas') ?>" method="post">
            <div class="input-group">
                <label for="class_code">Masukkan Kode Kelas</label>
                <input type="text" name="class_code" id="class_code" required>
            </div>
            <div class="input-group">
                <button type="submit" name="join_class" class="btn">Gabung Kelas</button>
            </div>
        </form>
    </main>
</div>

<?= $this->endsection(); ?>
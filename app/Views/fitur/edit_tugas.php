<?= $this->extend('layout/temp'); ?>

<?= $this->section('content'); ?>

<div class="wrapper">
    <main class="content">
        <h2>Edit Tugas</h2>
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= base_url("/kelas/updateTask/{$task['id']}") ?>" method="POST" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="input-group">
                <label for="task_name">Nama Tugas:</label>
                <input type="text" name="task_name" id="task_name" value="<?= esc($task['task_name']) ?>" required>
            </div>
            <div class="input-group">
                <label for="task_description">Deskripsi Tugas:</label>
                <textarea name="task_description" id="task_description" required><?= esc($task['task_description']) ?></textarea>
            </div>
            <div class="input-group">
                <label for="attachment">Lampiran:</label>
                <input type="file" name="attachment" id="attachment">
                <?php if (!empty($task['attachment_path'])): ?>
                    <small>File saat ini: <a href="<?= base_url($task['attachment_path']) ?>" target="_blank">Lihat Lampiran</a></small>
                <?php endif; ?>
            </div>
            <div class="input-group">
                <button type="submit" class="btn">Perbarui Tugas</button>
            </div>
        </form>
    </main>
</div>

<style>
    /* Wrapper untuk membungkus konten utama */
    .wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: #f9f9f9;
    }

    /* Konten utama */
    .content {
        max-width: 600px;
        width: 100%;
        background-color: #ffffff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border: 1px solid #ddd;
    }

    /* Judul halaman */
    h2 {
        font-size: 24px;
        color: #333;
        margin-bottom: 20px;
        font-weight: bold;
        text-align: center;
    }

    /* Alert untuk menampilkan pesan error */
    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 5px;
        color: #721c24;
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
    }

    /* Daftar pesan error */
    .alert ul {
        margin: 0;
        padding-left: 20px;
    }

    /* Grup input */
    .input-group {
        margin-bottom: 20px;
    }

    /* Label untuk input */
    .input-group label {
        display: block;
        font-size: 16px;
        color: #333;
        margin-bottom: 8px;
        font-weight: normal;
    }

    /* Input field */
    .input-group input[type="text"],
    .input-group textarea,
    .input-group input[type="file"] {
        width: 100%;
        padding: 10px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
        resize: none;
    }

    /* Gaya khusus untuk textarea */
    .input-group textarea {
        height: 100px;
    }

    /* Gaya untuk file lampiran */
    .input-group small {
        display: block;
        margin-top: 5px;
        font-size: 12px;
        color: #007bff;
    }

    /* Gaya untuk tombol */
    .btn {
        display: inline-block;
        width: 100%;
        padding: 12px;
        background-color: #333;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 14px;
        font-weight: bold;
        text-transform: uppercase;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn:hover {
        background-color: #555;
    }

    /* Responsif untuk layar lebih kecil */
    @media screen and (max-width: 768px) {
        .content {
            padding: 20px;
        }
    }
</style>
<?= $this->endSection(); ?>
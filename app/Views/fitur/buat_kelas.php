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

<style>
    /* Wrapper untuk form */
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

/* Judul form */
.content h2 {
    font-size: 24px;
    color: #333;
    font-weight: bold;
    margin-bottom: 20px;
}

/* Pesan untuk create message */
.content i {
    display: block;
    margin-bottom: 20px;
    font-size: 14px;
    color: #28a745;
}

/* Gaya untuk grup input */
.input-group {
    margin-bottom: 15px;
    text-align: left;
}

/* Gaya label input */
.input-group label {
    display: block;
    font-size: 16px;
    color: #333;
    margin-bottom: 8px;
}

/* Gaya input text dan textarea */
.input-group input,
.input-group textarea {
    width: 100%;
    padding: 12px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 6px;
    box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
    margin-top: 5px;
}

.input-group textarea {
    resize: vertical;
    min-height: 120px;
}

/* Gaya tombol */
.btn {
    display: inline-block;
    width: 48%;
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
    text-align: center;
}

/* Hover effect pada tombol */
.btn:hover {
    background-color: #555;
}

/* Tombol batal (warna lebih ringan) */
.btn[type="button"] {
    background-color: #ccc;
    width: 48%;
}

/* Responsif untuk tampilan layar kecil */
@media screen and (max-width: 768px) {
    .content {
        padding: 15px;
    }

    .btn {
        width: 100%;
        margin-bottom: 10px;
    }

    .input-group {
        margin-bottom: 20px;
    }
}

</style>

<?= $this->endSection(); ?>
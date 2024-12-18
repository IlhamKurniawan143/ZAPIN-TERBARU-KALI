<?= $this->extend('layout/temp'); ?>

<?= $this->section('content'); ?>

<div class="wrapper">
    <div class="content">
        <div class="card">
            <h2 class="card-title">Gabung Kelas</h2>
            <p class="card-message"><?= esc($join_message) ?></p>
            <form action="<?= base_url('fitur/gabungKelas') ?>" method="post" class="form-container">
                <?= csrf_field() ?>
                <div class="input-group">
                    <label for="class_code" class="input-label">Masukkan Kode Kelas</label>
                    <input type="text" name="class_code" id="class_code" class="input-field" placeholder="Kode Kelas"
                        required>
                </div>
                <div class="input-group">
                    <button type="submit" name="join_class" class="btn-primary">Gabung</button>
                </div>
            </form>
        </div>
    </div>
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
.card-title {
    font-size: 24px;
    color: #333;
    font-weight: bold;
    margin-bottom: 20px;
}

/* Pesan untuk join message */
.card-message {
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
.input-label {
    display: block;
    font-size: 16px;
    color: #333;
    margin-bottom: 8px;
}

/* Gaya input field */
.input-field {
    width: 100%;
    padding: 12px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 6px;
    box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
}

/* Gaya tombol primary */
.btn-primary {
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

.btn-primary:hover {
    background-color: #555;
}

/* Responsif untuk tampilan layar kecil */
@media screen and (max-width: 768px) {
    .content {
        padding: 15px;
    }

    .btn-primary {
        width: 100%;
        margin-bottom: 10px;
    }

    .input-group {
        margin-bottom: 20px;
    }
}

</style>

<?= $this->endSection(); ?>
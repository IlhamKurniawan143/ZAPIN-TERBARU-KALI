<?php

use Config\Session;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?= base_url('css/navsidebar.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/student.css'); ?>">
    <!-- Link Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <header>
        <nav class="navbar" id="navbar">
            <div id="menu-toggle" class="burger-menu" onclick="toggleSidebar()">
                &#9776;
            </div>
        </nav>
    </header>

    <aside class="sidebar" id="sidebar">

        <div class="logo">
            <img src="<?= base_url('assets/lg.png') ?>" alt="Logo">
        </div>

        <ul>
            <li>
                <a
                    href="<?= session()->get('role') === 'pegawai'? ('/dashboard_pegawai') : ('/dashboard_pengajar'); ?>"><i
                        class="fa fa-home"></i>Beranda</a>
            </li>
            <li><a href="<?= ('/gabung_kelas') ?>"><i class="fa fa-book"></i>Gabung Kelas</a></li>
            <?php if (session()->get('role') === 'pengajar'): ?>
            <li><a href="/dashboard_pengajar/buatkelas"><i class="fa fa-pencil-alt"></i>Buat Kelas</a></li>
            <?php endif; ?>
            <li><a href="/dashboard_pengajar/profile"><i class="fa fa-user"></i>Profil</a></li>
        </ul>
    </aside>

    <?= $this->renderSection('content'); ?>

    <script src="<?= base_url('js/scripts.js') ?>"></script>

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?= $title; ?> </title>
    <link rel="stylesheet" href="<?= base_url('css/style.css'); ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div id="main-content">
        <nav class="navbar">
            <div class="logo">
                <a href="/">
                    <img src="<?= base_url('assets/logo.png'); ?>" alt="Logo">
                    <!-- <img src="assets/logo.png" alt="MyWebsite Logo"> -->
                </a>
            </div>
            <div class="menu">
                <a href="/">Beranda</a>
                <a href="/pages/artikel">Artikel</a>
                <a href="/pages/tips">Tips</a>
                <a href="/pages/resep">Resep</a>
                <a href="/pages/tentang">Tentang Kami</a>
            </div>
            <div class="search-container">
                <span class="search-icon">&#128269;</span>
                <input type="text" name="search-input" placeholder="Cari..">
            </div>
        </nav>

        <?= $this->renderSection('content'); ?>

        <footer>
            <div class="footer-links">
                <a href="#">Home</a>
                <a href="#">Tentang Kami</a>
                <a href="#">Kontak</a>
            </div>
            <div class="social-icons">
                <i class='bx bxl-facebook'></i>
                <i class='bx bxl-instagram'></i>
                <i class='bx bxl-twitter'></i>
            </div>
            <p>&copy; © 2024 SehatKu™. All Rights Reserved.</p>
        </footer>
    </div>

    <script>
        const sliderWrapper = document.querySelector('.slider-wrapper');
        const images = document.querySelectorAll('.slider-wrapper img');
        const totalImages = images.length;
        let currentIndex = 0;

        // Clone the first image and append it to the end
        const firstImageClone = images[0].cloneNode(true);
        sliderWrapper.appendChild(firstImageClone);

        // Fungsi untuk menggeser gambar
        function changeImage() {
            currentIndex++;

            // Jika sudah mencapai gambar terakhir
            if (currentIndex > totalImages) {
                currentIndex = 0; // Reset ke gambar kedua (cloned image di akhir)
                sliderWrapper.style.transition = 'none'; // Nonaktifkan transisi untuk langsung kembali
                sliderWrapper.style.transform = `translateX(-${currentIndex * 100}%)`;
                // Setelah reset, kita tunggu sejenak sebelum mengaktifkan transisi lagi
                setTimeout(() => {
                    sliderWrapper.style.transition = 'transform 0.5s ease-in-out'; // Aktifkan kembali transisi
                }, 20); // Delay kecil untuk memastikan transisi diaktifkan kembali
            } else {
                sliderWrapper.style.transition = 'transform 0.5s ease-in-out'; // Aktifkan transisi
                sliderWrapper.style.transform = `translateX(-${currentIndex * 100}%)`;
            }
        }

        // Set interval untuk berganti gambar setiap 3 detik
        setInterval(changeImage, 3000);
    </script>




</body>

</html>
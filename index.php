<?php 
session_start();
require_once "config/koneksi.php"; 
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Beranda</title>

<<<<<<< HEAD
<link rel="stylesheet" href="/proyekPBL-1E-5/assets/css/style.css">
<link rel="stylesheet" href="/proyekPBL-1E-5/assets/css/footer.css">
<link rel="stylesheet" href="/proyekPBL-1E-5/assets/css/home_extra.css">
=======
<link rel="stylesheet" href="/ProyekPBL-1E-5/assets/css/style.css">

>>>>>>> 3cdbf79c7137e21f59cd2a8c7e5656cb38e4e55b
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
</head>

<body>
<<<<<<< HEAD
=======
  <header>
    <h1 class="logo-container">
      <img src="/ProyekPBL-1E-5/assets/img/Logo Polibatam1.png" class="logo-header" alt="Logo Aplikasi">
      <span class="logo-text">polibatam</span>
    </h1>
>>>>>>> 3cdbf79c7137e21f59cd2a8c7e5656cb38e4e55b

<header class="main-header">
    <div class="logo-container">
        <img src="/proyekPBL-1E-5/assets/img/Logo Politeknik.png" class="logo-header" alt="Logo Polibatam">
    </div>

    <nav class="nav-menu">
        <a href="index.php" class="active">
            <i class="fa-solid fa-house"></i> Beranda
        </a>
        <a href="tentang.php">
            <i class="fa-solid fa-circle-info"></i> Tentang
        </a>
        <a href="login.php" class="login-btn">
            <i class="fa-solid fa-right-to-bracket"></i> Login
        </a>
    </nav>
</header>

<!-- HERO -->
<section class="hero">
    <div class="hero-content">
        <h2>Selamat Datang di Pengumuman Akademik Online</h2>
        <p>
            Sistem resmi untuk mengakses pengumuman kampus, jadwal ujian,
            serta informasi akademik mahasiswa Polibatam.
        </p>
    </div>
</section>

<!-- PENGUMUMAN -->
<section class="section">
    <div class="section-header">
        <h2><i class="fa-solid fa-bullhorn"></i> Pengumuman Terbaru</h2>
        <p class="section-desc">Beberapa informasi akademik terbaru untuk mahasiswa</p>
    </div>

    <div class="cards">
        <?php
        $query = mysqli_query($koneksi, "
            SELECT * FROM pengumuman
            WHERE untuk_mahasiswa = 1 OR untuk_mahasiswa IS NULL
            ORDER BY dibuat_pada DESC
            LIMIT 3
        ");

        if (mysqli_num_rows($query) == 0) {
            echo "<p style='text-align:center;'>Belum ada pengumuman.</p>";
        }

        while ($row = mysqli_fetch_assoc($query)) {
        ?>
            <div class="card">
                <h3><?= htmlspecialchars($row['judul']); ?></h3>
                <p>
                    <?= nl2br(substr(htmlspecialchars($row['isi']), 0, 160)); ?>...
                </p>
                <small style="color:#666;">
                    <?= date("d M Y", strtotime($row['dibuat_pada'])); ?>
                </small>
            </div>
        <?php } ?>
    </div>
</section>

<!-- CTA -->
<section class="cta">
    <h3>Ingin melihat semua pengumuman akademik?</h3>
    <a href="login.php" class="cta-btn">Lihat Selengkapnya</a>
</section>

<?php include "components_admin/footer.php"; ?>

</body>
</html>

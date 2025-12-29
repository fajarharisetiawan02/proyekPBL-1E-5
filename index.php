<?php 
session_start();
<<<<<<< HEAD
require_once "config/koneksi.php";
?>
=======
<<<<<<< HEAD
require_once "config/koneksi.php";
?>
=======
require_once "config/koneksi.php"; 
?>

>>>>>>> 9a567987dd90af1392f8d15dfcbd79423ecb4815
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Beranda</title>

<link rel="stylesheet" href="/proyekPBL-1E-5/assets/css/style.css">
<link rel="stylesheet" href="/proyekPBL-1E-5/assets/css/footer.css">
<link rel="stylesheet" href="/proyekPBL-1E-5/assets/css/beranda-tambahan.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
</head>

<body>

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
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e

        <a href="#pengumuman" class="hero-btn">
            Lihat Pengumuman Terbaru
        </a>
    </div>
</section>
<<<<<<< HEAD

<!-- PENGUMUMAN TERBARU -->
<section class="section" id="pengumuman">
    <div class="section-header">
        <h2><i class="fa-solid fa-bullhorn"></i> Pengumuman Terbaru</h2>
        <p class="section-desc">
            Informasi akademik terbaru yang diperbarui oleh admin Polibatam
        </p>
    </div>

    <div class="announcement-list">

        <?php
        $query = mysqli_query($koneksi, "
            SELECT * FROM pengumuman
            WHERE untuk_mahasiswa = 1 OR untuk_mahasiswa IS NULL
            ORDER BY dibuat_pada DESC
            LIMIT 4
        ");

        if (mysqli_num_rows($query) == 0) {
            echo "<p style='text-align:center;'>Belum ada pengumuman.</p>";
        }

        while ($row = mysqli_fetch_assoc($query)) {
            $tanggal = strtotime($row['dibuat_pada']);
            $hari_ini = strtotime(date('Y-m-d'));
            $selisih_hari = ($hari_ini - $tanggal) / (60 * 60 * 24);
        ?>
            <div class="announcement-item">
                <div class="announcement-content">
                    <h3>
                        <?php if ($selisih_hari <= 3) { ?>
                            <span class="badge-new">TERBARU</span>
                        <?php } ?>
                        <?= htmlspecialchars($row['judul']); ?>
                    </h3>

                    <p>
                        <?= substr(strip_tags($row['isi']), 0, 140); ?>...
                    </p>
                </div>

                <div class="announcement-meta">
                    <span>
                        <i class="fa-regular fa-calendar"></i>
                        <?= date("d M Y", strtotime($row['dibuat_pada'])); ?>
                    </span>
                </div>
            </div>
        <?php } ?>

    </div>
</section>

<!-- CTA -->
<section class="cta">
    <h3>Ingin melihat semua pengumuman akademik?</h3>
    <p class="cta-desc">
        Pengumuman lengkap hanya dapat diakses oleh pengguna terdaftar.
    </p>

<?php if (!isset($_SESSION['role'])) { ?>
    <a href="login.php" class="cta-btn">Lihat Selengkapnya</a>
<?php } else { ?>
    <a href="pengumuman.php" class="cta-btn">Lihat Selengkapnya</a>
<?php } ?>
=======

<!-- PENGUMUMAN TERBARU -->
<section class="section" id="pengumuman">
    <div class="section-header">
        <h2><i class="fa-solid fa-bullhorn"></i> Pengumuman Terbaru</h2>
        <p class="section-desc">
            Informasi akademik terbaru yang diperbarui oleh admin Polibatam
        </p>
    </div>

    <div class="announcement-list">

        <?php
        $query = mysqli_query($koneksi, "
            SELECT * FROM pengumuman
            WHERE untuk_mahasiswa = 1 OR untuk_mahasiswa IS NULL
            ORDER BY dibuat_pada DESC
            LIMIT 4
        ");

        if (mysqli_num_rows($query) == 0) {
            echo "<p style='text-align:center;'>Belum ada pengumuman.</p>";
        }

        while ($row = mysqli_fetch_assoc($query)) {
            $tanggal = strtotime($row['dibuat_pada']);
            $hari_ini = strtotime(date('Y-m-d'));
            $selisih_hari = ($hari_ini - $tanggal) / (60 * 60 * 24);
        ?>
            <div class="announcement-item">
                <div class="announcement-content">
                    <h3>
                        <?php if ($selisih_hari <= 3) { ?>
                            <span class="badge-new">TERBARU</span>
                        <?php } ?>
                        <?= htmlspecialchars($row['judul']); ?>
                    </h3>

                    <p>
                        <?= substr(strip_tags($row['isi']), 0, 140); ?>...
                    </p>
                </div>

                <div class="announcement-meta">
                    <span>
                        <i class="fa-regular fa-calendar"></i>
                        <?= date("d M Y", strtotime($row['dibuat_pada'])); ?>
                    </span>
                </div>
            </div>
        <?php } ?>

    </div>
</section>

<!-- CTA -->
<section class="cta">
    <h3>Ingin melihat semua pengumuman akademik?</h3>
    <p class="cta-desc">
        Pengumuman lengkap hanya dapat diakses oleh pengguna terdaftar.
    </p>

<?php if (!isset($_SESSION['role'])) { ?>
    <a href="login.php" class="cta-btn">Lihat Selengkapnya</a>
<?php } else { ?>
    <a href="pengumuman.php" class="cta-btn">Lihat Selengkapnya</a>
<?php } ?>
=======
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
>>>>>>> 9a567987dd90af1392f8d15dfcbd79423ecb4815
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
</section>

<?php include "components_admin/footer.php"; ?>

</body>
</html>

<?php
require_once "../config/auth.php";
require_once "../config/koneksi.php";


$nama = $_SESSION['nama'];

//  AMBIL DATA OTOMATIS DARI DB

$pengumuman = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pengumuman"))['total'];
$jadwal     = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM jadwal_ujian"))['total'];
$sks        = 78;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Aplikasi Pengumuman Akademik</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.lineicons.com/5.0/lineicons.css" rel="stylesheet" />


    <link rel="stylesheet" href="../assets/css/style2.css">
</head>

<body>

<div class="main-wrapper">

    <!-- SIDEBAR -->
    <?php include "../components_admin/sidebar.php"; ?>

    <!-- TOPBAR -->
    <?php include "../components_admin/topbar.php"; ?>

    <!-- MAIN CONTENT -->
    <div class="main-content">

        <div class="content-container">

            <!-- HERO SECTION -->
            <section class="hero fade-in">
                <h2>Selamat Datang, <?= $nama; ?>!</h2>
                <p>Kelola informasi akademik dengan cepat & efisien.</p>
            </section>

            <div class="news-bar fade-in">
                <marquee>
                    🔔 Ruang kuliah BQ11 pindah ke BQ12 |
                    🎓 Pendaftaran Beasiswa Gelombang 1 Dibuka |
                    📅 Cek Jadwal UTS Terbaru di Menu Jadwal
                </marquee>
            </div>

            <h3 class="section-title">Kategori Pengumuman</h3>

            <div class="cards fade-in">

                <a href="jadwal_ujian.php" class="card">
                    <i class="fa-solid fa-calendar-days"></i>
                    <h3>Jadwal Ujian</h3>
                    <p>Lihat pengumuman terkait jadwal ujian</p>
                </a>

                <a href="perkuliahan.php" class="card">
                    <i class="fa-solid fa-chalkboard-user"></i>
                    <h3>Perkuliahan</h3>
                    <p>Informasi kegiatan perkuliahan</p>
                </a>

                <a href="perubahan_kelas.php" class="card">
                    <i class="fa-solid fa-arrows-rotate"></i>
                    <h3>Perubahan Kelas</h3>
                    <p>Pemberitahuan perubahan kelas</p>
                </a>

                <a href="beasiswa.php" class="card">
                    <i class="fa-solid fa-graduation-cap"></i>
                    <h3>Beasiswa</h3>
                    <p>Informasi mengenai beasiswa</p>
                </a>

            </div>

            <section class="stats fade-in">

                <div class="stat">
                    <i class="fa-solid fa-bullhorn"></i>
                    <div>
                        <div class="num count" id="stat_pengumuman" data-value="<?= $pengumuman ?>">0</div>
                        <div class="sub">Pengumuman Baru</div>
                    </div>
                </div>

                <div class="stat">
                    <i class="fa-solid fa-calendar-days"></i>
                    <div>
                        <div class="num count" id="stat_jadwal" data-value="<?= $jadwal ?>">0</div>
                        <div class="sub">Jadwal Minggu Ini</div>
                    </div>
                </div>

                <div class="stat">
                    <i class="fa-solid fa-graduation-cap"></i>
                    <div>
                        <div class="num count" id="stat_sks" data-value="<?= $sks ?>">0</div>
                        <div class="sub">SKS Lulus</div>
                    </div>
                </div>

            </section>

            <h3 class="section-title" style="margin-top:30px;">Statistik Akademik</h3>

            <div class="chart-wrapper fade-in">

                <div class="chart-card">
                    <h4>Grafik Pengumuman</h4>
                    <canvas id="chartPengumuman"></canvas>
                </div>

                <div class="chart-card">
                    <h4>Grafik Mahasiswa Aktif</h4>
                    <canvas id="chartMahasiswa"></canvas>
                </div>

            </div>

        </div>

    </div>

</div>

<footer>
    © 2025 Aplikasi Pengumuman Akademik Online | Politeknik Negeri Batam
</footer>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

<script src="../assets/js/script3.js"></script>

</body>
</html>

<?php
require_once "../config/auth_mahasiswa.php";
require_once "../config/koneksi.php";

// =======================
// DATA STATISTIK REAL
// =======================
$pengumuman = mysqli_fetch_assoc(
    mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pengumuman")
)['total'] ?? 0;

$jadwal = mysqli_fetch_assoc(
    mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM jadwal_ujian")
)['total'] ?? 0;

$perubahan_kelas = mysqli_fetch_assoc(
    mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM perubahan_kelas")
)['total'] ?? 0;

$beasiswa = mysqli_fetch_assoc(
    mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM beasiswa")
)['total'] ?? 0;

// =======================
// SKS (sementara)
// =======================
$sks = 0;
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="icon" type="image/png" href="../assets/img/Logo Politeknik.png">
<link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style2.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
    <link rel="stylesheet" href="../assets/css/dashboard-mahasiswa.css">
</head>

<body class="dashboard mahasiswa">

    <div class="main-wrapper">

        <?php include "../components_mahasiswa/sidebar.php"; ?>
        <?php include "../components_mahasiswa/topbar.php"; ?>

        <div class="main-content">
            <div class="content-container">

                <!-- HERO -->
                <section class="hero fade-in">
                    <h2>Selamat Datang, <?= htmlspecialchars($nama); ?> 👋</h2>
                    <p>Kelola informasi akademik dengan cepat dan efisien.</p>
                </section>

                <!-- MENU AKADEMIK -->
                <h3 class="section-title">Menu Akademik</h3>

                <div class="cards fade-in">
                    <a href="jadwal_ujian.php" class="card">
                        <i class="fa-solid fa-calendar-days"></i>
                        <h3>Jadwal Ujian</h3>
                        <p>Informasi jadwal ujian terbaru</p>
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
                        <p>Informasi dan pengumuman beasiswa</p>
                    </a>
                </div>

                <!-- RINGKASAN AKADEMIK -->
                <section class="ringkasan-akademik">

                    <h2 class="judul-ringkasan">Ringkasan Akademik</h2>

                    <div class="ringkasan-grid">

                        <div class="card-ringkasan">
                            <div class="card-icon icon-pengumuman">
                                <i class="fa-solid fa-bullhorn"></i>
                            </div>
                            <div>
                                <div class="card-number"><?= $pengumuman; ?></div>
                                <div class="card-label">Pengumuman</div>
                            </div>
                        </div>

                        <div class="card-ringkasan">
                            <div class="card-icon icon-ujian">
                                <i class="fa-solid fa-calendar-days"></i>
                            </div>
                            <div>
                                <div class="card-number"><?= $jadwal; ?></div>
                                <div class="card-label">Jadwal Ujian</div>
                            </div>
                        </div>

                        <div class="card-ringkasan">
                            <div class="card-icon icon-perubahan">
                                <i class="fa-solid fa-arrows-rotate"></i>
                            </div>
                            <div>
                                <div class="card-number"><?= $perubahan_kelas; ?></div>
                                <div class="card-label">Perubahan Kelas</div>
                            </div>
                        </div>

                        <div class="card-ringkasan">
                            <div class="card-icon icon-beasiswa">
                                <i class="fa-solid fa-graduation-cap"></i>
                            </div>
                            <div>
                                <div class="card-number"><?= $beasiswa; ?></div>
                                <div class="card-label">Beasiswa</div>
                            </div>
                        </div>

                    </div>

            </div>
            </section>

        </div>
    </div>
    </div>

    <footer>
        © 2025 Aplikasi Pengumuman Akademik Online | Politeknik Negeri Batam
    </footer>

    <script src="../assets/js/script3.js"></script>

</body>

</html>

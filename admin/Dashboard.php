<?php
date_default_timezone_set('Asia/Jakarta');

require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";

/* ===============================
   FIX TIME AGO (FINAL)
   TANPA UBAH TAMPILAN
================================ */
function timeAgo($datetime) {
    if (!$datetime) return '-';

    $timestamp = strtotime($datetime);
    $now = time();

    // jaga kalau timestamp DB lebih besar
    if ($timestamp > $now) {
        $timestamp = $now;
    }

    $diff = $now - $timestamp;

    if ($diff < 60) {
        return 'baru saja';
    } elseif ($diff < 3600) {
        return floor($diff / 60) . ' menit lalu';
    } elseif ($diff < 86400) {
        return floor($diff / 3600) . ' jam lalu';
    } else {
        return date('d M Y H:i', $timestamp);
    }
}

/* ===============================
   INSIGHT AKADEMIK (FIX FINAL)
================================ */

// kategori terbanyak
$qKategori = mysqli_query($koneksi, "
    SELECT kategori, COUNT(*) total
    FROM pengumuman
    GROUP BY kategori
    ORDER BY total DESC
    LIMIT 1
");

$rowKategori = mysqli_fetch_assoc($qKategori);
$kategori_terbanyak = $rowKategori['kategori'] ?? '-';

// pengumuman terakhir
$qTerakhir = mysqli_query($koneksi, "
    SELECT dibuat_pada
    FROM pengumuman
    ORDER BY dibuat_pada DESC
    LIMIT 1
");

$rowTerakhir = mysqli_fetch_assoc($qTerakhir);
$pengumuman_terakhir = $rowTerakhir
    ? date('d M Y', strtotime($rowTerakhir['dibuat_pada']))
    : '-';

$nama = $_SESSION['nama'] ?? 'Admin';

/* ===============================
   DATA RINGKASAN (TIDAK DIUBAH)
================================ */
$pengumuman = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) total FROM pengumuman"))['total'];
$jadwal = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) total FROM jadwal_ujian"))['total'];
$perubahan_kelas = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) total FROM perubahan_kelas"))['total'];
$beasiswa = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) total FROM beasiswa"))['total'];

/* ===============================
   AKTIVITAS TERAKHIR (FIX)
================================ */
$aktivitas = mysqli_query($koneksi, "
    SELECT aktivitas, created_at
    FROM aktivitas_admin
    ORDER BY created_at DESC
    LIMIT 5
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/png" href="../assets/img/Logo Politeknik.png">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style2.css">
    <link rel="stylesheet" href="../assets/css/dashboard_admin.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
</head>

<body class="dashboard admin">

<div class="main-wrapper">
    <?php include "../components_admin/sidebar.php"; ?>
    <?php include "../components_admin/topbar.php"; ?>

    <div class="main-content">
        <div class="content-container">

            <section class="hero fade-in">
                <h2>Selamat Datang, <?= $nama; ?> 👋</h2>
                <p>Kelola pengumuman dan informasi akademik secara terpusat.</p>
            </section>

            <section class="ringkasan-akademik">
                <h2 class="judul-ringkasan">Ringkasan Akademik</h2>
                <div class="ringkasan-grid">

                    <div class="card-ringkasan">
                        <div class="card-icon icon-pengumuman"><i class="fa-solid fa-bullhorn"></i></div>
                        <div><div class="card-number"><?= $pengumuman; ?></div><div class="card-label">Pengumuman</div></div>
                    </div>

                    <div class="card-ringkasan">
                        <div class="card-icon icon-ujian"><i class="fa-solid fa-calendar-days"></i></div>
                        <div><div class="card-number"><?= $jadwal; ?></div><div class="card-label">Jadwal Ujian</div></div>
                    </div>

                    <div class="card-ringkasan">
                        <div class="card-icon icon-perubahan"><i class="fa-solid fa-arrows-rotate"></i></div>
                        <div><div class="card-number"><?= $perubahan_kelas; ?></div><div class="card-label">Perubahan Kelas</div></div>
                    </div>

                    <div class="card-ringkasan">
                        <div class="card-icon icon-beasiswa"><i class="fa-solid fa-graduation-cap"></i></div>
                        <div><div class="card-number"><?= $beasiswa; ?></div><div class="card-label">Beasiswa</div></div>
                    </div>

                </div>
            </section>

            <!-- INSIGHT AKADEMIK -->
            <section class="insight-akademik fade-in">
                <h3 class="section-title">Insight Akademik</h3>
                <div class="insight-card">
                    <ul class="insight-list">
                        <li><i class="fa-solid fa-bullhorn"></i><span>Total pengumuman</span><strong><?= $pengumuman; ?></strong></li>
                        <li><i class="fa-solid fa-chart-simple"></i><span>Kategori terbanyak</span><strong><?= $kategori_terbanyak; ?></strong></li>
                        <li><i class="fa-solid fa-clock"></i><span>Pengumuman terakhir</span><strong><?= $pengumuman_terakhir; ?></strong></li>
                        <li><i class="fa-solid fa-circle-check"></i><span>Status sistem</span><strong class="status-ok">Aktif</strong></li>
                    </ul>
                </div>
            </section>

            <!-- AKTIVITAS -->
            <h3 class="section-title" style="margin-top:30px;">Aktivitas Terakhir</h3>
            <div class="activity-card fade-in">
                <ul class="activity-list">
                    <?php while ($row = mysqli_fetch_assoc($aktivitas)): ?>
                        <li>
                            <i class="fa-solid fa-clock"></i>
                            <span><?= $row['aktivitas']; ?></span>
                            <small><?= timeAgo($row['created_at']); ?></small>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </div>

        </div>
    </div>
</div>

<footer>
    © 2025 Aplikasi Pengumuman Akademik Online | Politeknik Negeri Batam
</footer>
    <script src="../assets/js/script3.js"></script>
</body>
</html>

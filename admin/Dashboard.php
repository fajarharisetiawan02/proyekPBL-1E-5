<?php
date_default_timezone_set('Asia/Jakarta');
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";
function timeAgo($datetime) {
    $time = time() - strtotime($datetime);

    if ($time < 60) return 'baru saja';
    if ($time < 3600) return floor($time / 60) . ' menit lalu';
    if ($time < 86400) return floor($time / 3600) . ' jam lalu';

    return date('d M Y H:i', strtotime($datetime));
}

$nama = isset($_SESSION['nama']) ? $_SESSION['nama'] : 'Admin';

$qGrafik = mysqli_query($koneksi, "
    SELECT kategori, COUNT(*) AS total
    FROM pengumuman
    WHERE kategori IN ('Jadwal Ujian', 'Perubahan Kelas', 'Beasiswa')
    GROUP BY kategori
");


$labels = [];
$data   = [];

while ($row = mysqli_fetch_assoc($qGrafik)) {
    $labels[] = $row['kategori'];
    $data[]   = (int)$row['total'];
}

$pengumuman = mysqli_fetch_assoc(
    mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pengumuman")
)['total'];

$jadwal = mysqli_fetch_assoc(
    mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM jadwal_ujian")
)['total'];
$perubahan_kelas = mysqli_fetch_assoc(
    mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM perubahan_kelas")
)['total'] ?? 0;

$beasiswa = mysqli_fetch_assoc(
    mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM beasiswa")
)['total'] ?? 0;


$aktivitas = mysqli_query($koneksi, "
    SELECT a.aktivitas, a.created_at, l.nama
    FROM aktivitas_admin a
    LEFT JOIN login l ON a.id_login = l.id_login
    ORDER BY a.created_at DESC
    LIMIT 5
");

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - Aplikasi Pengumuman Akademik</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.lineicons.com/5.0/lineicons.css" rel="stylesheet" />
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

                <div class="quick-action fade-in">
                    <a href="pengumuman_tambah.php" class="btn-primary">
                        <i class="fa-solid fa-plus"></i> Tambah Pengumuman
                    </a>
                    <a href="jadwal_ujian_tambah.php" class="btn-secondary">
                        <i class="fa-solid fa-calendar-plus"></i> Tambah Jadwal
                    </a>
                </div>

                <h3 class="section-title">Kategori Pengumuman</h3>

                <div class="cards fade-in">

                    <a href="jadwal_ujian.php" class="card">
                        <i class="fa-solid fa-calendar-days"></i>
                        <h3>Jadwal Ujian</h3>
                        <p>Pengumuman terkait jadwal ujian</p>
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
                        <p>Informasi pendaftaran beasiswa</p>
                    </a>

                </div>

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


                </section>

                <h3 class="section-title" style="margin-top:15px;">
                    Statistik Pengumuman
                </h3>

                <div class="chart-wrapper fade-in">
                    <div class="chart-card">
                        <h4>Jumlah Pengumuman per Kategori</h4>
                        <canvas id="chartPengumuman"></canvas>
                    </div>
                </div>

                <h3 class="section-title" style="margin-top:30px;">
                    Aktivitas Terakhir
                </h3>

                <div class="activity-card fade-in">
                    <ul class="activity-list">
                        <?php if (mysqli_num_rows($aktivitas) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($aktivitas)): ?>
                        <li>
                            <i class="fa-solid fa-clock"></i>
                            <span><?= $row['aktivitas']; ?></span>
                            <small><?= timeAgo($row['created_at']); ?></small>

                        </li>
                        <?php endwhile; ?>
                        <?php else: ?>
                        <li class="empty">Belum ada aktivitas</li>
                        <?php endif; ?>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    <footer>
        © 2025 Aplikasi Pengumuman Akademik Online | Politeknik Negeri Batam
    </footer>

    <script>
        const grafikLabels = < ? = json_encode($labels); ? > ;
        const grafikData = < ? = json_encode($data); ? > ;
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../assets/js/script3.js"></script>



</body>

</html>

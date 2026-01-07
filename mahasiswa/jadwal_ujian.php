<?php
require_once "../config/auth_mahasiswa.php";
require_once "../config/koneksi.php";

date_default_timezone_set('Asia/Jakarta');

/* =========================
   DATA SESSION MAHASISWA
========================= */
$kelas  = $_SESSION['kelas'] ?? '';
$shift  = $_SESSION['shift'] ?? '';
$prodi  = $_SESSION['prodi'] ?? '';

$tanggalHariIni = date('Y-m-d');

/* =========================
   KELAS + SHIFT (TAMPILAN)
========================= */
$kelasTampil = trim($kelas . ' ' . strtoupper($shift));
if ($kelasTampil === '') {
    $kelasTampil = '-';
}

/* =========================
   HELPER HARI INDONESIA
========================= */
$hariIndo = [
    'Sunday'=>'Minggu','Monday'=>'Senin','Tuesday'=>'Selasa',
    'Wednesday'=>'Rabu','Thursday'=>'Kamis','Friday'=>'Jumat','Saturday'=>'Sabtu'
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Jadwal Ujian - Mahasiswa</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="icon" type="image/png" href="../assets/img/Logo Politeknik.png">
<link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
<link rel="stylesheet" href="../assets/css/style3.css">
<link rel="stylesheet" href="../assets/css/sidebar.css">
<link rel="stylesheet" href="../assets/css/notifikasi+profil.css">

<style>
.today-row { background-color:#f0f8ff; }
.page-title {
    font-size:22px;font-weight:600;margin-bottom:6px;color:#111827;
}
.header-meta {
    display:flex;gap:14px;font-size:13px;color:#374151;margin-bottom:4px;
}
.meta-item {
    display:inline-flex;gap:6px;align-items:center;
    background:#f1f5f9;padding:4px 10px;border-radius:6px;
}
.meta-item i { color:#1e40af; }
.header-desc { font-size:13px;color:#6b7280;margin:4px 0 14px; }
.header-section {
    padding-bottom:8px;border-bottom:1px solid #e5e7eb;margin-bottom:14px;
}
</style>
</head>

<body>

<div class="main-wrapper">
<?php include "../components_mahasiswa/sidebar.php"; ?>
<?php include "../components_mahasiswa/topbar.php"; ?>

<div class="main-content">
<div class="content-container">

<div class="header-section">
    <h3 class="page-title">Jadwal Ujian</h3>

    <div class="header-meta">
        <span class="meta-item">
            <i class="fa-solid fa-users"></i>
            Kelas: <strong><?= $kelasTampil; ?></strong>
        </span>
        <span class="meta-item">
            <i class="fa-solid fa-graduation-cap"></i>
            Prodi: <strong><?= $prodi ?: '-'; ?></strong>
        </span>
    </div>

    <p class="header-desc">
        Menampilkan jadwal ujian sesuai data akademik mahasiswa.
    </p>
</div>

<!-- ===== TABEL ===== -->
<div class="table-wrapper">
<table class="admin-table">
<thead>
<tr>
    <th>No</th>
    <th>Hari</th>
    <th>Tanggal</th>
    <th>Waktu</th>
    <th>Mata Kuliah</th>
    <th>Ruang</th>
    <th>Dosen</th>
</tr>
</thead>
<tbody>

<?php
/* =========================
   QUERY UTAMA
========================= */
$query = mysqli_query($koneksi, "
    SELECT * FROM jadwal_ujian
    WHERE kelas = '$kelas'
      AND shift = '$shift'
    ORDER BY tanggal ASC, waktu_mulai ASC
");

/* fallback prodi */
if (mysqli_num_rows($query) === 0 && $prodi !== '') {
    $query = mysqli_query($koneksi, "
        SELECT * FROM jadwal_ujian
        WHERE prodi = '$prodi'
        ORDER BY tanggal ASC, waktu_mulai ASC
    ");
}

/* fallback semua */
if (mysqli_num_rows($query) === 0) {
    $query = mysqli_query($koneksi, "
        SELECT * FROM jadwal_ujian
        ORDER BY tanggal ASC, waktu_mulai ASC
    ");
}

if (!$query || mysqli_num_rows($query) === 0) {
    echo "<tr><td colspan='7' style='text-align:center;'>Jadwal ujian belum tersedia</td></tr>";
}

$no = 1;
while ($row = mysqli_fetch_assoc($query)) {
    $hari = $hariIndo[date('l', strtotime($row['tanggal']))];
    $isToday = ($row['tanggal'] === $tanggalHariIni);
?>
<tr class="<?= $isToday ? 'today-row' : ''; ?>">
    <td><?= $no++; ?></td>
    <td><strong><?= $hari; ?></strong></td>
    <td><?= date("d M Y", strtotime($row['tanggal'])); ?></td>
    <td>
        <?= date("H:i", strtotime($row['waktu_mulai'])); ?> -
        <?= date("H:i", strtotime($row['waktu_selesai'])); ?>
    </td>
    <td><?= htmlspecialchars($row['mata_kuliah']); ?></td>
    <td><?= htmlspecialchars($row['ruang']); ?></td>
    <td><?= htmlspecialchars($row['dosen']); ?></td>
</tr>
<?php } ?>

</tbody>
</table>
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

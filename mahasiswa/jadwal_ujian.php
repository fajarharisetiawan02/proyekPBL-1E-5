<?php
require_once "../config/auth_mahasiswa.php";
require_once "../config/koneksi.php";

<<<<<<< HEAD
/* =========================
   DATA SESSION MAHASISWA
   ========================= */
$kelas  = $_SESSION['kelas'] ?? '';   // contoh: E
$shift  = $_SESSION['shift'] ?? '';   // Pagi / Malam
$prodi  = $_SESSION['prodi'] ?? '';

$tanggalHariIni = date('Y-m-d');

/* =========================
   KELAS + SHIFT (TAMPILAN)
   ========================= */
$kelasTampil = trim($kelas . ' ' . strtoupper($shift));
if ($kelasTampil === '') {
    $kelasTampil = '-';
}
=======
$kelas = $_SESSION['kelas'] ?? '';
$prodi = $_SESSION['prodi'] ?? '';
$tanggalHariIni = date('Y-m-d');
>>>>>>> 9a567987dd90af1392f8d15dfcbd79423ecb4815
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Ujian - Mahasiswa</title>

    <link rel="stylesheet" href="../assets/css/style3.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
<link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- tambahan ringan -->
    <style>
        .info-text {
            margin: 6px 0 14px;
            font-size: 13px;
            color: #555;
        }
        .today-row {
            background-color: #f0f8ff;
        }
<<<<<<< HEAD
.page-title {
    font-size: 22px;
    font-weight: 600;
    margin-bottom: 6px;
    color: #111827;
        margin-left: 0 !important;
}

/* baris kelas & prodi */
.header-meta {
    display: flex;
    align-items: center;
    gap: 14px;
    font-size: 13px;
    color: #374151;
    margin-bottom: 4px;
}

.meta-item {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #f1f5f9;
    padding: 4px 10px;
    border-radius: 6px;
}

.meta-item i {
    color: #1e40af;
    font-size: 14px;
}

.meta-item strong {
    font-weight: 600;
    color: #111827;
}

.separator {
    color: #9ca3af;
}

/* keterangan */
.header-desc {
    font-size: 13px;
    color: #6b7280;
    margin: 4px 0 14px;
}

/* pemisah header */
.header-section {
    padding-bottom: 8px;
    border-bottom: 1px solid #e5e7eb;
    margin-left: 0 !important;
    padding-left: 0 !important;
}

/* mobile */
@media (max-width: 768px) {
    .header-meta {
        flex-wrap: wrap;
    }
}
=======
>>>>>>> 9a567987dd90af1392f8d15dfcbd79423ecb4815
    </style>
</head>

<body>

<div class="main-wrapper">

    <?php include "../components_mahasiswa/sidebar.php"; ?>
    <?php include "../components_mahasiswa/topbar.php"; ?>

    <div class="main-content">
        <div class="content-container">

<<<<<<< HEAD
<div class="header-section">

    <h3 class="page-title">Jadwal Ujian</h3>

    <div class="header-meta">
        <span class="meta-item">
            <i class="fa-solid fa-users"></i>
            <span>Kelas:</span>
            <strong><?= $kelasTampil; ?></strong>
        </span>

        <span class="separator">|</span>

        <span class="meta-item">
            <i class="fa-solid fa-graduation-cap"></i>
            <span>Prodi:</span>
            <strong><?= $prodi ?: '-'; ?></strong>
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
    <th>Mata Kuliah</th>
    <th>Hari</th>
    <th>Tanggal</th>
    <th>Waktu</th>
    <th>Ruang</th>
    <th>Dosen</th>
</tr>
</thead>
<tbody>

<?php
/* =========================
   QUERY UTAMA (KELAS + SHIFT)
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
$hariIndo = [
    'Sunday'=>'Minggu','Monday'=>'Senin','Tuesday'=>'Selasa',
    'Wednesday'=>'Rabu','Thursday'=>'Kamis','Friday'=>'Jumat','Saturday'=>'Sabtu'
];

while ($row = mysqli_fetch_assoc($query)) {
    $hari = $hariIndo[date('l', strtotime($row['tanggal']))];
    $isToday = ($row['tanggal'] === $tanggalHariIni);
?>
<tr class="<?= $isToday ? 'today-row' : ''; ?>">
    <td><?= $no++; ?></td>
    <td><?= htmlspecialchars($row['mata_kuliah']); ?></td>
    <td><?= $hari; ?></td>
    <td><?= date("d M Y", strtotime($row['tanggal'])); ?></td>
    <td>
        <?php
        if ($row['waktu_mulai'] && $row['waktu_selesai']) {
            echo date("H:i", strtotime($row['waktu_mulai'])) .
                 " - " .
                 date("H:i", strtotime($row['waktu_selesai'])) . " WIB";
        } else {
            echo "-";
        }
        ?>
    </td>
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
=======
            <div class="header-section">
                <h3>Jadwal Ujian</h3>
                <small>
                    Kelas: <b><?= $kelas ?: '-'; ?></b> |
                    Prodi: <b><?= $prodi ?: '-'; ?></b>
                </small>

                <div class="info-text">
                    Menampilkan jadwal ujian sesuai data akademik mahasiswa.
                </div>
            </div>

            <div class="table-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Mata Kuliah</th>
                            <th>Hari</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Ruang</th>
                            <th>Dosen</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php
                    // 1. filter kelas
                    $query = mysqli_query($koneksi, "
                        SELECT * FROM jadwal_ujian
                        WHERE kelas='$kelas'
                        ORDER BY tanggal ASC, waktu_mulai ASC
                    ");

                    // 2. fallback prodi
                    if (mysqli_num_rows($query) === 0 && $prodi != '') {
                        $query = mysqli_query($koneksi, "
                            SELECT * FROM jadwal_ujian
                            WHERE prodi='$prodi'
                            ORDER BY tanggal ASC, waktu_mulai ASC
                        ");
                    }

                    // 3. fallback semua
                    if (mysqli_num_rows($query) === 0) {
                        $query = mysqli_query($koneksi, "
                            SELECT * FROM jadwal_ujian
                            ORDER BY tanggal ASC, waktu_mulai ASC
                        ");
                    }

                    if (!$query || mysqli_num_rows($query) === 0) {
                        echo "<tr>
                                <td colspan='7' style='text-align:center;'>
                                    Jadwal ujian belum tersedia
                                </td>
                              </tr>";
                    }

                    $no = 1;
                    $hariIndo = [
                        'Sunday' => 'Minggu',
                        'Monday' => 'Senin',
                        'Tuesday' => 'Selasa',
                        'Wednesday' => 'Rabu',
                        'Thursday' => 'Kamis',
                        'Friday' => 'Jumat',
                        'Saturday' => 'Sabtu'
                    ];

                    while ($row = mysqli_fetch_assoc($query)) {
                        $hari = $hariIndo[date('l', strtotime($row['tanggal']))];
                        $isToday = ($row['tanggal'] === $tanggalHariIni);
                    ?>
                        <tr class="<?= $isToday ? 'today-row' : ''; ?>">
                            <td><?= $no++; ?></td>
                            <td><?= $row['mata_kuliah']; ?></td>
                            <td><?= $hari; ?></td>
                            <td><?= date("d M Y", strtotime($row['tanggal'])); ?></td>
                            <td>
                                <?php
                                if (!empty($row['waktu_mulai']) && !empty($row['waktu_selesai'])) {
                                    echo date("H:i", strtotime($row['waktu_mulai'])) .
                                         " - " .
                                         date("H:i", strtotime($row['waktu_selesai'])) .
                                         " WIB";
                                } else {
                                    echo "-";
                                }
                                ?>
                            </td>
                            <td><?= $row['ruang']; ?></td>
                            <td><?= $row['dosen']; ?></td>
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
>>>>>>> 9a567987dd90af1392f8d15dfcbd79423ecb4815
</footer>

<script src="../assets/js/script3.js"></script>
</body>
<<<<<<< HEAD
</html>
=======
</html>
>>>>>>> 9a567987dd90af1392f8d15dfcbd79423ecb4815

<?php
require_once "../config/auth_mahasiswa.php";
require_once "../config/koneksi.php";

$kelas = $_SESSION['kelas'] ?? '';
<<<<<<< HEAD
$shift = $_SESSION['shift'] ?? '';
$prodi = $_SESSION['prodi'] ?? '';

// kelas + shift untuk tampilan
$kelasTampil = trim($kelas . ' ' . strtoupper($shift));
if ($kelasTampil === '') {
    $kelasTampil = '-';
}
=======
$prodi = $_SESSION['prodi'] ?? '';
>>>>>>> 9a567987dd90af1392f8d15dfcbd79423ecb4815
?>
<!DOCTYPE html>
<html lang="id">
<head>
<<<<<<< HEAD
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Perubahan Kelas - Mahasiswa</title>

<link rel="stylesheet" href="../assets/css/style4.css">
<link rel="stylesheet" href="../assets/css/sidebar.css">
<link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>
/* ===== HEADER SAMA DENGAN JADWAL UJIAN ===== */
        .info-text {
            margin: 6px 0 14px;
            font-size: 13px;
            color: #555;
        }
        .today-row {
            background-color: #f0f8ff;
        }
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
</style>
=======
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perubahan Kelas - Mahasiswa</title>

    <link rel="stylesheet" href="../assets/css/style5.css">
<link rel="stylesheet" href="../assets/css/sidebar.css">
<link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        /* header konsisten dengan jadwal ujian */
        .header-flex {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-bottom: 12px;
            margin-bottom: 18px;
            border-bottom: 1px solid #e6eef5;
        }
        .header-center {
            text-align: center;
            font-size: 13px;
            color: #444;
        }
        .header-right {
            font-size: 13px;
            color: #666;
        }
    </style>
>>>>>>> 9a567987dd90af1392f8d15dfcbd79423ecb4815
</head>

<body>
<div class="main-wrapper">

<<<<<<< HEAD
<?php include "../components_mahasiswa/sidebar.php"; ?>
<?php include "../components_mahasiswa/topbar.php"; ?>

<div class="main-content">
<div class="content-container">

<!-- ===== HEADER ===== -->
<div class="header-section">
    <h3 class="page-title">Perubahan Kelas</h3>

    <div class="header-meta">
        <span class="meta-item">
            <i class="fa-solid fa-users"></i>
            <span>Kelas:</span>
            <strong><?= htmlspecialchars($kelasTampil); ?></strong>
        </span>

        <span class="separator">|</span>

        <span class="meta-item">
            <i class="fa-solid fa-graduation-cap"></i>
            <span>Prodi:</span>
            <strong><?= htmlspecialchars($prodi ?: '-'); ?></strong>
        </span>
    </div>

    <p class="header-desc">
        Menampilkan informasi perubahan kelas terbaru.
    </p>
</div>

<!-- ===== TABEL ===== -->
<div class="table-wrapper">
<table class="admin-table">
<thead>
<tr>
    <th>No</th>
    <th>Tanggal</th>
    <th>Mata Kuliah</th>
    <th>Kelas Asal</th>
    <th>Kelas Baru</th>
    <th>Dosen</th>
</tr>
</thead>
<tbody>

<?php
// filter kelas + shift (jika ada)
$query = mysqli_query($koneksi, "
    SELECT * FROM perubahan_kelas
    WHERE kelas='$kelas'
    ORDER BY tanggal_perubahan DESC
");

// fallback prodi
if (mysqli_num_rows($query) === 0 && $prodi !== '') {
    $query = mysqli_query($koneksi, "
        SELECT * FROM perubahan_kelas
        WHERE prodi='$prodi'
        ORDER BY tanggal_perubahan DESC
    ");
}

// fallback semua
if (mysqli_num_rows($query) === 0) {
    $query = mysqli_query($koneksi, "
        SELECT * FROM perubahan_kelas
        ORDER BY tanggal_perubahan DESC
    ");
}

if (!$query || mysqli_num_rows($query) === 0) {
    echo "<tr><td colspan='6' style='text-align:center;'>Belum ada data perubahan kelas</td></tr>";
}

$no = 1;
while ($row = mysqli_fetch_assoc($query)) {
?>
<tr>
    <td><?= $no++; ?></td>
    <td><?= date("d M Y", strtotime($row['tanggal_perubahan'])); ?></td>
    <td><?= htmlspecialchars($row['mata_kuliah']); ?></td>
    <td><?= htmlspecialchars($row['kelas_asal']); ?></td>
    <td><?= htmlspecialchars($row['kelas_baru']); ?></td>
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
<div class="main-wrapper">

    <?php include "../components_mahasiswa/sidebar.php"; ?>
    <?php include "../components_mahasiswa/topbar.php"; ?>

    <div class="main-content">
        <div class="content-container">

            <!-- HEADER (SAMA DENGAN JADWAL UJIAN) -->
            <div class="header-section header-flex">
                <h3>Perubahan Kelas</h3>

                <small class="header-center">
                    Kelas: <b><?= $kelas ?: '-'; ?></b> |
                    Prodi: <b><?= $prodi ?: '-'; ?></b>
                </small>

                <small class="header-right">
                    Menampilkan informasi perubahan kelas terbaru.
                </small>
            </div>

            <!-- TABEL -->
            <div class="table-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Mata Kuliah</th>
                            <th>Kelas Asal</th>
                            <th>Kelas Baru</th>
                            <th>Dosen</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php
                    // filter kelas
                    $query = mysqli_query($koneksi, "
                        SELECT * FROM perubahan_kelas
                        WHERE kelas='$kelas'
                        ORDER BY tanggal_perubahan DESC
                    ");

                    // fallback prodi
                    if (mysqli_num_rows($query) === 0 && $prodi != '') {
                        $query = mysqli_query($koneksi, "
                            SELECT * FROM perubahan_kelas
                            WHERE prodi='$prodi'
                            ORDER BY tanggal_perubahan DESC
                        ");
                    }

                    // fallback semua
                    if (mysqli_num_rows($query) === 0) {
                        $query = mysqli_query($koneksi, "
                            SELECT * FROM perubahan_kelas
                            ORDER BY tanggal_perubahan DESC
                        ");
                    }

                    if (!$query || mysqli_num_rows($query) === 0) {
                        echo "<tr>
                                <td colspan='6' style='text-align:center;'>
                                    Belum ada data perubahan kelas
                                </td>
                              </tr>";
                    }

                    $no = 1;
                    while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= date("d M Y", strtotime($row['tanggal_perubahan'])); ?></td>
                            <td><?= $row['mata_kuliah']; ?></td>
                            <td><?= $row['kelas_asal']; ?></td>
                            <td><?= $row['kelas_baru']; ?></td>
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
</html>

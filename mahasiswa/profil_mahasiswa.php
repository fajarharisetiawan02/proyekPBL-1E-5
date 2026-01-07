<?php
require_once "../config/auth_mahasiswa.php";
require_once "../config/koneksi.php";

/* ======================
   CEK SESSION
====================== */
$id_mahasiswa = $_SESSION['id_mahasiswa'] ?? null;
if (!$id_mahasiswa) {
    echo "<h2 style='padding:20px;color:red'>❌ Session mahasiswa tidak ditemukan</h2>";
    exit;
}

/* ======================
   AMBIL DATA MAHASISWA
====================== */
$q = mysqli_query($koneksi, "
    SELECT nim, nama, prodi, jurusan, kelas, shift, semester,
           email, no_hp, foto
    FROM mahasiswa
    WHERE id_mahasiswa = '$id_mahasiswa'
");
$mhs = mysqli_fetch_assoc($q);

if (!$mhs) {
    echo "<h2 style='padding:20px;color:red'>❌ Data mahasiswa tidak ditemukan</h2>";
    exit;
}

$fotoMhs = !empty($mhs['foto'])
    ? "../uploads/foto_mahasiswa/" . $mhs['foto']
    : "../assets/img/default-mahasiswa.png";
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Profil Mahasiswa</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="icon" href="../assets/img/Logo Politeknik.png">
<link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
<link rel="stylesheet" href="../assets/css/sidebar.css">
<link rel="stylesheet" href="../assets/css/profil-mahasiswa.css">
<link rel="stylesheet" href="../assets/css/notifikasi+profil.css">

</head>

<body>
<div class="main-wrapper">

<?php include "../components_mahasiswa/sidebar.php"; ?>
<div class="main-content">
<?php include "../components_mahasiswa/topbar.php"; ?>

<div class="profile-wrapper">

<!-- HEADER -->
<div class="profile-title">
    <h2>Profil Mahasiswa</h2>
    <div class="profile-sub">Informasi akun dan akademik mahasiswa</div>
</div>

<!-- BODY -->
<div class="profile-body">

    <!-- FOTO -->
    <div class="profile-photo-box">
        <img src="<?= $fotoMhs ?>">
    </div>

    <!-- DATA -->
    <div>
        <div class="info-item">
            <i class="fa-solid fa-id-card"></i>
            <span class="label">NIM</span><span class="colon">:</span>
            <span class="value"><?= $mhs['nim'] ?></span>
        </div>
        <div class="info-item">
            <i class="fa-solid fa-user"></i>
            <span class="label">Nama Lengkap</span><span class="colon">:</span>
            <span class="value"><?= $mhs['nama'] ?></span>
        </div>
        <div class="info-item">
            <i class="fa-solid fa-graduation-cap"></i>
            <span class="label">Program Studi</span><span class="colon">:</span>
            <span class="value"><?= $mhs['prodi'] ?></span>
        </div>
        <div class="info-item">
            <i class="fa-solid fa-building-columns"></i>
            <span class="label">Jurusan</span><span class="colon">:</span>
            <span class="value"><?= $mhs['jurusan'] ?></span>
        </div>
        <div class="info-item">
            <i class="fa-solid fa-chalkboard"></i>
            <span class="label">Kelas</span><span class="colon">:</span>
            <span class="value"><?= $mhs['kelas'] ?> (<?= strtoupper($mhs['shift']) ?>)</span>
        </div>
        <div class="info-item">
            <i class="fa-solid fa-envelope"></i>
            <span class="label">Email</span><span class="colon">:</span>
            <span class="value"><?= $mhs['email'] ?></span>
        </div>
        <div class="info-item">
            <i class="fa-solid fa-phone"></i>
            <span class="label">No. HP</span><span class="colon">:</span>
            <span class="value"><?= $mhs['no_hp'] ?: '-' ?></span>
        </div>

        <div class="profile-actions">
            <a href="edit_profil_mahasiswa.php" class="btn-primary">
                <i class="fa-solid fa-pen"></i> Edit Profil
            </a>
            <a href="ubah_sandi.php" class="btn-outline">
                <i class="fa-solid fa-key"></i> Ubah Kata Sandi
            </a>
        </div>
    </div>

</div>

<!-- INFO AKADEMIK -->
<div class="account-info">
    <div class="account-card">
        <i class="fa-solid fa-layer-group"></i>
        <span>Semester</span>
        <b>Semester <?= $mhs['semester'] ?></b>
    </div>
    <div class="account-card">
        <i class="fa-solid fa-users"></i>
        <span>Kelas</span>
        <b><?= $mhs['kelas'] ?> (<?= strtoupper($mhs['shift']) ?>)</span></b>
    </div>
    <div class="account-card">
        <i class="fa-solid fa-graduation-cap"></i>
        <span>Status Akademik</span>
        <b>Aktif</b>
    </div>
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

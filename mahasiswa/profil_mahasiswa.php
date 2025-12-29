<?php
require_once "../config/auth_mahasiswa.php";
require_once "../config/koneksi.php";

$id_login = $_SESSION['id_login'];

$q = mysqli_query($koneksi, "
    SELECT 
        m.nim,
        m.nama,
        m.prodi,
        m.jurusan,
        m.kelas,
        m.email,
        m.no_hp,
        m.foto
    FROM login l
    JOIN mahasiswa m ON l.id_mahasiswa = m.id_mahasiswa
    WHERE l.id_login = '$id_login'
");

$mhs = mysqli_fetch_assoc($q);

if (!$mhs) {
    echo "<h3>Data mahasiswa tidak ditemukan</h3>";
    exit;
}

$inisial = strtoupper(substr($mhs['nama'], 0, 1));
$foto = !empty($mhs['foto'])
    ? "../uploads/foto_mahasiswa/" . $mhs['foto']
    : null;
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Profil Mahasiswa</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="icon" type="image/png" href="../assets/img/Logo Politeknik.png">
<link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
<link rel="stylesheet" href="../assets/css/profil-mahasiswa.css">
<link rel="stylesheet" href="../assets/css/sidebar.css">
<link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
</head>

<body>

<div class="main-wrapper">

    <?php include "../components_mahasiswa/sidebar.php"; ?>

    <div class="main-content">

        <?php include "../components_mahasiswa/topbar.php"; ?>

        <!-- HEADER -->
        <div class="profile-header">
            <?php if ($foto): ?>
                <img src="<?= $foto ?>" class="profile-photo">
            <?php else: ?>
                <div class="avatar-inisial"><?= $inisial ?></div>
            <?php endif; ?>

            <div class="profile-info">
                <h1><?= strtoupper($mhs['nama']) ?></h1>
                <span class="badge-student">
                    <i class="fa-solid fa-user-graduate"></i> MAHASISWA
                </span>
            </div>

            <p class="nim-text">NIM : <b><?= $mhs['nim'] ?></b></p>
        </div>

        <!-- DATA PRIBADI -->
        <div class="profile-card">
            <h2><i class="fa-solid fa-id-card"></i> Data Pribadi</h2>

            <div class="info-row">
                <span>Nama Lengkap</span>
                <strong><?= $mhs['nama'] ?></strong>
            </div>

            <div class="info-row">
                <span>Email</span>
                <strong><?= $mhs['email'] ?></strong>
            </div>

            <div class="info-row">
                <span>No. HP</span>
                <strong><?= $mhs['no_hp'] ?: '-' ?></strong>
            </div>
        </div>

        <!-- DATA AKADEMIK -->
        <div class="profile-card">
            <h2><i class="fa-solid fa-graduation-cap"></i> Data Akademik</h2>

            <div class="info-row">
                <span>Program Studi</span>
                <strong><?= $mhs['prodi'] ?></strong>
            </div>

            <div class="info-row">
                <span>Jurusan</span>
                <strong><?= $mhs['jurusan'] ?></strong>
            </div>

            <div class="info-row">
                <span>Kelas</span>
                <strong><?= $mhs['kelas'] ?></strong>
            </div>

            <div class="action-group">
                <a href="edit_profil_mahasiswa.php" class="btn-edit">
                    <i class="fa-solid fa-pen"></i> Edit Profil
                </a>

                <a href="ubah_sandi.php" class="btn-secondary">
                    <i class="fa-solid fa-key"></i> Ubah Kata Sandi
                </a>
            </div>
        </div>

    </div>
</div>

</body>
</html>

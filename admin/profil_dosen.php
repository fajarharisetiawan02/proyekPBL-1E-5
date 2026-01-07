<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";

$id_login = $_SESSION['id_login'] ?? null;
if (!$id_login) {
    echo "<h2 style='padding:20px;color:red'>❌ Session login tidak ditemukan</h2>";
    exit;
}

/* ===============================
   QUERY PROFIL ADMIN (FIX)
=============================== */
$q = mysqli_query($koneksi, "
    SELECT 
        a.nama,
        a.nidn,
        a.username,
        a.email,
        a.prodi,
        a.jabatan,
        a.role,
        a.status,
        a.foto,
        l.last_login
    FROM login l
    INNER JOIN admin a ON a.id_admin = l.id_admin
    WHERE l.id_login = '$id_login'
    LIMIT 1
");

$admin = mysqli_fetch_assoc($q);
if (!$admin) {
    echo "<h2 style='padding:20px;color:red'>❌ Data admin tidak ditemukan</h2>";
    exit;
}

/* ===============================
   DATA TURUNAN
=============================== */
$fotoAdmin = !empty($admin['foto'])
    ? "../uploads/foto_admin/" . $admin['foto']
    : "../assets/img/default-dosen.png";

$statusAkun = ($admin['status'] === 'aktif') ? 'Aktif' : 'Nonaktif';

$lastLogin = $admin['last_login']
    ? date('d M Y H:i', strtotime($admin['last_login']))
    : '-';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Profil Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="icon" href="../assets/img/Logo Politeknik.png">
<link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
<link rel="stylesheet" href="../assets/css/profil-admin.css">
<link rel="stylesheet" href="../assets/css/sidebar.css">
<link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
</head>

<body>
<div class="main-wrapper">
<?php include "../components_admin/sidebar.php"; ?>

<div class="main-content">
<?php include "../components_admin/topbar.php"; ?>

<div class="profile-wrapper">

<div class="profile-title">
    <h2>Profil Dosen</h2>
    <div class="profile-sub">Informasi Akun dan Akademik Dosen</div>
</div>

<div class="profile-body">
    <!-- FOTO -->
    <div class="profile-photo-box">
        <img src="<?= $fotoAdmin ?>">
        <div class="status-box">
        </div>
    </div>

    <!-- DATA -->
    <div>
        <div class="info-item">
            <i class="fa-solid fa-user"></i>
            <span class="label">Nama Lengkap</span><span class="colon">:</span>
            <span class="value"><?= $admin['nama'] ?></span>
        </div>
        <div class="info-item">
            <i class="fa-solid fa-id-card"></i>
            <span class="label">NIDN</span><span class="colon">:</span>
            <span class="value"><?= $admin['nidn'] ?></span>
        </div>
        <div class="info-item">
            <i class="fa-solid fa-graduation-cap"></i>
            <span class="label">Program Studi</span><span class="colon">:</span>
            <span class="value"><?= $admin['prodi'] ?></span>
        </div>
        <div class="info-item">
            <i class="fa-solid fa-user-tie"></i>
            <span class="label">Jabatan</span><span class="colon">:</span>
            <span class="value"><?= $admin['jabatan'] ?></span>
        </div>
        <div class="info-item">
            <i class="fa-solid fa-envelope"></i>
            <span class="label">Email</span><span class="colon">:</span>
            <span class="value"><?= $admin['email'] ?></span>
        </div>

        <div class="profile-actions">
            <a href="edit_profil_dosen.php" class="btn-primary">
                <i class="fa-solid fa-pen"></i> Edit Profil
            </a>
            <a href="ubah_sandi.php" class="btn-outline">
                <i class="fa-solid fa-key"></i> Ubah Kata Sandi
            </a>
        </div>
    </div>
</div>

<!-- INFORMASI AKUN -->
<div class="account-info">
    <div class="account-card">
        <i class="fa-solid fa-user-shield"></i>
        <span>Role Akun</span>
        <b><?= strtoupper($admin['role']) ?></b>
    </div>
    <div class="account-card">
        <i class="fa-solid fa-toggle-on"></i>
        <span>Status Akun</span>
        <b><?= $statusAkun ?></b>
    </div>
    <div class="account-card">
        <i class="fa-solid fa-user"></i>
        <span>Username</span>
        <b><?= $admin['username'] ?></b>
    </div>
    <div class="account-card">
        <i class="fa-solid fa-clock"></i>
        <span>Login Terakhir</span>
        <b><?= $lastLogin ?></b>
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

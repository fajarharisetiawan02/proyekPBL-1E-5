<?php
require_once "../config/auth_mahasiswa.php";
require_once "../config/koneksi.php";

/* ===============================
   CEK LOGIN MAHASISWA
================================ */
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}

$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Ubah Kata Sandi - Mahasiswa</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="icon" type="image/png" href="../assets/img/Logo Politeknik.png">
<link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
<link rel="stylesheet" href="../assets/css/sidebar.css">
<link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
<link rel="stylesheet" href="../assets/css/ubah_sandi.css">
</head>

<body>

<div class="main-wrapper">

<?php include "../components_mahasiswa/sidebar.php"; ?>
<?php include "../components_mahasiswa/topbar.php"; ?>

<div class="main-content">
<section class="content">

<article class="password-card">

    <h2><i class="fa-solid fa-key"></i> Ubah Kata Sandi</h2>
    <p class="info">
        Gunakan kata sandi yang kuat untuk menjaga keamanan akun mahasiswa.
    </p>

    <form action="proses_ubah_sandi.php" method="POST" novalidate>

        <div class="form-row">
            <label>Password Lama</label>
            <div class="password-wrapper">
                <input type="password"
                       name="password_lama"
                       required
                       placeholder="Masukkan password lama"
                       autocomplete="current-password">
                <i class="fa fa-eye toggle-password" onclick="togglePassword(this)"></i>
            </div>
        </div>

        <div class="form-row">
            <label>Password Baru</label>
            <small class="hint">
                Minimal 8 karakter, kombinasi huruf dan angka.
            </small>
            <div class="password-wrapper">
                <input type="password"
                       name="password_baru"
                       id="passwordBaru"
                       required
                       placeholder="Masukkan password baru"
                       autocomplete="new-password"
                       onkeyup="checkStrength(this.value)">
                <i class="fa fa-eye toggle-password" onclick="togglePassword(this)"></i>
            </div>
            <div id="strength" class="strength"></div>
        </div>

        <div class="form-row">
            <label>Konfirmasi Password Baru</label>
            <div class="password-wrapper">
                <input type="password"
                       name="konfirmasi"
                       required
                       placeholder="Ulangi password baru"
                       autocomplete="new-password">
                <i class="fa fa-eye toggle-password" onclick="togglePassword(this)"></i>
            </div>
        </div>

        <button type="submit" class="btn">
            <i class="fa fa-save"></i> Simpan Kata Sandi
        </button>

    </form>

</article>

</section>
</div>
</div>

<footer>
© 2025 Aplikasi Pengumuman Akademik Online | Politeknik Negeri Batam
</footer>

<script src="../assets/js/script3.js"></script>
</body>
</html>

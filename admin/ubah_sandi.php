<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";

// CEK LOGIN
if (!isset($_SESSION['username'])) {
    header("Location: ../tampilan_login.php");
    exit;
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Password - Pengumuman Akademik Online</title>

    <link rel="stylesheet" href="../assets/css/ubah sandi.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link href="https://cdn.lineicons.com/5.0/lineicons.css" rel="stylesheet" />
</head>

<body>

    <div class="main-wrapper">

        <?php include "../components_admin/sidebar.php"; ?>

        <?php include "../components_admin/topbar.php"; ?>

        <div class="main-content">

            <section class="content fade-in">
                <article class="card password-card">

                    <h2><i class="fa-solid fa-key"></i> Ubah Kata Sandi</h2>
                    <p class="info">Gunakan password yang kuat agar akun tetap aman.</p>

                    <form action="ubah_sandi_proses.php" method="POST">

                        <div class="form-row">
                            <label>Password Lama</label>
                            <input type="password" name="password_lama" required placeholder="Masukkan password lama">
                        </div>

                        <div class="form-row">
                            <label>Password Baru</label>
                            <small class="hint">
                                Minimal 8 karakter, kombinasi huruf dan angka.
                            </small>

                            <input type="password" name="password_baru" required placeholder="Masukkan password baru">
                        </div>

                        <div class="form-row">
                            <label>Konfirmasi Password Baru</label>
                            <input type="password" name="konfirmasi" required placeholder="Konfirmasi password">
                        </div>

                        <button type="submit" class="btn">Simpan Kata Sandi</button>

                    </form>

                </article>
            </section>

        </div>

    </div>

    <footer>
        © 2025 Aplikasi Pengumuman Akademik Online | Politeknik Negeri Batam
    </footer>

    <script src="../assets/js/ubah sandi.js"></script>

</body>

</html>

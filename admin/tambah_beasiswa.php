<?php
require_once "../config/auth.php";
require_once "../config/koneksi.php";

if (isset($_POST['simpan'])) {

    $nama_beasiswa   = $_POST['nama_beasiswa'];
    $deskripsi       = $_POST['deskripsi'];
    $syarat          = $_POST['syarat'];
    $periode         = $_POST['periode'];
    $tanggal_buka    = $_POST['tanggal_buka'];
    $tanggal_tutup   = $_POST['tanggal_tutup'];
    $status          = $_POST['status'];

    $gambar = ""; 

    mysqli_query($koneksi, "INSERT INTO beasiswa 
        (nama_beasiswa, deskripsi, syarat, periode, tanggal_buka, tanggal_tutup, gambar, status)
        VALUES (
            '$nama_beasiswa', 
            '$deskripsi', 
            '$syarat', 
            '$periode', 
            '$tanggal_buka', 
            '$tanggal_tutup',
            '$gambar',
            '$status'
        )");

    header("Location: beasiswa.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tambah Beasiswa</title>

    <link rel="stylesheet" href="../assets/css/style4.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
</head>

<div class="main-wrapper">

    <?php include "../components_admin/sidebar.php"; ?>
    <?php include "../components_admin/topbar.php"; ?>

    <div class="main-content">

        <div class="content-container">

            <div class="header-section">
                <h3>Tambah Beasiswa</h3>
            </div>

            <form method="POST" class="form-box">

                <label>Nama Beasiswa</label>
                <input type="text" name="nama" required>

                <label>Deskripsi</label>
                <textarea name="deskripsi" required></textarea>

                <label>Syarat Beasiswa</label>
                <textarea name="syarat" required></textarea>

                <label>Periode</label>
                <input type="text" name="periode" required>

                <label>Tanggal Buka</label>
                <input type="date" name="tanggal_buka" required>

                <label>Tanggal Tutup</label>
                <input type="date" name="tanggal_tutup" required>

                <label>Status</label>
                <select name="status">
                    <option value="aktif">Aktif</option>
                    <option value="nonaktif">Nonaktif</option>
                </select>

                <div class="btn-area">
                    <button type="submit" name="simpan" class="btn-add">Simpan</button>
                    <a href="beasiswa.php" class="btn-cancel">Batal</a>
                </div>

            </form>

        </div>
    </div>

</div>

<footer>
    © 2025 Aplikasi Pengumuman Akademik Online | Politeknik Negeri Batam
</footer>

<script src="../assets/js/script3.js"></script>
</body>

</html>

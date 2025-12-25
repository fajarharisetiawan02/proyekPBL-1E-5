<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";

/* ===== TANDAI SUDAH DIBACA ===== */
if (isset($_GET['read'])) {
    $id = (int) $_GET['read'];
    mysqli_query($koneksi, "
        UPDATE notifikasi 
        SET is_read = 1 
        WHERE id_notifikasi = '$id'
    ");
    header("Location: notifikasi.php");
    exit;
}

/* ===== AMBIL NOTIFIKASI ===== */
$notifikasi = mysqli_query($koneksi, "
    SELECT * FROM notifikasi
    WHERE role='admin'
    ORDER BY tanggal DESC
");
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kirim Notifikasi</title>
</head>

<body>

<h2>Kirim Pengumuman / Notifikasi</h2>

<form action="proses_notifikasi.php" method="post">
    <input type="text" name="judul" placeholder="Judul Pengumuman" required>

    <br><br>

    <textarea name="isi" placeholder="Isi pengumuman..." required></textarea>

    <br><br>

    <select name="role" required>
        <option value="all">Semua</option>
        <option value="mahasiswa">Mahasiswa</option>
        <option value="admin">Admin</option>
    </select>

    <br><br>

    <button type="submit">Kirim</button>
</form>

</body>

</html>

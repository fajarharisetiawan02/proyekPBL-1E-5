<?php
session_start();
// (opsional) cek login admin di sini
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

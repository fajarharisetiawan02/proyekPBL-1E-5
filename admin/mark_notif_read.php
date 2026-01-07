<?php
require_once "../config/auth_admin.php"; // ganti auth_mahasiswa.php kalau mahasiswa
require_once "../config/koneksi.php";

if (!isset($_POST['id_notifikasi'])) {
    exit;
}

$id = (int) $_POST['id_notifikasi'];

mysqli_query($koneksi, "
    UPDATE notifikasi 
    SET dibaca = 1 
    WHERE id_notifikasi = '$id'
");

echo "ok";

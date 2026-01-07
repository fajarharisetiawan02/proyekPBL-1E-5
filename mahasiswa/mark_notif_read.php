<?php
require_once "../config/auth_mahasiswa.php";
require_once "../config/koneksi.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    mysqli_query($koneksi,"
        UPDATE notifikasi
        SET is_read = 1
        WHERE id_notifikasi='$id'
          AND role='mahasiswa'
    ");
}

header("Location: notifikasi.php");
exit;

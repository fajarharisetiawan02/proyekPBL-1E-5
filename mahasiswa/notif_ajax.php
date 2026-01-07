<?php
require_once "../config/auth_mahasiswa.php";
require_once "../config/koneksi.php";

$action = $_POST['action'] ?? '';

if ($action === 'read_one') {
    $id = (int) ($_POST['id'] ?? 0);

    mysqli_query($koneksi, "
        UPDATE notifikasi
        SET is_read = 1
        WHERE id_notifikasi = '$id'
          AND role = 'mahasiswa'
    ");

    echo "ok";
    exit;
}

if ($action === 'read_all') {
    mysqli_query($koneksi, "
        UPDATE notifikasi
        SET is_read = 1
        WHERE role = 'mahasiswa'
    ");

    echo "ok";
    exit;
}

echo "error";

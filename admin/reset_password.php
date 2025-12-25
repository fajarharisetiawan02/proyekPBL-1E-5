<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";

// ===============================
// CEK ID
// ===============================
if (!isset($_GET['id'])) {
    header("Location: mahasiswa.php");
    exit;
}

$id = mysqli_real_escape_string($koneksi, $_GET['id']);

// ===============================
// AMBIL DATA MAHASISWA
// ===============================
$q = mysqli_query($koneksi, "
    SELECT m.nim, l.id_login
    FROM mahasiswa m
    JOIN login l ON m.id_mahasiswa = l.id_mahasiswa
    WHERE m.id_mahasiswa = '$id'
");

$data = mysqli_fetch_assoc($q);

if (!$data) {
    header("Location: mahasiswa.php?reset=failed");
    exit;
}

// ===============================
// RESET PASSWORD → NIM
// ===============================
$passwordBaru = password_hash($data['nim'], PASSWORD_DEFAULT);

mysqli_query($koneksi, "
    UPDATE login SET password = '$passwordBaru'
    WHERE id_login = '{$data['id_login']}'
");

header("Location: mahasiswa.php?reset=success");
exit;

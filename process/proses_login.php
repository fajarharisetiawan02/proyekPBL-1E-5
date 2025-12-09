<?php
session_start();
require "../config/koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];

// CEK LOGIN DI TABEL login
$query = mysqli_query($koneksi,
    "SELECT * FROM login WHERE username='$username' AND password='$password'"
);

$data = mysqli_fetch_assoc($query);

// Jika tidak ditemukan
if (!$data) {
    header("Location: ../login.php?error=1");
    exit;
}

// Simpan session umum
$_SESSION['username'] = $data['username'];
$_SESSION['role'] = $data['role'];

// ================================
// ROLE MAHASISWA → AMBIL dari tabel mahasiswa
// ================================
if ($data['role'] == 'mahasiswa') {

    $mhs = mysqli_query($koneksi,
        "SELECT * FROM mahasiswa WHERE nim='$username'"
    );

    $result = mysqli_fetch_assoc($mhs);

    if ($result) {
        $_SESSION['id_mahasiswa'] = $result['id_mahasiswa'];
    } else {
        $_SESSION['id_mahasiswa'] = null;
    }

    header("Location: ../mahasiswa/dashboard.php");
    exit;
}

// ================================
// ROLE ADMIN
// ================================
if ($data['role'] == 'admin') {
    $_SESSION['id_mahasiswa'] = null;
    header("Location: ../admin/dashboard.php");
    exit;
}
?>

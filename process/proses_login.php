<?php
session_start();
require "../config/koneksi.php";

$username = $_POST['username']; // NIM
$password = $_POST['password'];

// CEK LOGIN
$query = mysqli_query($koneksi,
    "SELECT * FROM login 
     WHERE username='$username' AND password='$password'"
);

$data = mysqli_fetch_assoc($query);

// Jika login gagal
if (!$data) {
    header("Location: ../login.php?error=1");
    exit;
}

// ================================
// SIMPAN SESSION UTAMA
// ================================
$_SESSION['username'] = $data['username']; // NIM
$_SESSION['nama']     = $data['nama'];     // 🔥 INI PENTING
$_SESSION['role']     = $data['role'];

// ================================
// ROLE MAHASISWA
// ================================
if ($data['role'] == 'mahasiswa') {
    header("Location: ../mahasiswa/dashboard.php");
    exit;
}

// ================================
// ROLE ADMIN
// ================================
if ($data['role'] == 'admin') {
    header("Location: ../admin/dashboard.php");
    exit;
}

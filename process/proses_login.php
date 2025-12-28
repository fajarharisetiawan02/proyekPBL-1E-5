<?php
session_start();
require_once "../config/koneksi.php";

// ================================
// VALIDASI FORM
// ================================
if (!isset($_POST['username'], $_POST['password'])) {
    header("Location: ../login.php?error=1");
    exit;
}

$username = trim($_POST['username']);
$password = $_POST['password'];

// ================================
// AMBIL DATA LOGIN
// ================================
$q = mysqli_query($koneksi, "
    SELECT * FROM login 
    WHERE username = '$username'
    LIMIT 1
");

$data = mysqli_fetch_assoc($q);

// username tidak ada
if (!$data) {
    header("Location: ../login.php?error=1");
    exit;
}

// password salah
if (!password_verify($password, $data['password'])) {
    header("Location: ../login.php?error=1");
    exit;
}

// ================================
// SESSION UMUM
// ================================
$_SESSION['id_login'] = $data['id_login'];
$_SESSION['username'] = $data['username'];
$_SESSION['role']     = $data['role'];

// ================================
// JIKA MAHASISWA
// ================================
if ($data['role'] === 'mahasiswa') {

    // Ambil data mahasiswa BERDASARKAN NIM
    $qMhs = mysqli_query($koneksi, "
        SELECT * FROM mahasiswa 
        WHERE nim = '$username'
        LIMIT 1
    ");

    $mhs = mysqli_fetch_assoc($qMhs);

    // Jika data mahasiswa ADA → simpan session
    if ($mhs) {
        $_SESSION['id_mahasiswa'] = $mhs['id_mahasiswa'];
        $_SESSION['nim']          = $mhs['nim'];
        $_SESSION['nama']         = $mhs['nama'];
        $_SESSION['prodi']        = $mhs['prodi'];
        $_SESSION['email']        = $mhs['email'];
        $_SESSION['no_hp']        = $mhs['no_hp'];
        $_SESSION['foto']         = $mhs['foto'];
    }

    // WALAU DATA MAHASISWA TIDAK ADA → TETAP LOGIN
    header("Location: ../mahasiswa/dashboard.php");
    exit;
}

// ================================
// JIKA ADMIN
// ================================
if ($data['role'] === 'admin') {
    header("Location: ../admin/dashboard.php");
    exit;
}

// ================================
header("Location: ../login.php?error=1");
exit;

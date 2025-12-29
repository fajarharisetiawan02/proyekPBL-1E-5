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
<<<<<<< HEAD

// ================================
// SESSION UMUM
// ================================
$_SESSION['id_login'] = $data['id_login'];
$_SESSION['username'] = $data['username'];
$_SESSION['role']     = $data['role'];
$_SESSION['nama']     = $data['nama'];
$_SESSION['email']    = $data['email'];

// ================================
// JIKA MAHASISWA
// ================================
if ($data['role'] === 'mahasiswa') {

=======

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
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
    $qMhs = mysqli_query($koneksi, "
        SELECT * FROM mahasiswa 
        WHERE nim = '$username'
        LIMIT 1
    ");

    $mhs = mysqli_fetch_assoc($qMhs);

<<<<<<< HEAD
    if ($mhs) {
        $_SESSION['id_mahasiswa'] = $mhs['id_mahasiswa'];
        $_SESSION['nim']          = $mhs['nim'];
        $_SESSION['prodi']        = $mhs['prodi'];
        $_SESSION['foto']         = $mhs['foto'];
    }

=======
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
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
    header("Location: ../mahasiswa/dashboard.php");
    exit;
}

// ================================
<<<<<<< HEAD
// JIKA DOSEN / ADMIN_DOSEN
// ================================
if ($data['role'] === 'admin_dosen' || $data['role'] === 'dosen') {

    // Ambil data dosen berdasarkan NIDN
    $qDosen = mysqli_query($koneksi, "
        SELECT * FROM dosen
        WHERE nidn = '$username'
        LIMIT 1
    ");

    $dsn = mysqli_fetch_assoc($qDosen);

    if ($dsn) {
        $_SESSION['id_dosen']   = $dsn['id_dosen'];
        $_SESSION['nidn']       = $dsn['nidn'];
        $_SESSION['nama_dosen'] = $dsn['nama_dosen'];
        $_SESSION['fakultas']   = $dsn['fakultas'];
        $_SESSION['prodi']      = $dsn['prodi'];
        $_SESSION['no_hp']      = $dsn['no_hp'];
        $_SESSION['foto']       = $dsn['foto'];
    }

    // Arahkan sesuai role
    if ($data['role'] === 'admin_dosen') {
        header("Location: ../admin/dashboard.php");
    } else {
        header("Location: ../dosen/dashboard.php");
    }
    exit;
}

// ================================
// JIKA ADMIN MURNI
// ================================
=======
// JIKA ADMIN
// ================================
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
if ($data['role'] === 'admin') {
    header("Location: ../admin/dashboard.php");
    exit;
}

// ================================
header("Location: ../login.php?error=1");
exit;

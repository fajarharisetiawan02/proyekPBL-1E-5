<?php
session_start();
require_once "../config/koneksi.php";

<<<<<<< HEAD
/* ===============================
   VALIDASI FORM
================================ */
=======
// ================================
// VALIDASI FORM
// ================================
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
if (!isset($_POST['username'], $_POST['password'])) {
    header("Location: ../login.php?error=1");
    exit;
}

$username = trim($_POST['username']);
$password = $_POST['password'];

<<<<<<< HEAD
/* ===============================
   AMBIL DATA LOGIN
================================ */
$q = mysqli_query($koneksi, "
    SELECT * 
    FROM login
=======
// ================================
// AMBIL DATA LOGIN
// ================================
$q = mysqli_query($koneksi, "
    SELECT * FROM login 
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
    WHERE username = '$username'
    LIMIT 1
");

$data = mysqli_fetch_assoc($q);

<<<<<<< HEAD
/* USERNAME TIDAK DITEMUKAN */
=======
// username tidak ada
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
if (!$data) {
    header("Location: ../login.php?error=1");
    exit;
}

<<<<<<< HEAD
/* PASSWORD SALAH */
=======
// password salah
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
if (!password_verify($password, $data['password'])) {
    header("Location: ../login.php?error=1");
    exit;
}
<<<<<<< HEAD

/* ===============================
   UPDATE LOGIN TERAKHIR (WAJIB)
================================ */
mysqli_query($koneksi, "
    UPDATE login 
    SET last_login = NOW()
    WHERE id_login = '{$data['id_login']}'
");

/* ===============================
   SESSION UMUM
================================ */
$_SESSION['id_login'] = $data['id_login'];
$_SESSION['username'] = $data['username'];
$_SESSION['nama']     = $data['nama'];
$_SESSION['email']    = $data['email'];

/* ===============================
   LOGIN MAHASISWA
================================ */
if (!empty($data['id_mahasiswa'])) {

    $qMhs = mysqli_query($koneksi, "
        SELECT * FROM mahasiswa
        WHERE id_mahasiswa = '{$data['id_mahasiswa']}'
        LIMIT 1
    ");

    $mhs = mysqli_fetch_assoc($qMhs);

    if (!$mhs) {
        session_destroy();
        header("Location: ../login.php?error=1");
        exit;
    }

    $_SESSION['role']         = 'mahasiswa';
    $_SESSION['id_mahasiswa'] = $mhs['id_mahasiswa'];
    $_SESSION['nim']          = $mhs['nim'];
    $_SESSION['jurusan']      = $mhs['jurusan'];
    $_SESSION['prodi']        = $mhs['prodi'];
    $_SESSION['kelas']        = $mhs['kelas'];
    $_SESSION['shift']        = $mhs['shift'];
    $_SESSION['semester']     = $mhs['semester'];

=======
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
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
    header("Location: ../mahasiswa/dashboard.php");
    exit;
}

<<<<<<< HEAD
/* ===============================
   LOGIN DOSEN / ADMIN
================================ */
if (!empty($data['id_admin'])) {

    $qAdmin = mysqli_query($koneksi, "
        SELECT * FROM admin
        WHERE id_admin = '{$data['id_admin']}'
        LIMIT 1
    ");

    $admin = mysqli_fetch_assoc($qAdmin);

    if (!$admin) {
        session_destroy();
        header("Location: ../login.php?error=1");
        exit;
    }

    $_SESSION['role']     = 'admin';
    $_SESSION['id_admin'] = $admin['id_admin'];
    $_SESSION['nidn']     = $admin['nidn'];
    $_SESSION['prodi']    = $admin['prodi'];
    $_SESSION['jabatan']  = $admin['jabatan'];
    $_SESSION['status']   = $admin['status'];

=======
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
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
    header("Location: ../admin/dashboard.php");
    exit;
}

<<<<<<< HEAD
/* ===============================
   GAGAL TOTAL
================================ */
session_destroy();
=======
// ================================
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
header("Location: ../login.php?error=1");
exit;

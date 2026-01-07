<?php
session_start();
require_once "../config/koneksi.php";

/* ===============================
   VALIDASI FORM
================================ */
if (!isset($_POST['username'], $_POST['password'])) {
    header("Location: ../login.php?error=1");
    exit;
}

$username = trim($_POST['username']);
$password = $_POST['password'];

/* ===============================
   AMBIL DATA LOGIN
================================ */
$q = mysqli_query($koneksi, "
    SELECT * 
    FROM login
    WHERE username = '$username'
    LIMIT 1
");

$data = mysqli_fetch_assoc($q);

/* USERNAME TIDAK DITEMUKAN */
if (!$data) {
    header("Location: ../login.php?error=1");
    exit;
}

/* PASSWORD SALAH */
if (!password_verify($password, $data['password'])) {
    header("Location: ../login.php?error=1");
    exit;
}

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

    header("Location: ../mahasiswa/dashboard.php");
    exit;
}

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

    header("Location: ../admin/dashboard.php");
    exit;
}

/* ===============================
   GAGAL TOTAL
================================ */
session_destroy();
header("Location: ../login.php?error=1");
exit;

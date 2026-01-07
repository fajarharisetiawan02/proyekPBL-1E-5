<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";

/* ===============================
   CEK LOGIN ADMIN
================================ */
if (!isset($_SESSION['username'])) {
    echo "<script>
            alert('Silakan login terlebih dahulu!');
            window.location='../login.php';
          </script>";
    exit;
}

$username       = $_SESSION['username'];
$password_lama  = $_POST['password_lama'] ?? '';
$password_baru  = $_POST['password_baru'] ?? '';
$konfirmasi     = $_POST['konfirmasi'] ?? '';

/* ===============================
   VALIDASI INPUT
================================ */
if ($password_lama === '' || $password_baru === '' || $konfirmasi === '') {
    echo "<script>
            alert('Semua field wajib diisi!');
            window.history.back();
          </script>";
    exit;
}

/* ===============================
   AMBIL PASSWORD LAMA
================================ */
$query = mysqli_query($koneksi, "
    SELECT password 
    FROM login 
    WHERE username = '$username'
    LIMIT 1
");

$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "<script>
            alert('Akun tidak ditemukan!');
            window.location='../login.php';
          </script>";
    exit;
}

/* ===============================
   CEK PASSWORD LAMA
================================ */
if (!password_verify($password_lama, $data['password'])) {
    echo "<script>
            alert('Password lama salah!');
            window.history.back();
          </script>";
    exit;
}

/* ===============================
   CEK KONFIRMASI
================================ */
if ($password_baru !== $konfirmasi) {
    echo "<script>
            alert('Konfirmasi password tidak cocok!');
            window.history.back();
          </script>";
    exit;
}

/* ===============================
   UPDATE PASSWORD BARU
================================ */
$password_hash = password_hash($password_baru, PASSWORD_DEFAULT);

$update = mysqli_query($koneksi, "
    UPDATE login 
    SET password = '$password_hash'
    WHERE username = '$username'
");

/* ===============================
   HASIL
================================ */
if ($update) {
    echo "<script>
            alert('Password berhasil diperbarui!');
            window.location='dashboard.php';
          </script>";
} else {
    echo "<script>
            alert('Terjadi kesalahan, password gagal diperbarui!');
            window.history.back();
          </script>";
}
?>

<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";

if (!isset($_SESSION['username'])) {
    echo "<script>alert('Silakan login terlebih dahulu!'); window.location='../tampilan_login.php';</script>";
    exit;
}

$username       = $_SESSION['username'];
$password_lama  = $_POST['password_lama'];
$password_baru  = $_POST['password_baru'];
$konfirmasi     = $_POST['konfirmasi'];

$query = mysqli_query($koneksi, "SELECT password FROM login WHERE username='$username'");
$data  = mysqli_fetch_assoc($query);

$password_db = $data['password'];

if ($password_lama !== $password_db) {
    echo "<script>
            alert('Password lama salah!');
            window.history.back();
          </script>";
    exit;
}

if ($password_baru !== $konfirmasi) {
    echo "<script>
            alert('Konfirmasi password tidak cocok!');
            window.history.back();
          </script>";
    exit;
}

$update = mysqli_query($koneksi, "
    UPDATE login 
    SET password='$password_baru' 
    WHERE username='$username'
");

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

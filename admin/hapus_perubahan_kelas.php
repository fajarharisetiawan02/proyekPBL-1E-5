<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";


if (!isset($_GET['id'])) {
    header("Location: perubahan_kelas.php");
    exit;
}

$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM perubahan_kelas WHERE id_kelas='$id'");

header("Location: perubahan_kelas.php");
exit;
?>

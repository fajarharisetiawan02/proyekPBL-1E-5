<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";

$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM login WHERE id_mahasiswa='$id'");
mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE id_mahasiswa='$id'");

header("Location: mahasiswa.php");
exit;

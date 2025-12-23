<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";

$id = $_GET['id'];

$q = mysqli_query($koneksi, "
    SELECT nim FROM mahasiswa WHERE id_mahasiswa='$id'
");
$mhs = mysqli_fetch_assoc($q);

$password = password_hash($mhs['nim'], PASSWORD_DEFAULT);

mysqli_query($koneksi, "
    UPDATE login 
    SET password='$password' 
    WHERE id_mahasiswa='$id'
");

header("Location: mahasiswa.php");
exit;

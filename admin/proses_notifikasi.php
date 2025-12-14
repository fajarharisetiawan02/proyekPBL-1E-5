<?php
include "../config/koneksi.php";

$judul = $_POST['judul'];
$isi   = $_POST['isi'];
$role  = $_POST['role'];

mysqli_query($koneksi, "
    INSERT INTO notifikasi (judul, isi, role)
    VALUES ('$judul','$isi','$role')
");

header("Location: notifikasi.php");

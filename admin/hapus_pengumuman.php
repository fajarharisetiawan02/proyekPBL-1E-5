<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";

/* ===============================
   CEK PARAMETER ID
================================ */
if (!isset($_GET['id'])) {
    header("Location: pengumuman.php");
    exit;
}

$id = (int) $_GET['id'];

/* ===============================
   CEK DATA ADA ATAU TIDAK
================================ */
$cek = mysqli_query($koneksi, "
    SELECT id_pengumuman 
    FROM pengumuman 
    WHERE id_pengumuman = '$id'
");

if (mysqli_num_rows($cek) == 0) {
    header("Location: pengumuman.php?status=notfound");
    exit;
}

/* ===============================
   PROSES HAPUS
================================ */
mysqli_query($koneksi, "
    DELETE FROM pengumuman 
    WHERE id_pengumuman = '$id'
");

/* ===============================
   REDIRECT
================================ */
header("Location: pengumuman.php?status=deleted");
exit;

<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";

/* ===============================
   VALIDASI ID
================================ */
if (!isset($_GET['id'])) {
    header("Location: dosen.php");
    exit;
}

$id = mysqli_real_escape_string($koneksi, $_GET['id']);

/* ===============================
   HAPUS LOGIN DOSEN
   relasi: login.id_admin → admin.id_admin
================================ */
mysqli_query($koneksi, "
    DELETE FROM login 
    WHERE id_admin = '$id'
");

/* ===============================
   HAPUS DATA DOSEN
================================ */
mysqli_query($koneksi, "
    DELETE FROM admin 
    WHERE id_admin = '$id'
");

/* ===============================
   REDIRECT
================================ */
header("Location: dosen.php?hapus=success");
exit;

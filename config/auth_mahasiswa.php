<?php
session_start();
require_once "koneksi.php";

/* =========================
   CEK LOGIN MAHASISWA
   ========================= */
if (
    !isset($_SESSION['id_login']) ||
    !isset($_SESSION['role']) ||
    $_SESSION['role'] !== 'mahasiswa'
) {
    header("Location: ../login.php");
    exit;
}

/* =========================
   AMBIL DATA MAHASISWA
   ========================= */
$id_login = $_SESSION['id_login'];

/*
  STRUKTUR:
  login.id_mahasiswa -> mahasiswa.id_mahasiswa
*/
$query = mysqli_query($koneksi, "
    SELECT 
        m.kelas,
        m.shift,
        m.prodi
    FROM login l
    JOIN mahasiswa m ON l.id_mahasiswa = m.id_mahasiswa
    WHERE l.id_login = '$id_login'
    LIMIT 1
");

$data = mysqli_fetch_assoc($query);

/* =========================
   SET SESSION DATA AKADEMIK
   ========================= */
if ($data) {
    $_SESSION['kelas'] = $data['kelas'];
    $_SESSION['shift'] = $data['shift'];
    $_SESSION['prodi'] = $data['prodi'];
}

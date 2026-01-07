<?php
<<<<<<< HEAD
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/koneksi.php";

/* ===============================
   CEK LOGIN MAHASISWA
================================ */
if (
    empty($_SESSION['id_login']) ||
    empty($_SESSION['role']) ||
=======
session_start();
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
require_once "koneksi.php";

/* =========================
   CEK LOGIN MAHASISWA
   ========================= */
<<<<<<< HEAD
=======
=======

>>>>>>> 9a567987dd90af1392f8d15dfcbd79423ecb4815
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
if (
    !isset($_SESSION['id_login']) ||
    !isset($_SESSION['role']) ||
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
    $_SESSION['role'] !== 'mahasiswa'
) {
    header("Location: ../login.php");
    exit;
}
<<<<<<< HEAD

/* ===============================
   AMBIL DATA MAHASISWA
   RELASI PALING AMAN: login.username = mahasiswa.nim
================================ */
$id_login = $_SESSION['id_login'];

$q = mysqli_query($koneksi, "
    SELECT 
        m.jurusan,
        m.prodi,
        m.kelas,
        m.shift,
        m.semester
    FROM login l
    JOIN mahasiswa m ON l.username = m.nim
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e

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
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
    WHERE l.id_login = '$id_login'
    LIMIT 1
");

<<<<<<< HEAD
$mhs = mysqli_fetch_assoc($q);

/* ===============================
   SET SESSION AKADEMIK (WAJIB)
================================ */
if ($mhs) {
    $_SESSION['jurusan']  = $mhs['jurusan'];
    $_SESSION['prodi']    = $mhs['prodi'];
    $_SESSION['kelas']    = $mhs['kelas'];
    $_SESSION['shift']    = $mhs['shift'];
    $_SESSION['semester'] = $mhs['semester'];
}

/* ===============================
   ANTI CACHE
================================ */
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
=======
$data = mysqli_fetch_assoc($query);

/* =========================
   SET SESSION DATA AKADEMIK
   ========================= */
if ($data) {
    $_SESSION['kelas'] = $data['kelas'];
    $_SESSION['shift'] = $data['shift'];
    $_SESSION['prodi'] = $data['prodi'];
}
<<<<<<< HEAD
=======
=======
>>>>>>> 9a567987dd90af1392f8d15dfcbd79423ecb4815
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717

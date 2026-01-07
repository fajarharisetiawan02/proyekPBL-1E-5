<?php
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
    $_SESSION['role'] !== 'mahasiswa'
) {
    header("Location: ../login.php");
    exit;
}

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
    WHERE l.id_login = '$id_login'
    LIMIT 1
");

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

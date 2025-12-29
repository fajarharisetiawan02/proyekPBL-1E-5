<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

<<<<<<< HEAD
// ================================
// WAJIB LOGIN
// ================================
if (!isset($_SESSION['id_login'], $_SESSION['role'])) {
=======
// wajib login
if (!isset($_SESSION['id_login'])) {
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
    header("Location: ../login.php");
    exit;
}

<<<<<<< HEAD
// ================================
// KHUSUS HALAMAN ADMIN
// ================================
if (
    strpos($_SERVER['REQUEST_URI'], '/admin/') !== false &&
    !in_array($_SESSION['role'], ['admin', 'admin_dosen'])
=======
// khusus admin (jika file admin)
if (
    strpos($_SERVER['REQUEST_URI'], '/admin/') !== false &&
    $_SESSION['role'] !== 'admin'
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
) {
    header("Location: ../login.php");
    exit;
}

<<<<<<< HEAD
// ================================
// ANTI CACHE
// ================================
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");
=======
// anti cache
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e

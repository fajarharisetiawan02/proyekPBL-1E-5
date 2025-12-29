<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ================================
// WAJIB LOGIN
// ================================
if (!isset($_SESSION['id_login'], $_SESSION['role'])) {
    header("Location: ../login.php");
    exit;
}

// ================================
// KHUSUS HALAMAN ADMIN
// ================================
if (
    strpos($_SERVER['REQUEST_URI'], '/admin/') !== false &&
    !in_array($_SESSION['role'], ['admin', 'admin_dosen'])
) {
    header("Location: ../login.php");
    exit;
}

// ================================
// ANTI CACHE
// ================================
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// wajib login
if (!isset($_SESSION['id_login'])) {
    header("Location: ../login.php");
    exit;
}

// khusus admin (jika file admin)
if (
    strpos($_SERVER['REQUEST_URI'], '/admin/') !== false &&
    $_SESSION['role'] !== 'admin'
) {
    header("Location: ../login.php");
    exit;
}

// anti cache
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");

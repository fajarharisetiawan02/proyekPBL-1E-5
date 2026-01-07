<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* ===============================
   WAJIB LOGIN ADMIN / DOSEN
================================ */
if (empty($_SESSION['id_admin'])) {
    header("Location: ../login.php");
    exit;
}

/* ===============================
   ANTI CACHE
================================ */
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");

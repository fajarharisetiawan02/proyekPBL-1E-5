<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";

// ===============================
// CEK ID DOSEN
// ===============================
if (!isset($_GET['id'])) {
    header("Location: dosen.php");
    exit;
}

$id = mysqli_real_escape_string($koneksi, $_GET['id']);

// ===============================
// AMBIL DATA DOSEN + LOGIN
// ===============================
$q = mysqli_query($koneksi, "
    SELECT a.nidn, l.id_login
    FROM admin a
    JOIN login l ON a.id_admin = l.id_admin
    WHERE a.id_admin = '$id'
    LIMIT 1
");

$data = mysqli_fetch_assoc($q);

if (!$data) {
    header("Location: dosen.php?reset=failed");
    exit;
}

// ===============================
// RESET PASSWORD → NIDN
// ===============================
$passwordBaru = password_hash($data['nidn'], PASSWORD_DEFAULT);

mysqli_query($koneksi, "
    UPDATE login 
    SET password = '$passwordBaru'
    WHERE id_login = '{$data['id_login']}'
");

// ===============================
header("Location: dosen.php?reset=success");
exit;

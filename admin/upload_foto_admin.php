<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";

$id_login = $_SESSION['id_login'];

if (!isset($_FILES['foto'])) {
    header("Location: profil_admin.php");
    exit;
}

$foto = $_FILES['foto'];
$ext  = strtolower(pathinfo($foto['name'], PATHINFO_EXTENSION));
$allowed = ['jpg','jpeg','png','webp'];

if (!in_array($ext, $allowed)) {
    die("Format foto tidak didukung");
}

$namaFile = "admin_" . $id_login . "_" . time() . "." . $ext;
$path = "../uploads/foto_admin/" . $namaFile;

move_uploaded_file($foto['tmp_name'], $path);

mysqli_query($koneksi, "
    UPDATE login SET foto='$namaFile'
    WHERE id_login='$id_login'
");

header("Location: profil_admin.php");
exit;

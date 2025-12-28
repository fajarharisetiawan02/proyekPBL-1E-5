<?php
require_once "../config/koneksi_admin.php";

$nim = '3312511140';
$hash = password_hash($nim, PASSWORD_DEFAULT);

mysqli_query($koneksi, "
    UPDATE login SET password='$hash'
    WHERE username='$nim'
");

echo "RESET OK";

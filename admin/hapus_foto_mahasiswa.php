<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";


$id = $_POST['id_mahasiswa'];

$get = mysqli_query($koneksi, "SELECT foto FROM mahasiswa WHERE id_mahasiswa='$id'");
$data = mysqli_fetch_assoc($get);

if ($data['foto'] != "default.png") {
    if (file_exists("../uploads/" . $data['foto'])) {
        unlink("../uploads/" . $data['foto']);
    }
}

mysqli_query($koneksi, "UPDATE mahasiswa SET foto='default.png' WHERE id_mahasiswa='$id'");

echo "success";
?>

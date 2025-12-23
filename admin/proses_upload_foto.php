<?php
require_once "../config/auth.php";
require_once "../config/koneksi.php";

$id = $_POST['id_mahasiswa'];

$get = mysqli_query($koneksi, "SELECT foto FROM mahasiswa WHERE id_mahasiswa='$id'");
$old = mysqli_fetch_assoc($get);
$oldFoto = $old['foto'];

if (!isset($_FILES['foto']) || $_FILES['foto']['error'] == 4) {
    echo "no_file";
    exit;
}

$foto = $_FILES['foto'];

$allowed = ['jpg', 'jpeg', 'png'];
$ext = strtolower(pathinfo($foto['name'], PATHINFO_EXTENSION));

if (!in_array($ext, $allowed)) {
    echo "invalid_type";
    exit;
}

if ($foto['size'] > 3000000) {
    echo "file_too_large";
    exit;
}

$newName = time() . "_" . rand(1000, 9999) . "." . $ext;
$uploadPath = "../uploads/" . $newName;

if (move_uploaded_file($foto['tmp_name'], $uploadPath)) {

    if ($oldFoto != "default.png" && file_exists("../uploads/" . $oldFoto)) {
        unlink("../uploads/" . $oldFoto);
    }

    mysqli_query($koneksi, "UPDATE mahasiswa SET foto='$newName' WHERE id_mahasiswa='$id'");

    echo "success";
} else {
    echo "upload_failed";
}
?>

<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";

$id = $_POST['id_mahasiswa'];

if (!isset($_FILES['foto'])) {
    echo json_encode(["status" => "error", "msg" => "Tidak ada file"]);
    exit;
}

$folder = "../uploads/";
if (!is_dir($folder)) mkdir($folder, 0777, true);

$ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
$filename = "mhs_" . $id . "_" . time() . "." . $ext;
$path = $folder . $filename;

if (move_uploaded_file($_FILES['foto']['tmp_name'], $path)) {

    mysqli_query($koneksi, "UPDATE mahasiswa SET foto='$filename' WHERE id_mahasiswa='$id'");

    echo json_encode([
        "status" => "success",
        "msg" => "Foto berhasil diupload!",
        "newPath" => "../uploads/" . $filename
    ]);

} else {
    echo json_encode(["status" => "error", "msg" => "Gagal upload file"]);
}
?>

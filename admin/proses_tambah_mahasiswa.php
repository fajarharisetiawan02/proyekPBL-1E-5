<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";

$nim = $_POST['nim'];
$nama = $_POST['nama'];
$prodi = $_POST['prodi'];
$email = $_POST['email'];
$no_hp = $_POST['no_hp'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$foto = "default.png";
if ($_FILES['foto']['name'] != "") {
    $foto = time() . "_" . $_FILES['foto']['name'];
    move_uploaded_file($_FILES['foto']['tmp_name'], "uploads/" . $foto);
}

$q = mysqli_query($koneksi, "INSERT INTO mahasiswa VALUES (
    NULL, '$nim', '$nama', '$prodi', '$email', '$no_hp', '$foto', '$password'
)");

header("Location: daftar_mahasiswa.php");
?>

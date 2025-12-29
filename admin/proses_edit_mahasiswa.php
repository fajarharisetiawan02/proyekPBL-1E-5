<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";

$id = $_POST['id'];
$nama = $_POST['nama'];
$prodi = $_POST['prodi'];
$email = $_POST['email'];
$no_hp = $_POST['no_hp'];

$old = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT foto FROM mahasiswa WHERE id_mahasiswa='$id'"));
$foto = $old['foto'];

if ($_FILES['foto']['name'] != "") {
    $foto = time() . "_" . $_FILES['foto']['name'];
    move_uploaded_file($_FILES['foto']['tmp_name'], "uploads/" . $foto);
}

mysqli_query($koneksi, "UPDATE mahasiswa SET 
    nama='$nama',
    prodi='$prodi',
    email='$email',
    no_hp='$no_hp',
    foto='$foto'
WHERE id_mahasiswa='$id'");

header("Location: profil_mahasiswa.php?id=$id");
?>

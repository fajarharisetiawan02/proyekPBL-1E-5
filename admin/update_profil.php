<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";

$id = $_POST['id_mahasiswa'];
$nama = $_POST['nama'];
$prodi = $_POST['prodi'];
$email = $_POST['email'];
$no_hp = $_POST['no_hp'];

$update = mysqli_query($koneksi, "UPDATE mahasiswa SET
        nama='$nama',
        prodi='$prodi',
        email='$email',
        no_hp='$no_hp'
        WHERE id_mahasiswa='$id'
");

if ($update) {
    header("Location: profil_mahasiswa.php?id=$id&update=success");
} else {
    echo "Gagal update data!";
}
?>

<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../profil_mahasiswa.php");
    exit;
}

$id_mahasiswa = mysqli_real_escape_string($koneksi, $_POST['id_mahasiswa']);
$nama   = mysqli_real_escape_string($koneksi, $_POST['nama']);
$prodi  = mysqli_real_escape_string($koneksi, $_POST['prodi']);
$email  = mysqli_real_escape_string($koneksi, $_POST['email']);
$no_hp  = mysqli_real_escape_string($koneksi, $_POST['no_hp']);

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('Email tidak valid');history.back();</script>";
    exit;
}

$query = mysqli_query($koneksi, "
    UPDATE mahasiswa 
    SET 
        nama   = '$nama',
        prodi  = '$prodi',
        email  = '$email',
        no_hp  = '$no_hp'
    WHERE id_mahasiswa = '$id_mahasiswa'
");

if ($query) {
    echo "<script>
        alert('Profil berhasil diperbarui');
        window.location = 'profil_mahasiswa.php?id=$id_mahasiswa';
    </script>";
} else {
    echo "<script>
        alert('Gagal memperbarui data');
        history.back();
    </script>";
}

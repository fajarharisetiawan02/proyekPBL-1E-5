<?php
require_once "../config/auth_admin.php";
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";

// ===============================
// CEK ID
// ===============================
if (!isset($_GET['id'])) {
    header("Location: mahasiswa.php");
    exit;
}

$id = mysqli_real_escape_string($koneksi, $_GET['id']);

// ===============================
// AMBIL DATA MAHASISWA
// ===============================
$query = mysqli_query($koneksi, "
    SELECT * FROM mahasiswa 
    WHERE id_mahasiswa = '$id'
");

$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "<h3>Data mahasiswa tidak ditemukan</h3>";
    exit;
}

// ===============================
// PROSES UPDATE
// ===============================
if (isset($_POST['update'])) {

    $nim     = mysqli_real_escape_string($koneksi, $_POST['nim']);
    $nama    = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $prodi   = mysqli_real_escape_string($koneksi, $_POST['prodi']);
    $jurusan = mysqli_real_escape_string($koneksi, $_POST['jurusan']);
    $kelas   = mysqli_real_escape_string($koneksi, $_POST['kelas']);
    $email   = mysqli_real_escape_string($koneksi, $_POST['email']);

    mysqli_query($koneksi, "
        UPDATE mahasiswa SET
            nim='$nim',
            nama='$nama',
            prodi='$prodi',
            jurusan='$jurusan',
            kelas='$kelas',
            email='$email'
        WHERE id_mahasiswa='$id'
    ");

    header("Location: mahasiswa.php?update=success");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profil Mahasiswa</title>
    <link rel="stylesheet" href="../assets/css/style7.css">
</head>

<body>

<div class="container">

    <div class="main-content">

        <h2>Edit Profil Mahasiswa</h2>

        <form action="update_mahasiswa.php" method="POST">

            <input type="hidden" name="id_mahasiswa" value="<?= $mhs['id_mahasiswa']; ?>">

            <label>Nama Lengkap</label>
            <input type="text" name="nama" value="<?= $mhs['nama']; ?>" required>

            <label>Program Studi</label>
            <input type="text" name="prodi" value="<?= $mhs['prodi']; ?>" required>

            <label>Email</label>
            <input type="email" name="email" value="<?= $mhs['email']; ?>" required>

            <label>No HP</label>
            <input type="text" name="no_hp" value="<?= $mhs['no_hp']; ?>">

            <button type="submit" class="btn-save">Simpan Perubahan</button>
        </form>

        <button onclick="history.back()" class="btn-cancel">Batal</button>

    </div>
</div>

</body>

</html>

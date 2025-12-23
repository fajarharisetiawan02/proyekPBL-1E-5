<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";


if (!isset($_GET['id'])) {
    echo "ID tidak ditemukan";
    exit;
}

$id = $_GET['id'];
$q = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE id_mahasiswa='$id'");
$mhs = mysqli_fetch_assoc($q);

if (!$mhs) {
    echo "Mahasiswa tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Profil Mahasiswa</title>
    <link rel="stylesheet" href="../assets/css/style7.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
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

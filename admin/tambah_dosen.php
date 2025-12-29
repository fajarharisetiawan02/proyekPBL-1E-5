<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";

$pesan = "";

if (isset($_POST['simpan'])) {

    $nidn     = mysqli_real_escape_string($koneksi, $_POST['nidn']);
    $nama     = mysqli_real_escape_string($koneksi, $_POST['nama_dosen']);
    $email    = mysqli_real_escape_string($koneksi, $_POST['email']);
    $no_hp    = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
    $fakultas = mysqli_real_escape_string($koneksi, $_POST['fakultas']);
    $prodi    = mysqli_real_escape_string($koneksi, $_POST['prodi']);

    // CEK NIDN
    $cek = mysqli_query($koneksi, "
        SELECT id_dosen 
        FROM dosen 
        WHERE nidn='$nidn'
    ");

    if (mysqli_num_rows($cek) > 0) {
        $pesan = "<div class='alert error'>NIDN sudah terdaftar</div>";
    } else {

        // SIMPAN DATA DOSEN
        mysqli_query($koneksi, "
            INSERT INTO dosen 
            (nidn, nama_dosen, email, no_hp, fakultas, prodi)
            VALUES 
            ('$nidn', '$nama', '$email', '$no_hp', '$fakultas', '$prodi')
        ");

        // PASSWORD AWAL = NIDN
        $password = password_hash($nidn, PASSWORD_DEFAULT);

        // SIMPAN AKUN LOGIN (ADMIN DOSEN)
        mysqli_query($koneksi, "
            INSERT INTO login
            (username, password, nama, email, role)
            VALUES
            ('$nidn', '$password', '$nama', '$email', 'admin_dosen')
        ");

        header("Location: dosen.php?success=1");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Dosen</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="icon" type="image/png" href="../assets/img/Logo Politeknik.png">
<link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
<link rel="stylesheet" href="../assets/css/mahasiswa.css">
<link rel="stylesheet" href="../assets/css/sidebar.css">
<link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
</head>

<body>

<div class="main-wrapper">

<?php include "../components_admin/sidebar.php"; ?>
<?php include "../components_admin/topbar.php"; ?>

<div class="main-content">
<div class="content-container">

<h2>Tambah Data Dosen</h2>
<p class="page-desc">
    Silakan lengkapi data dosen. Akun login admin dibuat otomatis.
</p>

<?= $pesan; ?>

<form method="POST" class="form-box">

    <label>NIDN</label>
    <input type="text" name="nidn" required>

    <label>Nama Lengkap</label>
    <input type="text" name="nama_dosen" required>

    <hr>

    <label>Fakultas</label>
    <input type="text" name="fakultas" required>

    <label>Program Studi</label>
    <input type="text" name="prodi" required>

    <label>No HP</label>
    <input type="text" name="no_hp">

    <hr>

    <label>Email</label>
    <input type="email" name="email" required>

    <small class="hint">
        Username & Password awal dosen = <b>NIDN</b>
    </small>

    <div class="form-action">
        <button type="submit" name="simpan">
            <i class="fa fa-save"></i> Simpan Data
        </button>
        <a href="data_dosen.php" class="btn-cancel">Kembali</a>
    </div>

</form>

</div>
</div>
</div>

<footer>
© 2025 Aplikasi Pengumuman Akademik Online | Politeknik Negeri Batam
</footer>

</body>
</html>

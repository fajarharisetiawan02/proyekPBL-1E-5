<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";

$pesan = "";

if (isset($_POST['simpan'])) {

    $nidn    = mysqli_real_escape_string($koneksi, $_POST['nidn']);
    $nama    = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $prodi   = mysqli_real_escape_string($koneksi, $_POST['prodi']);
    $jabatan = mysqli_real_escape_string($koneksi, $_POST['jabatan']);
    $email   = mysqli_real_escape_string($koneksi, $_POST['email']);

    // FOTO OPSIONAL
    $foto = null;
    if (!empty($_FILES['foto']['name'])) {
        $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        $foto = "dosen_" . time() . "." . $ext;
        $folder = "../uploads/foto_dosen/";

        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }
        move_uploaded_file($_FILES['foto']['tmp_name'], $folder . $foto);
    }

    // CEK NIDN
    $cek = mysqli_query($koneksi, "SELECT id_admin FROM admin WHERE nidn='$nidn'");
    if (mysqli_num_rows($cek) > 0) {
        $pesan = "<div class='alert error'>NIDN sudah terdaftar</div>";
    } else {

        // PASSWORD DEFAULT = NIDN
        $password = password_hash($nidn, PASSWORD_DEFAULT);

        // ===============================
        // SIMPAN KE TABEL ADMIN
        // ===============================
        mysqli_query($koneksi, "
            INSERT INTO admin 
            (nidn, username, nama, prodi, jabatan, email, password, foto, status)
            VALUES
            ('$nidn','$nidn','$nama','$prodi','$jabatan','$email','$password','$foto','aktif')
        ");

        $id_admin = mysqli_insert_id($koneksi);

        // ===============================
        // SIMPAN KE TABEL LOGIN
        // ===============================
        mysqli_query($koneksi, "
            INSERT INTO login (username, password, nama, email, id_admin, role)
            VALUES ('$nidn','$password','$nama','$email','$id_admin','dosen')
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
    Lengkapi data dosen. Akun login dibuat otomatis.
</p>

<?= $pesan; ?>

<form method="POST" enctype="multipart/form-data" class="form-box">

    <label>NIDN</label>
    <input type="text" name="nidn" required>

    <label>Nama Lengkap</label>
    <input type="text" name="nama" required>

    <hr>

    <!-- PROGRAM STUDI DROPDOWN -->
    <label>Program Studi</label>
    <select name="prodi" required>
        <option value="">-- Pilih Program Studi --</option>
        <option value="Teknik Informatika">Teknik Informatika</option>
        <option value="Sistem Informasi">Sistem Informasi</option>
        <option value="Teknik Elektro">Teknik Elektro</option>
        <option value="Teknik Mesin">Teknik Mesin</option>
        <option value="Teknik Sipil">Teknik Sipil</option>
        <option value="Manajemen Informatika">Manajemen Informatika</option>
    </select>

    <label>Jabatan</label>
    <input type="text" name="jabatan" placeholder="Contoh: Dosen Tetap" required>

    <hr>

    <label>Email</label>
    <input type="email" name="email" required>

    <!-- FOTO OPSIONAL -->
    <label>Foto Dosen <small>(Opsional)</small></label>
    <input type="file" name="foto" accept="image/*">
    <small class="hint">Kosongkan jika tidak ingin upload foto</small>

    <small class="hint">
        Password awal dosen = <b>NIDN</b>
    </small>

    <div class="form-action">
        <button type="submit" name="simpan">
            <i class="fa fa-save"></i> Simpan Data
        </button>
        <a href="dosen.php" class="btn-cancel">Kembali</a>
    </div>

</form>

</div>
</div>
</div>

<footer>
© 2025 Aplikasi Pengumuman Akademik Online | Politeknik Negeri Batam
</footer>

<script src="../assets/js/script3.js"></script>
</body>
</html>

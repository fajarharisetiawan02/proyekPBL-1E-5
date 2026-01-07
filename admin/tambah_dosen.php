<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";

$pesan = "";

if (isset($_POST['simpan'])) {

<<<<<<< HEAD
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
=======
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

>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
    if (mysqli_num_rows($cek) > 0) {
        $pesan = "<div class='alert error'>NIDN sudah terdaftar</div>";
    } else {

<<<<<<< HEAD
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
=======
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
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
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
<<<<<<< HEAD
    Lengkapi data dosen. Akun login dibuat otomatis.
=======
    Silakan lengkapi data dosen. Akun login admin dibuat otomatis.
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
</p>

<?= $pesan; ?>

<<<<<<< HEAD
<form method="POST" enctype="multipart/form-data" class="form-box">
=======
<form method="POST" class="form-box">
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717

    <label>NIDN</label>
    <input type="text" name="nidn" required>

    <label>Nama Lengkap</label>
<<<<<<< HEAD
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
=======
    <input type="text" name="nama_dosen" required>

    <hr>

    <label>Fakultas</label>
    <input type="text" name="fakultas" required>

    <label>Program Studi</label>
    <input type="text" name="prodi" required>

    <label>No HP</label>
    <input type="text" name="no_hp">
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717

    <hr>

    <label>Email</label>
    <input type="email" name="email" required>

<<<<<<< HEAD
    <!-- FOTO OPSIONAL -->
    <label>Foto Dosen <small>(Opsional)</small></label>
    <input type="file" name="foto" accept="image/*">
    <small class="hint">Kosongkan jika tidak ingin upload foto</small>

    <small class="hint">
        Password awal dosen = <b>NIDN</b>
=======
    <small class="hint">
        Username & Password awal dosen = <b>NIDN</b>
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
    </small>

    <div class="form-action">
        <button type="submit" name="simpan">
            <i class="fa fa-save"></i> Simpan Data
        </button>
<<<<<<< HEAD
        <a href="dosen.php" class="btn-cancel">Kembali</a>
=======
        <a href="data_dosen.php" class="btn-cancel">Kembali</a>
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
    </div>

</form>

</div>
</div>
</div>

<footer>
© 2025 Aplikasi Pengumuman Akademik Online | Politeknik Negeri Batam
</footer>

<<<<<<< HEAD
<script src="../assets/js/script3.js"></script>
=======
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
</body>
</html>

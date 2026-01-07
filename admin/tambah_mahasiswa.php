<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";

$pesan = "";

if (isset($_POST['simpan'])) {

    $nim      = mysqli_real_escape_string($koneksi, $_POST['nim']);
    $nama     = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $prodi    = mysqli_real_escape_string($koneksi, $_POST['prodi']);
    $jurusan  = mysqli_real_escape_string($koneksi, $_POST['jurusan']);
    $kelas    = mysqli_real_escape_string($koneksi, $_POST['kelas']);
    $shift    = mysqli_real_escape_string($koneksi, $_POST['shift']);
    $semester = (int) $_POST['semester'];
    $email    = mysqli_real_escape_string($koneksi, $_POST['email']);

    /* FOTO OPSIONAL */
    $namaFoto = null;
    if (!empty($_FILES['foto']['name'])) {
        $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        $namaFoto = "mhs_" . time() . "." . $ext;
        $folder = "../uploads/foto_mahasiswa/";

        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }
        move_uploaded_file($_FILES['foto']['tmp_name'], $folder . $namaFoto);
    }

    // CEK NIM
    $cek = mysqli_query($koneksi, "SELECT id_mahasiswa FROM mahasiswa WHERE nim='$nim'");
    if (mysqli_num_rows($cek) > 0) {
        $pesan = "<div class='alert error'>NIM sudah terdaftar</div>";
    } else {

        // SIMPAN MAHASISWA
        mysqli_query($koneksi, "
            INSERT INTO mahasiswa 
            (nim, nama, prodi, jurusan, kelas, shift, semester, email, foto)
            VALUES 
            ('$nim','$nama','$prodi','$jurusan','$kelas','$shift','$semester','$email','$namaFoto')
        ");

        $id_mahasiswa = mysqli_insert_id($koneksi);

        // PASSWORD AWAL = NIM
        $password = password_hash($nim, PASSWORD_DEFAULT);

        // SIMPAN LOGIN
        mysqli_query($koneksi, "
            INSERT INTO login 
            (username, password, nama, email, role, id_mahasiswa)
            VALUES 
            ('$nim','$password','$nama','$email','mahasiswa','$id_mahasiswa')
        ");

        header("Location: mahasiswa.php?success=1");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Mahasiswa</title>
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

<h2>Tambah Data Mahasiswa</h2>
<p class="page-desc">
    Silakan lengkapi data mahasiswa. Akun login dibuat otomatis.
</p>

<?= $pesan; ?>

<form method="POST" class="form-box" enctype="multipart/form-data">

    <label>NIM</label>
    <input type="text" name="nim" required>

    <label>Nama Lengkap</label>
    <input type="text" name="nama" required>

    <hr>

    <label>Program Studi</label>
    <select name="prodi" required>
        <option value="">-- Pilih Program Studi --</option>
        <option value="Teknik Informatika">Teknik Informatika</option>
        <option value="Sistem Informasi">Sistem Informasi</option>
        <option value="Teknik Elektro">Teknik Elektro</option>
        <option value="Teknik Mesin">Teknik Mesin</option>
    </select>

    <label>Jurusan</label>
    <select name="jurusan" required>
        <option value="">-- Pilih Jurusan --</option>
        <option value="Teknik Informatika">Teknik Informatika</option>
        <option value="Teknik Elektro">Teknik Elektro</option>
        <option value="Teknik Mesin">Teknik Mesin</option>
    </select>

    <label>Kelas</label>
    <select name="kelas" required>
        <option value="">-- Pilih Kelas --</option>
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
        <option value="D">D</option>
    </select>

    <label>Shift</label>
    <select name="shift" required>
        <option value="">-- Pilih Shift --</option>
        <option value="Pagi">Pagi</option>
        <option value="Malam">Malam</option>
    </select>

    <label>Semester</label>
    <select name="semester" required>
        <option value="">-- Pilih Semester --</option>
        <?php for ($i=1; $i<=8; $i++): ?>
            <option value="<?= $i ?>"><?= $i ?></option>
        <?php endfor; ?>
    </select>

    <hr>

    <label>Email</label>
    <input type="email" name="email" required>

    <label>Foto Mahasiswa (Opsional)</label>
    <input type="file" name="foto" accept="image/*">
    <small class="hint">Kosongkan jika tidak ingin upload foto</small>

    <small class="hint">
        Password awal mahasiswa = <b>NIM</b>
    </small>

    <div class="form-action">
        <button type="submit" name="simpan">
            <i class="fa fa-save"></i> Simpan Data
        </button>
        <a href="mahasiswa.php" class="btn-cancel">Kembali</a>
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

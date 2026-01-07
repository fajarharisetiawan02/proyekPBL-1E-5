<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";

/* ======================
   CEK PARAMETER ID
====================== */
$id_admin = $_GET['id'] ?? null;
if (!$id_admin) {
    die("ID dosen tidak ditemukan");
}

/* ======================
   AMBIL DATA DOSEN
====================== */
$q = mysqli_query($koneksi, "
    SELECT id_admin, nidn, nama, prodi, jabatan, email, foto
    FROM admin
    WHERE id_admin = '$id_admin'
");

$dosen = mysqli_fetch_assoc($q);
if (!$dosen) {
    die("Data dosen tidak ditemukan");
}

$pesan = "";

/* ======================
   SIMPAN PERUBAHAN
====================== */
if (isset($_POST['simpan'])) {

    $nidn    = mysqli_real_escape_string($koneksi, $_POST['nidn']);
    $nama    = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $prodi   = mysqli_real_escape_string($koneksi, $_POST['prodi']);
    $jabatan = mysqli_real_escape_string($koneksi, $_POST['jabatan']);
    $email   = mysqli_real_escape_string($koneksi, $_POST['email']);

    /* FOTO OPSIONAL */
    if (!empty($_FILES['foto']['name'])) {

        $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        $namaFoto = "dosen_" . time() . "." . $ext;
        $folder = "../uploads/foto_admin/";

        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        move_uploaded_file($_FILES['foto']['tmp_name'], $folder . $namaFoto);

        mysqli_query($koneksi, "
            UPDATE admin SET
                nidn    = '$nidn',
                nama    = '$nama',
                prodi   = '$prodi',
                jabatan = '$jabatan',
                email   = '$email',
                foto    = '$namaFoto'
            WHERE id_admin = '$id_admin'
        ");

    } else {

        mysqli_query($koneksi, "
            UPDATE admin SET
                nidn    = '$nidn',
                nama    = '$nama',
                prodi   = '$prodi',
                jabatan = '$jabatan',
                email   = '$email'
            WHERE id_admin = '$id_admin'
        ");
    }

    /* SINKRON LOGIN */
    mysqli_query($koneksi, "
        UPDATE login SET
            username = '$nidn',
            nama     = '$nama',
            email    = '$email'
        WHERE id_admin = '$id_admin'
    ");

    header("Location: dosen.php?update=1");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Data Dosen</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="icon" href="../assets/img/Logo Politeknik.png">
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

<h2>Edit Data Dosen</h2>
<p class="page-desc">Perbarui data dosen</p>

<form method="POST" enctype="multipart/form-data" class="form-box">

    <label>NIDN</label>
    <input type="text" name="nidn" value="<?= htmlspecialchars($dosen['nidn']) ?>" required>

    <label>Nama Lengkap</label>
    <input type="text" name="nama" value="<?= htmlspecialchars($dosen['nama']) ?>" required>

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
    <input type="text" name="jabatan" value="<?= htmlspecialchars($dosen['jabatan']) ?>" required>

    <hr>

    <label>Email</label>
    <input type="email" name="email" value="<?= htmlspecialchars($dosen['email']) ?>" required>

    <label>Foto Dosen (Opsional)</label>
    <input type="file" name="foto" accept="image/*">
    <small class="hint">Kosongkan jika tidak ingin mengganti foto</small>

    <div class="form-action">
        <button type="submit" name="simpan">
            <i class="fa fa-save"></i> Simpan Perubahan
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

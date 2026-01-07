<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";

/* ======================
   CEK SESSION LOGIN
====================== */
$id_login = $_SESSION['id_login'] ?? null;
if (!$id_login) {
    die("Session login tidak ditemukan");
}

/* ======================
   AMBIL DATA DOSEN / ADMIN
====================== */
$q = mysqli_query($koneksi, "
    SELECT 
        a.id_admin,
        a.nidn,
        a.nama,
        a.prodi,
        a.jabatan,
        a.email,
        a.foto
    FROM login l
    JOIN admin a ON l.id_admin = a.id_admin
    WHERE l.id_login = '$id_login'
");

$dosen = mysqli_fetch_assoc($q);
if (!$dosen) {
    die("Data dosen tidak ditemukan");
}

/* ======================
   AMANKAN DATA NULL
====================== */
$nama   = $dosen['nama'] ?? '';
$email  = $dosen['email'] ?? '';
$fotoDB = $dosen['foto'] ?? '';

$foto = $fotoDB
    ? "../uploads/foto_admin/" . $fotoDB
    : null;

$inisial = strtoupper(substr($nama, 0, 1));
$pesan = "";

/* ======================
   SIMPAN PERUBAHAN
====================== */
if (isset($_POST['simpan'])) {

    $nama  = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);

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
                nama  = '$nama',
                email = '$email',
                foto  = '$namaFoto'
            WHERE id_admin = '{$dosen['id_admin']}'
        ");

        $foto = $folder . $namaFoto;

    } else {

        mysqli_query($koneksi, "
            UPDATE admin SET
                nama  = '$nama',
                email = '$email'
            WHERE id_admin = '{$dosen['id_admin']}'
        ");
    }

    $pesan = "<div class='alert success'>Profil dosen berhasil diperbarui</div>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Profil Dosen</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="icon" type="image/png" href="../assets/img/Logo Politeknik.png">
<link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
<link rel="stylesheet" href="../assets/css/profil-admin.css">
<link rel="stylesheet" href="../assets/css/sidebar.css">
<link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
</head>

<body>
<div class="main-wrapper">

<?php include "../components_admin/sidebar.php"; ?>

<div class="main-content">
<?php include "../components_admin/topbar.php"; ?>

<div class="edit-profile-card">

<h2><i class="fa-solid fa-user-pen"></i> Edit Profil Dosen</h2>
<?= $pesan ?>

<div class="photo-preview">
<?php if ($foto): ?>
    <img src="<?= htmlspecialchars($foto) ?>" id="previewImg">
<?php else: ?>
    <div class="avatar-preview" id="previewImg"><?= $inisial ?></div>
<?php endif; ?>
</div>

<form method="POST" enctype="multipart/form-data">

<label>Nama Lengkap</label>
<input type="text" name="nama"
       value="<?= htmlspecialchars($nama) ?>" required>

<label>NIDN</label>
<input type="text"
       value="<?= htmlspecialchars($dosen['nidn']) ?>" readonly>

<label>Program Studi</label>
<input type="text"
       value="<?= htmlspecialchars($dosen['prodi']) ?>" readonly>

<label>Jabatan</label>
<input type="text"
       value="<?= htmlspecialchars($dosen['jabatan']) ?>" readonly>

<label>Email</label>
<input type="email" name="email"
       value="<?= htmlspecialchars($email) ?>" required>

<label>Foto Profil</label>
<input type="file" name="foto" accept="image/*" onchange="previewFoto(this)">
<small>* Kosongkan jika tidak ingin mengganti foto</small>

<div class="form-action">
<button type="submit" name="simpan" class="btn-primary">
<i class="fa-solid fa-save"></i> Simpan
</button>
<a href="profil_dosen.php" class="btn-secondary">Kembali</a>
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

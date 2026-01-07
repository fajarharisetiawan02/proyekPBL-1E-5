<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";

/* ===============================
   CEK ID
================================ */
if (!isset($_GET['id'])) {
    header("Location: pengumuman.php");
    exit;
}

$id = mysqli_real_escape_string($koneksi, $_GET['id']);

/* ===============================
   AMBIL DATA PENGUMUMAN
================================ */
$q = mysqli_query($koneksi, "
    SELECT * FROM pengumuman 
    WHERE id_pengumuman='$id'
");
$data = mysqli_fetch_assoc($q);

if (!$data) {
    die("Data pengumuman tidak ditemukan");
}

/* ===============================
   UPDATE DATA
================================ */
if (isset($_POST['update'])) {

    $judul    = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);
    $isi      = mysqli_real_escape_string($koneksi, $_POST['isi']);

    mysqli_query($koneksi, "
        UPDATE pengumuman SET
            judul='$judul',
            kategori='$kategori',
            isi='$isi'
        WHERE id_pengumuman='$id'
    ");

    header("Location: pengumuman.php?update=success");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Pengumuman</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="icon" href="../assets/img/Logo Politeknik.png">
<link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
<link rel="stylesheet" href="../assets/css/pengumuman.css">
<link rel="stylesheet" href="../assets/css/sidebar.css">
<link rel="stylesheet" href="../assets/css/notifikasi+profil.css">

</head>

<body>

<div class="main-wrapper">

<?php include "../components_admin/sidebar.php"; ?>
<?php include "../components_admin/topbar.php"; ?>

<div class="main-content">
<div class="content-container">

<h2>Edit Pengumuman</h2>
<p class="page-desc">
Perbarui informasi pengumuman yang akan ditampilkan kepada mahasiswa.
</p>

<form method="POST" action="" class="form-box">

    <label>Judul Pengumuman</label>
    <input type="text" name="judul"
           value="<?= htmlspecialchars($data['judul']) ?>" required>

    <small class="hint">
        Gunakan judul singkat, jelas, dan mudah dipahami mahasiswa.
    </small>

    <label>Kategori</label>
    <select name="kategori" required>
        <option value="">-- Pilih Kategori --</option>
        <option value="Akademik" <?= $data['kategori']=='Akademik'?'selected':'' ?>>Akademik</option>
        <option value="Perkuliahan" <?= $data['kategori']=='Perkuliahan'?'selected':'' ?>>Perkuliahan</option>
        <option value="Beasiswa" <?= $data['kategori']=='Beasiswa'?'selected':'' ?>>Beasiswa</option>
        <option value="Umum" <?= $data['kategori']=='Umum'?'selected':'' ?>>Umum</option>
    </select>

    <small class="hint">
        Pilih kategori sesuai jenis informasi yang disampaikan.
    </small>

    <label>Isi Pengumuman</label>
    <textarea name="isi" rows="7" required><?= htmlspecialchars($data['isi']) ?></textarea>

    <small class="hint">
        Perubahan akan langsung terlihat oleh seluruh mahasiswa.
    </small>

    <div class="form-action">
       <button type="submit" name="simpan" class="btn-primary">
            <i class="fa-solid fa-save"></i> Simpan Perubahan
        </button>

        <a href="pengumuman.php" class="btn-cancel">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
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

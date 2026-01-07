<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";

/* ===============================
   CEK ID
================================ */
if (!isset($_GET['id'])) {
    header("Location: mahasiswa.php");
    exit;
}

$id = mysqli_real_escape_string($koneksi, $_GET['id']);

/* ===============================
   AMBIL DATA MAHASISWA
================================ */
$q = mysqli_query($koneksi, "
    SELECT * FROM mahasiswa 
    WHERE id_mahasiswa='$id'
");
$mhs = mysqli_fetch_assoc($q);

if (!$mhs) {
    die("Data mahasiswa tidak ditemukan");
}

/* ===============================
   UPDATE DATA
================================ */
if (isset($_POST['update'])) {

    $nim      = mysqli_real_escape_string($koneksi, $_POST['nim']);
    $nama     = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email    = mysqli_real_escape_string($koneksi, $_POST['email']);
    $prodi    = mysqli_real_escape_string($koneksi, $_POST['prodi']);
    $jurusan  = mysqli_real_escape_string($koneksi, $_POST['jurusan']);
    $kelas    = mysqli_real_escape_string($koneksi, $_POST['kelas']);
    $shift    = mysqli_real_escape_string($koneksi, $_POST['shift']);
    $semester = (int) $_POST['semester'];

    $foto = $mhs['foto'];

    /* FOTO OPSIONAL */
    if (!empty($_FILES['foto']['name'])) {
        $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        $foto = "mhs_" . time() . "." . $ext;
        $folder = "../uploads/foto_mahasiswa/";

        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        move_uploaded_file($_FILES['foto']['tmp_name'], $folder . $foto);
    }

    mysqli_query($koneksi, "
        UPDATE mahasiswa SET
            nim='$nim',
            nama='$nama',
            email='$email',
            prodi='$prodi',
            jurusan='$jurusan',
            kelas='$kelas',
            shift='$shift',
            semester='$semester',
            foto='$foto'
        WHERE id_mahasiswa='$id'
    ");

    header("Location: mahasiswa.php?update=success");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Mahasiswa</title>
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

<h2>Edit Data Mahasiswa</h2>
<p class="page-desc">Perbarui data mahasiswa.</p>

<form method="POST" enctype="multipart/form-data" class="form-box">

<label>NIM</label>
<input type="text" name="nim" value="<?= htmlspecialchars($mhs['nim']) ?>" required>

<label>Nama Lengkap</label>
<input type="text" name="nama" value="<?= htmlspecialchars($mhs['nama']) ?>" required>

<label>Program Studi</label>
<select name="prodi" required>
    <option value="">-- Pilih Program Studi --</option>
    <option value="D3 Teknik Informatika" <?= $mhs['prodi']=='D3 Teknik Informatika'?'selected':'' ?>>
        D3 Teknik Informatika
    </option>
    <option value="D4 RPL" <?= $mhs['prodi']=='D4 RPL'?'selected':'' ?>>
        D4 Rekayasa Perangkat Lunak
    </option>
</select>

<label>Jurusan</label>
<select name="jurusan" required>
    <option value="">-- Pilih Jurusan --</option>
    <option value="Teknik Informatika" <?= $mhs['jurusan']=='Teknik Informatika'?'selected':'' ?>>
        Teknik Informatika
    </option>
</select>

<label>Kelas</label>
<select name="kelas" required>
    <?php foreach (['A','B','C','D','E'] as $k): ?>
        <option value="<?= $k ?>" <?= $mhs['kelas']==$k?'selected':'' ?>>
            <?= $k ?>
        </option>
    <?php endforeach; ?>
</select>

<label>Shift</label>
<select name="shift" required>
    <option value="Pagi" <?= $mhs['shift']=='Pagi'?'selected':'' ?>>Pagi</option>
    <option value="Malam" <?= $mhs['shift']=='Malam'?'selected':'' ?>>Malam</option>
</select>

<label>Semester</label>
<select name="semester" required>
    <?php for ($i=1;$i<=8;$i++): ?>
        <option value="<?= $i ?>" <?= $mhs['semester']==$i?'selected':'' ?>>
            Semester <?= $i ?>
        </option>
    <?php endfor; ?>
</select>

<label>Email</label>
<input type="email" name="email" value="<?= htmlspecialchars($mhs['email']) ?>" required>

<label>Foto Profil (Opsional)</label>
<input type="file" name="foto" accept="image/*">
<small>* Kosongkan jika tidak ingin mengganti foto</small>

<div class="form-action">
    <button type="submit" name="update">
        <i class="fa fa-save"></i> Simpan Perubahan
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

</body>
</html>

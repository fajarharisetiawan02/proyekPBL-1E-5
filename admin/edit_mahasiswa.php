<?php
require_once "../config/auth_admin.php";
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
require_once "../config/koneksi.php";

/* ===============================
   CEK ID
================================ */
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
=======
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";

// ===============================
// CEK ID
// ===============================
>>>>>>> 9a567987dd90af1392f8d15dfcbd79423ecb4815
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
if (!isset($_GET['id'])) {
    header("Location: mahasiswa.php");
    exit;
}

$id = mysqli_real_escape_string($koneksi, $_GET['id']);
<<<<<<< HEAD

/* ===============================
   AMBIL DATA MAHASISWA
================================ */
$q = mysqli_query($koneksi, "
    SELECT * FROM mahasiswa 
    WHERE id_mahasiswa='$id'
");
$mhs = mysqli_fetch_assoc($q);

if (!$mhs) {
=======

<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
/* ===============================
   AMBIL DATA MAHASISWA
================================ */
$query = mysqli_query($koneksi, "
    SELECT *
    FROM mahasiswa
    WHERE id_mahasiswa = '$id'
");
$data = mysqli_fetch_assoc($query);

if (!$data) {
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
    die("Data mahasiswa tidak ditemukan");
}

/* ===============================
<<<<<<< HEAD
   UPDATE DATA
=======
   NORMALISASI DATA LAMA
================================ */
$kelas_lama = strtoupper($data['kelas']);
$kelas_fix  = preg_replace('/[^A-E]/', '', $kelas_lama); // ambil A–E
$shift_fix  = stripos($kelas_lama, 'malam') !== false ? 'Malam' : 'Pagi';

/* ===============================
   PROSES UPDATE
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
================================ */
if (isset($_POST['update'])) {

    $nim      = mysqli_real_escape_string($koneksi, $_POST['nim']);
    $nama     = mysqli_real_escape_string($koneksi, $_POST['nama']);
<<<<<<< HEAD
    $email    = mysqli_real_escape_string($koneksi, $_POST['email']);
=======
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
    $prodi    = mysqli_real_escape_string($koneksi, $_POST['prodi']);
    $jurusan  = mysqli_real_escape_string($koneksi, $_POST['jurusan']);
    $kelas    = mysqli_real_escape_string($koneksi, $_POST['kelas']);
    $shift    = mysqli_real_escape_string($koneksi, $_POST['shift']);
    $semester = (int) $_POST['semester'];
<<<<<<< HEAD

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
=======
    $email    = mysqli_real_escape_string($koneksi, $_POST['email']);
<<<<<<< HEAD
=======
=======
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
>>>>>>> 9a567987dd90af1392f8d15dfcbd79423ecb4815
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717

    mysqli_query($koneksi, "
        UPDATE mahasiswa SET
            nim='$nim',
            nama='$nama',
<<<<<<< HEAD
            email='$email',
            prodi='$prodi',
            jurusan='$jurusan',
            kelas='$kelas',
            shift='$shift',
            semester='$semester',
            foto='$foto'
=======
            prodi='$prodi',
            jurusan='$jurusan',
            kelas='$kelas',
<<<<<<< HEAD
            shift='$shift',
            semester='$semester',
=======
<<<<<<< HEAD
            shift='$shift',
            semester='$semester',
=======
>>>>>>> 9a567987dd90af1392f8d15dfcbd79423ecb4815
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
            email='$email'
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
        WHERE id_mahasiswa='$id'
    ");

    header("Location: mahasiswa.php?update=success");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<<<<<<< HEAD
<meta charset="UTF-8">
<title>Edit Mahasiswa</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="icon" href="../assets/img/Logo Politeknik.png">
<link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
<link rel="stylesheet" href="../assets/css/mahasiswa.css">
<link rel="stylesheet" href="../assets/css/sidebar.css">
<link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
=======
    <meta charset="UTF-8">
    <title>Edit Mahasiswa</title>
<<<<<<< HEAD
     <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/png" href="../assets/img/Logo Politeknik.png">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/mahasiswa.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
=======

        <link rel="stylesheet" href="../assets/css/mahasiswa.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e

    <style>
        .form-box {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            max-width: 700px;
            box-shadow: 0 10px 25px rgba(0,0,0,.05);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 9px 12px;
            border-radius: 6px;
            border: 1px solid #ddd;
            font-size: 14px;
        }

        .btn-group {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .btn-save {
            background: #2563eb;
            color: #fff;
            padding: 9px 16px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
        }

        .btn-back {
            background: #6b7280;
            color: #fff;
            padding: 9px 16px;
            border-radius: 6px;
            text-decoration: none;
        }
    </style>
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
</head>

<body>
<div class="main-wrapper">

<<<<<<< HEAD
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

=======
<div class="main-wrapper">

    <?php include "../components_admin/sidebar.php"; ?>
    <?php include "../components_admin/topbar.php"; ?>

    <div class="main-content">
        <div class="content-container">

            <h2>Edit Data Mahasiswa</h2>
            <p class="page-desc">Perbarui data mahasiswa yang terdaftar.</p>

            <div class="form-box">
                <form method="POST">
<div class="form-group">
<label>NIM</label>
<input type="text" name="nim" value="<?= $data['nim']; ?>" required>
</div>

<div class="form-group">
<label>Nama</label>
<input type="text" name="nama" value="<?= $data['nama']; ?>" required>
</div>

<div class="form-group">
<label>Program Studi</label>
<select name="prodi" required>
<option <?= $data['prodi']=='D3 Teknik Informatika'?'selected':'' ?>>D3 Teknik Informatika</option>
<option <?= $data['prodi']=='Teknik Multimedia'?'selected':'' ?>>Teknik Multimedia</option>
</select>
</div>

<div class="form-group">
<label>Jurusan</label>
<select name="jurusan" required>
<option <?= $data['jurusan']=='Teknik Informatika'?'selected':'' ?>>Teknik Informatika</option>
</select>
</div>

<div class="form-group">
<label>Kelas</label>
<select name="kelas" required>
<?php foreach(['A','B','C','D','E'] as $k): ?>
<option value="<?= $k ?>" <?= $kelas_fix==$k?'selected':'' ?>><?= $k ?></option>
<?php endforeach; ?>
</select>
</div>

<div class="form-group">
<label>Shift</label>
<select name="shift" required>
<option value="Pagi" <?= $shift_fix=='Pagi'?'selected':'' ?>>Pagi</option>
<option value="Malam" <?= $shift_fix=='Malam'?'selected':'' ?>>Malam</option>
</select>
</div>

<div class="form-group">
<label>Semester</label>
<select name="semester" required>
<?php for($i=1;$i<=8;$i++): ?>
<option value="<?= $i ?>" <?= $data['semester']==$i?'selected':'' ?>>Semester <?= $i ?></option>
<?php endfor; ?>
</select>
</div>

<div class="form-group">
<label>Email</label>
<input type="email" name="email" value="<?= $data['email']; ?>" required>
</div>

                    <div class="btn-group">
                        <button type="submit" name="update" class="btn-save">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                        <a href="mahasiswa.php" class="btn-back">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

    <footer>
        © 2025 Aplikasi Pengumuman Akademik Online | Politeknik Negeri Batam
    </footer>
    <script src="../assets/js/script3.js"></script>
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
</body>

</html>

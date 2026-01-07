<?php
require_once "../config/auth_mahasiswa.php";
require_once "../config/koneksi.php";

$id_login = $_SESSION['id_login'];
$pesan = "";

$q = mysqli_query($koneksi, "
    SELECT 
        m.id_mahasiswa,
        m.nim,
        m.nama,
        m.prodi,
        m.jurusan,
        m.kelas,
        m.email,
        m.no_hp,
        m.foto
    FROM login l
    JOIN mahasiswa m ON l.id_mahasiswa = m.id_mahasiswa
    WHERE l.id_login = '$id_login'
");

$mhs = mysqli_fetch_assoc($q);
if (!$mhs) {
    die("Data mahasiswa tidak ditemukan");
}

<<<<<<< HEAD
/* ===============================
   KELAS + SHIFT (AKURAT)
=============================== */
$kelas_huruf = strtoupper(trim($mhs['kelas'])); // E
$shift = strtoupper($_SESSION['shift']);        // MALAM / PAGI
$kelas_tampil = $kelas_huruf . " (" . $shift . ")";

/* ===============================
   UPDATE PROFIL
=============================== */
=======
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
if (isset($_POST['simpan'])) {

    $nama  = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $no_hp = mysqli_real_escape_string($koneksi, $_POST['no_hp']);

    if (!empty($_FILES['foto']['name'])) {
        $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        $namaFoto = "mhs_" . time() . "." . $ext;
        $folder = "../uploads/foto_mahasiswa/";

        if (!is_dir($folder)) mkdir($folder, 0777, true);
        move_uploaded_file($_FILES['foto']['tmp_name'], $folder . $namaFoto);

        mysqli_query($koneksi, "
            UPDATE mahasiswa SET
                nama='$nama',
                email='$email',
                no_hp='$no_hp',
                foto='$namaFoto'
            WHERE id_mahasiswa='{$mhs['id_mahasiswa']}'
        ");
    } else {
        mysqli_query($koneksi, "
            UPDATE mahasiswa SET
                nama='$nama',
                email='$email',
                no_hp='$no_hp'
            WHERE id_mahasiswa='{$mhs['id_mahasiswa']}'
        ");
    }

    $pesan = "<div class='alert success'>Profil berhasil diperbarui</div>";
}

$foto = !empty($mhs['foto']) ? "../uploads/foto_mahasiswa/".$mhs['foto'] : null;
$inisial = strtoupper(substr($mhs['nama'],0,1));
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Profil Mahasiswa</title>
<<<<<<< HEAD

<link rel="stylesheet" href="../assets/css/profil-mahasiswa.css">
<link rel="stylesheet" href="../assets/css/sidebar.css">
<link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
=======
<<<<<<< HEAD
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="icon" type="image/png" href="../assets/img/Logo Politeknik.png">
<link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
<link rel="stylesheet" href="../assets/css/sidebar.css">
<link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
<link rel="stylesheet" href="../assets/css/profil-mahasiswa.css">
=======

<link rel="stylesheet" href="../assets/css/sidebar.css">
<link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
<link rel="stylesheet" href="../assets/css/profil-mahasiswa.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
</head>

<body>
<div class="main-wrapper">
<<<<<<< HEAD

=======
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
<?php include "../components_mahasiswa/sidebar.php"; ?>

<div class="main-content">
<?php include "../components_mahasiswa/topbar.php"; ?>

<div class="edit-profile-card">

<h2><i class="fa-solid fa-user-pen"></i> Edit Profil Mahasiswa</h2>
<?= $pesan ?>

<div class="photo-preview">
<?php if ($foto): ?>
    <img src="<?= $foto ?>" id="previewImg">
<?php else: ?>
    <div class="avatar-preview" id="previewImg"><?= $inisial ?></div>
<?php endif; ?>
</div>

<form method="POST" enctype="multipart/form-data">

<label>Nama Lengkap</label>
<input type="text" name="nama" value="<?= htmlspecialchars($mhs['nama']) ?>" required>

<label>NIM</label>
<input type="text" value="<?= $mhs['nim'] ?>" readonly>

<label>Program Studi</label>
<input type="text" value="<?= $mhs['prodi'] ?>" readonly>

<label>Jurusan</label>
<input type="text" value="<?= $mhs['jurusan'] ?>" readonly>

<label>Kelas</label>
<<<<<<< HEAD
<input type="text" value="<?= $kelas_tampil ?>" readonly>
=======
<input type="text" value="<?= $mhs['kelas'] ?>" readonly>
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717

<label>Email</label>
<input type="email" name="email" value="<?= htmlspecialchars($mhs['email']) ?>" required>

<label>No. HP</label>
<input type="text" name="no_hp"
       value="<?= htmlspecialchars($mhs['no_hp']) ?>"
       oninput="this.value=this.value.replace(/[^0-9]/g,'')">

<label>Foto Profil</label>
<input type="file" name="foto" accept="image/*" onchange="previewFoto(this)">
<small>* Kosongkan jika tidak ingin mengganti foto</small>

<div class="form-action">
<button type="submit" name="simpan" class="btn-primary">
<i class="fa-solid fa-save"></i> Simpan
</button>
<a href="profil_mahasiswa.php" class="btn-secondary">Kembali</a>
</div>

</form>
</div>
</div>
</div>

<<<<<<< HEAD
<footer>
© 2025 Aplikasi Pengumuman Akademik Online | Politeknik Negeri Batam
</footer>

=======
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
<script>
function previewFoto(input){
    const file = input.files[0];
    const preview = document.getElementById('previewImg');
    if(file){
        const reader = new FileReader();
        reader.onload = e => {
            if(preview.tagName === 'IMG'){
                preview.src = e.target.result;
            }
        };
        reader.readAsDataURL(file);
    }
}
</script>
</body>
</html>

<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======

if (isset($_POST['simpan'])) {

    $mata_kuliah        = $_POST['mata_kuliah'];
    $tanggal_perubahan  = $_POST['tanggal_perubahan'];
    $jurusan            = $_POST['jurusan'];
    $prodi              = $_POST['prodi'];
    $kelas              = $_POST['kelas'];
    $shift              = $_POST['shift'];
    $semester           = $_POST['semester'];
    $kelas_asal         = $_POST['kelas_asal'];
    $kelas_baru         = $_POST['kelas_baru'];
    $dosen              = $_POST['dosen'];

    mysqli_query($koneksi, "
        INSERT INTO perubahan_kelas
        (mata_kuliah, tanggal_perubahan, jurusan, prodi, kelas, shift, semester, kelas_asal, kelas_baru, dosen)
        VALUES
        ('$mata_kuliah', '$tanggal_perubahan', '$jurusan', '$prodi', '$kelas', '$shift', '$semester',
         '$kelas_asal', '$kelas_baru', '$dosen')
    ");

    header("Location: perubahan_kelas.php");
    exit;
}
>>>>>>> 9a567987dd90af1392f8d15dfcbd79423ecb4815
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
?>

<!DOCTYPE html>
<html lang="id">
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======

>>>>>>> 9a567987dd90af1392f8d15dfcbd79423ecb4815
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
<head>
    <meta charset="UTF-8">
    <title>Tambah Perubahan Kelas</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">

<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
         <link rel="icon" type="image/png" href="../assets/img/Logo Politeknik.png">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style4.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
<<<<<<< HEAD
=======
=======
<<<<<<< HEAD
    <link rel="stylesheet" href="../assets/css/style4.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
</head>

<body>

<div class="main-wrapper">
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
=======
    <link rel="stylesheet" href="../assets/css/style5.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
</head>

<body>
    <div class="main-wrapper">
>>>>>>> 9a567987dd90af1392f8d15dfcbd79423ecb4815
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717

<?php include "../components_admin/sidebar.php"; ?>
<?php include "../components_admin/topbar.php"; ?>

<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
<div class="main-content">
<div class="content-container">

<!-- HEADER -->
<div class="form-header">
    <h3>Tambah Perubahan Kelas</h3>
    <p>Gunakan form ini untuk mencatat perubahan kelas mahasiswa.</p>
</div>
<<<<<<< HEAD

<!-- FORM -->
<form method="POST" action="proses_tambah_perubahan_kelas.php" class="form-card">

<h4 class="form-section-title">
<i class="fa-solid fa-graduation-cap"></i> Informasi Akademik
</h4>

<div class="form-grid">

<div class="form-group">
<label>Jurusan</label>
<select name="jurusan" required>
<option value="">Pilih Jurusan</option>
<option>Manajemen Bisnis</option>
<option>Teknik Elektro</option>
<option>Teknik Informatika</option>
<option>Teknik Mesin</option>
</select>
</div>

<div class="form-group">
<label>Program Studi</label>
<select name="prodi" required>
<option value="">Pilih Prodi</option>
<option>D3 Akuntansi</option>
<option>D4 Akuntansi Manajerial</option>
<option>D4 Administrasi Bisnis Terapan</option>
<option>D3 Teknik Informatika</option>
<option>D4 Rekayasa Perangkat Lunak</option>
<option>D4 Animasi</option>
<option>D4 Teknologi Permainan</option>
</select>
</div>

<div class="form-group">
<label>Kelas</label>
<select name="kelas" required>
<option value="">Pilih Kelas</option>
<option>A</option>
<option>B</option>
<option>C</option>
<option>D</option>
<option>E</option>
</select>
</div>

<div class="form-group">
<label>Shift</label>
<select name="shift" required>
<option value="">Pilih Shift</option>
<option>Pagi</option>
<option>Malam</option>
</select>
</div>

<div class="form-group">
<label>Semester</label>
<select name="semester" required>
<option value="">Pilih Semester</option>
<?php for ($i=1; $i<=8; $i++): ?>
<option value="<?= $i ?>"><?= $i ?></option>
<?php endfor; ?>
</select>
</div>

</div>

=======
<<<<<<< HEAD

<!-- FORM -->
<form method="POST" action="proses_tambah_perubahan_kelas.php" class="form-card">

<h4 class="form-section-title">
<i class="fa-solid fa-graduation-cap"></i> Informasi Akademik
</h4>

<div class="form-grid">

<div class="form-group">
<label>Jurusan</label>
<select name="jurusan" required>
<option value="">Pilih Jurusan</option>
<option>Manajemen Bisnis</option>
<option>Teknik Elektro</option>
<option>Teknik Informatika</option>
<option>Teknik Mesin</option>
</select>
</div>

<div class="form-group">
<label>Program Studi</label>
<select name="prodi" required>
<option value="">Pilih Prodi</option>
<option>D3 Akuntansi</option>
<option>D4 Akuntansi Manajerial</option>
<option>D4 Administrasi Bisnis Terapan</option>
<option>D3 Teknik Informatika</option>
<option>D4 Rekayasa Perangkat Lunak</option>
<option>D4 Animasi</option>
<option>D4 Teknologi Permainan</option>
</select>
</div>

<div class="form-group">
<label>Kelas</label>
<select name="kelas" required>
<option value="">Pilih Kelas</option>
<option>A</option>
<option>B</option>
<option>C</option>
<option>D</option>
<option>E</option>
</select>
</div>

<div class="form-group">
<label>Shift</label>
<select name="shift" required>
<option value="">Pilih Shift</option>
<option>Pagi</option>
<option>Malam</option>
</select>
</div>

<div class="form-group">
<label>Semester</label>
<select name="semester" required>
<option value="">Pilih Semester</option>
<?php for ($i=1; $i<=8; $i++): ?>
<option value="<?= $i ?>"><?= $i ?></option>
<?php endfor; ?>
</select>
</div>

</div>

=======

<!-- FORM -->
<form method="POST" action="proses_tambah_perubahan_kelas.php" class="form-card">

<h4 class="form-section-title">
<i class="fa-solid fa-graduation-cap"></i> Informasi Akademik
</h4>

<div class="form-grid">

<div class="form-group">
<label>Jurusan</label>
<select name="jurusan" required>
<option value="">Pilih Jurusan</option>
<option>Manajemen Bisnis</option>
<option>Teknik Elektro</option>
<option>Teknik Informatika</option>
<option>Teknik Mesin</option>
</select>
</div>

<div class="form-group">
<label>Program Studi</label>
<select name="prodi" required>
<option value="">Pilih Prodi</option>
<option>D3 Akuntansi</option>
<option>D4 Akuntansi Manajerial</option>
<option>D4 Administrasi Bisnis Terapan</option>
<option>D3 Teknik Informatika</option>
<option>D4 Rekayasa Perangkat Lunak</option>
<option>D4 Animasi</option>
<option>D4 Teknologi Permainan</option>
</select>
</div>

<div class="form-group">
<label>Kelas</label>
<select name="kelas" required>
<option value="">Pilih Kelas</option>
<option>A</option>
<option>B</option>
<option>C</option>
<option>D</option>
<option>E</option>
</select>
</div>

<div class="form-group">
<label>Shift</label>
<select name="shift" required>
<option value="">Pilih Shift</option>
<option>Pagi</option>
<option>Malam</option>
</select>
</div>

<div class="form-group">
<label>Semester</label>
<select name="semester" required>
<option value="">Pilih Semester</option>
<?php for ($i=1; $i<=8; $i++): ?>
<option value="<?= $i ?>"><?= $i ?></option>
<?php endfor; ?>
</select>
</div>
=======
        <div class="main-content">
            <div class="content-container">

                <div class="form-header">
                    <h3>Tambah Perubahan Kelas</h3>
                    <p>
                        Gunakan form ini untuk mencatat perubahan kelas yang telah ditetapkan.
                    </p>
                </div>


                <form method="POST" class="form-card">

                    <h4 class="form-section-title">
                        <i class="fa-solid fa-graduation-cap"></i> Informasi Akademik
                    </h4>

                    <div class="form-grid">

                        <div class="form-group">
                            <label>Jurusan</label>
                            <select name="jurusan" required>
                                <option value="">Pilih Jurusan</option>
                                <option>Manajemen Bisnis</option>
                                <option>Teknik Elektro</option>
                                <option>Teknik Informatika</option>
                                <option>Teknik Mesin</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Program Studi</label>
                            <select name="prodi" required>
                                <option value="">Pilih Prodi</option>
                                <option>D3 Akuntansi</option>
                                <option>D4 Akuntansi Manajerial</option>
                                <option>D4 Administrasi Bisnis Terapan</option>
                                <option>D3 Teknik Informatika</option>
                                <option>D4 Rekayasa Perangkat Lunak</option>
                                <option>D4 Animasi</option>
                                <option>D4 Teknologi Permainan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Kelas</label>
                            <select name="kelas" required>
                                <option value="">Pilih Kelas</option>
                                <option>A</option>
                                <option>B</option>
                                <option>C</option>
                                <option>D</option>
                                <option>E</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Shift</label>
                            <select name="shift" required>
                                <option value="">Pilih Shift</option>
                                <option>Pagi</option>
                                <option>Malam</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Semester</label>
                            <select name="semester" required>
                                <option value="">Pilih Semester</option>
                                <?php for($i=1;$i<=8;$i++): ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>

                    </div>

                    <h4 class="form-section-title">
                        <i class="fa-solid fa-arrows-left-right"></i> Informasi Perubahan Kelas
                    </h4>

                    <div class="form-grid">

                        <div class="form-group full">
                            <label>Mata Kuliah</label>
                            <input type="text" name="mata_kuliah" placeholder="Contoh: Dasar Pemrograman" required>
                        </div>

                        <div class="form-group">
                            <label>Tanggal Perubahan</label>
                            <input type="date" name="tanggal_perubahan" required>
                        </div>

                        <div class="form-group">
                            <label>Dosen</label>
                            <input type="text" name="dosen" placeholder="Nama Dosen" required>
                        </div>

                        <div class="form-group">
                            <label>Kelas Asal</label>
                            <input type="text" name="kelas_asal" placeholder="Contoh: A Pagi" required>
                        </div>

                        <div class="form-group">
                            <label>Kelas Baru</label>
                            <input type="text" name="kelas_baru" placeholder="Contoh: E Malam" required>
                        </div>

                    </div>

                    <div class="form-action">
                        <button type="submit" name="simpan" class="btn-primary">
                            <i class="fa-solid fa-save"></i> Simpan
                        </button>
                        <a href="perubahan_kelas.php" class="btn-danger">
                            <i class="fa-solid fa-xmark"></i> Batal
                        </a>
                    </div>
>>>>>>> 9a567987dd90af1392f8d15dfcbd79423ecb4815

</div>

<<<<<<< HEAD
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
<h4 class="form-section-title">
<i class="fa-solid fa-arrows-left-right"></i> Detail Perubahan Kelas
</h4>

<div class="form-grid">

<div class="form-group full">
<label>Mata Kuliah</label>
<<<<<<< HEAD
<input type="text" name="mata_kuliah" required>
</div>

<div class="form-group">
<label>Tanggal Perubahan</label>
<input type="date" name="tanggal_perubahan" required>
</div>

<div class="form-group">
<label>Dosen</label>
<input type="text" name="dosen" required>
</div>

<div class="form-group">
<label>Kelas Asal</label>
<input type="text" name="kelas_asal" required>
</div>

<div class="form-group">
<label>Kelas Baru</label>
<input type="text" name="kelas_baru" required>
</div>

</div>

<div class="form-action">
<button type="submit" name="simpan" class="btn-primary">
    <i class="fa-solid fa-save"></i> Simpan
</button>

<a href="perubahan_kelas.php" class="btn-danger">
    <i class="fa-solid fa-xmark"></i> Batal
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
=======
<input type="text" name="mata_kuliah" placeholder="Contoh: Dasar Pemrograman Web" required>
</div>
<<<<<<< HEAD

<div class="form-group">
<label>Tanggal Perubahan</label>
<input type="date" name="tanggal_perubahan" required>
</div>

<div class="form-group">
<label>Dosen</label>
<input type="text" name="dosen" placeholder="Nama Dosen" required>
</div>

<div class="form-group">
<label>Kelas Asal</label>
<input type="text" name="kelas_asal" placeholder="Contoh: A Pagi" required>
</div>

<div class="form-group">
<label>Kelas Baru</label>
<input type="text" name="kelas_baru" placeholder="Contoh: E Malam" required>
</div>

</div>

<div class="form-action">
<button type="submit" class="btn-primary">
<i class="fa-solid fa-save"></i> Simpan
</button>

<a href="perubahan_kelas.php" class="btn-danger">
<i class="fa-solid fa-xmark"></i> Batal
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
=======

<div class="form-group">
<label>Tanggal Perubahan</label>
<input type="date" name="tanggal_perubahan" required>
</div>

<div class="form-group">
<label>Dosen</label>
<input type="text" name="dosen" placeholder="Nama Dosen" required>
</div>

<div class="form-group">
<label>Kelas Asal</label>
<input type="text" name="kelas_asal" placeholder="Contoh: A Pagi" required>
</div>

<div class="form-group">
<label>Kelas Baru</label>
<input type="text" name="kelas_baru" placeholder="Contoh: E Malam" required>
</div>

</div>

<div class="form-action">
<button type="submit" class="btn-primary">
<i class="fa-solid fa-save"></i> Simpan
</button>

<a href="perubahan_kelas.php" class="btn-danger">
<i class="fa-solid fa-xmark"></i> Batal
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
=======
            </div>
        </div>
    </div>

    <footer>
        © 2025 Aplikasi Pengumuman Akademik Online | Politeknik Negeri Batam
    </footer>
    <script src="../assets/js/script3.js"></script>
>>>>>>> 9a567987dd90af1392f8d15dfcbd79423ecb4815
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
</body>
</html>

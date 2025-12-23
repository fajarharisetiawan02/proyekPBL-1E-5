<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";

$pesan = "";

if (isset($_POST['simpan'])) {

    $nim     = mysqli_real_escape_string($koneksi, $_POST['nim']);
    $nama    = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $prodi   = mysqli_real_escape_string($koneksi, $_POST['prodi']);
    $jurusan = mysqli_real_escape_string($koneksi, $_POST['jurusan']);
    $kelas   = mysqli_real_escape_string($koneksi, $_POST['kelas']);
    $email   = mysqli_real_escape_string($koneksi, $_POST['email']);

    // CEK NIM
    $cek = mysqli_query($koneksi, "SELECT id_mahasiswa FROM mahasiswa WHERE nim='$nim'");
    if (mysqli_num_rows($cek) > 0) {
        $pesan = "<div class='alert error'>NIM sudah terdaftar</div>";
    } else {

        // SIMPAN MAHASISWA
        mysqli_query($koneksi, "
            INSERT INTO mahasiswa (nim, nama, prodi, jurusan, kelas, email)
            VALUES ('$nim', '$nama', '$prodi', '$jurusan', '$kelas', '$email')
        ");

        $id_mahasiswa = mysqli_insert_id($koneksi);

        // PASSWORD = NIM
        $password = password_hash($nim, PASSWORD_DEFAULT);

        // SIMPAN LOGIN (INI KUNCI NYA 🔥)
        mysqli_query($koneksi, "
            INSERT INTO login 
            (username, password, nama, email, role, id_mahasiswa)
            VALUES 
            ('$nim', '$password', '$nama', '$email', 'mahasiswa', '$id_mahasiswa')
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
<link rel="stylesheet" href="../assets/css/mahasiswa.css">
        <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
</head>
<body>


<div class="main-wrapper">

    <?php include "../components_admin/sidebar.php"; ?>
    <?php include "../components_admin/topbar.php"; ?>

    <div class="main-content">
        <div class="content-container">

    <h2>Tambah Data Mahasiswa</h2>
    <p class="page-desc">
        Silakan lengkapi data mahasiswa di bawah ini. Akun login akan dibuat secara otomatis.
    </p>

    <form method="POST" class="form-box">

        <label>NIM</label>
        <input type="text" name="nim" placeholder="Contoh: 22010123" required>

        <label>Nama Lengkap</label>
        <input type="text" name="nama" placeholder="Nama sesuai data akademik" required>

        <hr>

        <label>Program Studi</label>
        <input type="text" name="prodi" placeholder="Contoh: D4 Teknik Informatika" required>

        <label>Jurusan</label>
        <input type="text" name="jurusan" placeholder="Contoh: Teknologi Informasi" required>

        <label>Kelas</label>
        <input type="text" name="kelas" placeholder="Contoh: TI-4A" required>

        <hr>

        <label>Email</label>
        <input type="email" name="email" placeholder="email@student.ac.id" required>

        <small class="hint">
            Password awal mahasiswa akan disamakan dengan NIM dan dapat diubah setelah login.
        </small>

        <div class="form-action">
            <button type="submit" name="simpan">Simpan Data</button>
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

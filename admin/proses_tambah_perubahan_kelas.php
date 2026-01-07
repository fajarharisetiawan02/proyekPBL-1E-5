<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";
require_once "../config/helper_aktivitas.php"; // 🔑 WAJIB

if (!isset($_POST['simpan'])) {
    header("Location: perubahan_kelas.php");
    exit;
}

$id_login = $_SESSION['id_login'];

/* ===============================
   AMBIL DATA FORM
================================ */
$jurusan            = mysqli_real_escape_string($koneksi, $_POST['jurusan']);
$prodi              = mysqli_real_escape_string($koneksi, $_POST['prodi']);
$kelas              = mysqli_real_escape_string($koneksi, $_POST['kelas']);
$shift              = mysqli_real_escape_string($koneksi, $_POST['shift']);
$semester           = (int) $_POST['semester'];
$mata_kuliah        = mysqli_real_escape_string($koneksi, $_POST['mata_kuliah']);
$tanggal_perubahan  = $_POST['tanggal_perubahan'];
$dosen              = mysqli_real_escape_string($koneksi, $_POST['dosen']);
$kelas_asal         = mysqli_real_escape_string($koneksi, $_POST['kelas_asal']);
$kelas_baru         = mysqli_real_escape_string($koneksi, $_POST['kelas_baru']);

/* ===============================
   1. SIMPAN PERUBAHAN KELAS
================================ */
mysqli_query($koneksi, "
INSERT INTO perubahan_kelas
(jurusan, prodi, kelas, shift, semester,
 mata_kuliah, tanggal_perubahan, dosen,
 kelas_asal, kelas_baru)
VALUES
(
 '$jurusan','$prodi','$kelas','$shift','$semester',
 '$mata_kuliah','$tanggal_perubahan','$dosen',
 '$kelas_asal','$kelas_baru'
)
") or die(mysqli_error($koneksi));

/* ===============================
   2. ✅ AKTIVITAS ADMIN (INI KUNCI DASHBOARD)
================================ */
logAktivitasAdmin(
    $koneksi,
    "Perubahan kelas $mata_kuliah | $prodi $kelas_asal → $kelas_baru ($shift)"
);

/* ===============================
   3. 🔔 NOTIFIKASI WEB ADMIN
================================ */
mysqli_query($koneksi, "
INSERT INTO notifikasi
(judul, isi, role, status, is_read, tanggal)
VALUES
(
 'Perubahan Kelas',
 'Perubahan kelas <b>$mata_kuliah</b> berhasil disimpan.',
 'admin',
 'aktif',
 0,
 NOW()
)
");

/* ===============================
   4. 🔔 NOTIFIKASI WEB MAHASISWA
================================ */
mysqli_query($koneksi, "
INSERT INTO notifikasi
(judul, isi, role, jurusan, prodi, kelas, shift, semester, status, is_read, tanggal)
VALUES
(
 'Perubahan Jadwal Kelas',
 'Terdapat perubahan kelas untuk <b>$mata_kuliah</b>.',
 'mahasiswa',
 '$jurusan',
 '$prodi',
 '$kelas',
 '$shift',
 '$semester',
 'aktif',
 0,
 NOW()
)
");

/* ===============================
   SELESAI
================================ */
header("Location: perubahan_kelas.php?status=berhasil");
exit;

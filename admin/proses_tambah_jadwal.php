<?php
session_start();
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";

date_default_timezone_set('Asia/Jakarta');

/* VALIDASI */
if (!isset($_POST['mata_kuliah'])) {
    header("Location: jadwal_ujian.php");
    exit;
}

/* DATA */
$mata_kuliah   = mysqli_real_escape_string($koneksi, $_POST['mata_kuliah']);
$jurusan       = mysqli_real_escape_string($koneksi, $_POST['jurusan']);
$prodi         = mysqli_real_escape_string($koneksi, $_POST['prodi']);
$kelas         = mysqli_real_escape_string($koneksi, $_POST['kelas']);
$shift         = mysqli_real_escape_string($koneksi, $_POST['shift']);
$semester      = (int) $_POST['semester'];
$tanggal       = $_POST['tanggal'];
$waktu_mulai   = $_POST['waktu_mulai'];
$waktu_selesai = $_POST['waktu_selesai'];
$ruang         = mysqli_real_escape_string($koneksi, $_POST['ruang']);
$dosen         = mysqli_real_escape_string($koneksi, $_POST['dosen']);

/* =========================
   HITUNG HARI DARI TANGGAL
========================= */
$hariInggris = date('l', strtotime($tanggal));
$mapHari = [
    'Monday'    => 'Senin',
    'Tuesday'   => 'Selasa',
    'Wednesday' => 'Rabu',
    'Thursday'  => 'Kamis',
    'Friday'    => 'Jumat',
    'Saturday'  => 'Sabtu',
    'Sunday'    => 'Minggu'
];
$hari = $mapHari[$hariInggris];

/* VALIDASI WAKTU (OPSIONAL TAPI DISARANKAN) */
if ($waktu_selesai <= $waktu_mulai) {
    echo "<script>
        alert('Waktu selesai harus lebih besar dari waktu mulai');
        history.back();
    </script>";
    exit;
}

/* =========================
   SIMPAN JADWAL (FINAL)
========================= */
mysqli_query($koneksi, "
INSERT INTO jadwal_ujian
(
 mata_kuliah, jurusan, prodi, kelas, shift, semester,
 hari, tanggal, waktu_mulai, waktu_selesai, ruang, dosen
)
VALUES
(
 '$mata_kuliah','$jurusan','$prodi','$kelas','$shift','$semester',
 '$hari','$tanggal','$waktu_mulai','$waktu_selesai','$ruang','$dosen'
)
");

/* SELESAI */
header("Location: jadwal_ujian.php?status=tersimpan");
exit;

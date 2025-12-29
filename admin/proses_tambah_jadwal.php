<?php
session_start();
require_once "../config/koneksi.php";

/* ===============================
   AMBIL DATA FORM
================================ */
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

/* ===============================
   VALIDASI
================================ */
if (
    empty($mata_kuliah) || empty($jurusan) || empty($prodi) ||
    empty($kelas) || empty($shift) || $semester === 0 ||
    empty($tanggal) || empty($waktu_mulai) || empty($waktu_selesai) ||
    empty($ruang) || empty($dosen)
) {
    die("ERROR: Data form belum lengkap");
}

/* ===============================
   1. SIMPAN JADWAL UJIAN
================================ */
mysqli_query($koneksi, "
    INSERT INTO jadwal_ujian
    (mata_kuliah, jurusan, prodi, kelas, shift, semester,
     tanggal, waktu_mulai, waktu_selesai, ruang, dosen)
    VALUES
    ('$mata_kuliah', '$jurusan', '$prodi', '$kelas', '$shift', '$semester',
     '$tanggal', '$waktu_mulai', '$waktu_selesai', '$ruang', '$dosen')
");

/* ===============================
   3. SIMPAN NOTIFIKASI MAHASISWA
================================ */
$judul_notif = "Jadwal Ujian Baru";
$isi_notif = "Ujian $mata_kuliah
Prodi $prodi
Kelas $kelas ($shift)
Tanggal $tanggal
Pukul $waktu_mulai - $waktu_selesai
Ruang $ruang";

mysqli_query($koneksi, "
    INSERT INTO notifikasi (judul, isi, role, status)
    VALUES ('$judul_notif', '$isi_notif', 'mahasiswa', 'aktif')
");

/* ===============================
   REDIRECT
================================ */
header("Location: jadwal_ujian.php?status=tersimpan");
exit;

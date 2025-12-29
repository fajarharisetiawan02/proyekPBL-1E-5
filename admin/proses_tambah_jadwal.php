<?php
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
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
<<<<<<< HEAD
=======
=======
require_once "../config/koneksi.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

// AMBIL DATA FORM

$mata_kuliah = mysqli_real_escape_string($koneksi, $_POST['mata_kuliah']);
$tanggal     = $_POST['tanggal'];
$waktu       = $_POST['waktu'];
$ruang       = mysqli_real_escape_string($koneksi, $_POST['ruang']);
$prodi       = mysqli_real_escape_string($koneksi, $_POST['prodi']);

// SIMPAN JADWAL UJIAN

mysqli_query($koneksi, "
    INSERT INTO jadwal_ujian (mata_kuliah, tanggal, waktu, ruang, prodi)
    VALUES ('$mata_kuliah', '$tanggal', '$waktu', '$ruang', '$prodi')
");

// SIMPAN NOTIFIKASI

$judul = "Jadwal Ujian Baru";
$isi   = "Jadwal ujian $mata_kuliah telah ditambahkan.
Tanggal: $tanggal
Waktu: $waktu
Ruang: $ruang";

mysqli_query($koneksi, "
    INSERT INTO notifikasi (judul, isi, role, status)
    VALUES ('$judul', '$isi', 'mahasiswa', 'aktif')
");

// KIRIM EMAIL KE MAHASISWA

$q_mhs = mysqli_query($koneksi, "
    SELECT email, nama
    FROM mahasiswa
    WHERE prodi = '$prodi'
");

while ($mhs = mysqli_fetch_assoc($q_mhs)) {

    $to      = $mhs['email'];
    $subject = $judul;

    $message = "
Halo {$mhs['nama']},

$isi

Subjek: Informasi Jadwal Ujian

Yth. Mahasiswa/i,

Dengan hormat,

Kami informasikan bahwa jadwal ujian telah ditetapkan dengan rincian sebagai berikut:

Mata Kuliah : {MATA_KULIAH}
Tanggal     : {TANGGAL}
Waktu       : {WAKTU}
Ruang       : {RUANG}

Mohon untuk hadir tepat waktu dan mempersiapkan diri dengan baik.

Untuk informasi lebih lanjut, silakan login ke Sistem Akademik.

Demikian informasi ini kami sampaikan. Atas perhatian Saudara/i, kami ucapkan terima kasih.

Hormat kami,
PBL Kelompok 5

    ";

    $headers = "From: akademik@kampus.ac.id";

    mail($to, $subject, $message, $headers);
}

header("Location: jadwal_ujian.php?status=berhasil");
>>>>>>> 9a567987dd90af1392f8d15dfcbd79423ecb4815
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
exit;

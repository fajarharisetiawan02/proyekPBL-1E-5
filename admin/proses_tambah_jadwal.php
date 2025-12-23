<?php
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
exit;

<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";
require_once "../config/email_helper.php";
require_once "../admin/kirim_notifikasi_beasiswa.php";

if (!isset($_POST['simpan'])) {
    header("Location: beasiswa.php");
    exit;
}

$id_login = $_SESSION['id_login'];

/* ===============================
   AMBIL DATA
================================ */
$nama_beasiswa = mysqli_real_escape_string($koneksi, $_POST['nama_beasiswa']);
$deskripsi     = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
$syarat        = mysqli_real_escape_string($koneksi, $_POST['syarat']);
$periode       = mysqli_real_escape_string($koneksi, $_POST['periode']);
$tanggal_buka  = $_POST['tanggal_buka'];
$tanggal_tutup = $_POST['tanggal_tutup'];
$status        = $_POST['status'];

/* ===============================
   1. SIMPAN BEASISWA
================================ */
mysqli_query($koneksi, "
INSERT INTO beasiswa
(nama_beasiswa, deskripsi, syarat, periode,
 tanggal_buka, tanggal_tutup, status)
VALUES
('$nama_beasiswa','$deskripsi','$syarat','$periode',
 '$tanggal_buka','$tanggal_tutup','$status')
");

/* ===============================
   2. SIMPAN AKTIVITAS ADMIN
================================ */
$aktivitas = "Menambahkan beasiswa: $nama_beasiswa";

mysqli_query($koneksi, "
INSERT INTO aktivitas_admin (id_login, aktivitas)
VALUES ('$id_login', '$aktivitas')
");

/* ===============================
   3. AMBIL MAHASISWA (EMAIL VALID)
================================ */
$q_mhs = mysqli_query($koneksi, "
SELECT nama, email
FROM mahasiswa
WHERE email IS NOT NULL
AND email != ''
AND email LIKE '%@%'
");

/* ===============================
   4. SIAPKAN EMAIL
================================ */
$subject = "🎓 Informasi Beasiswa – $nama_beasiswa";

$dataEmail = [
'nama_beasiswa' => $nama_beasiswa,
'periode'       => $periode,
'tanggal_buka'  => date('d M Y', strtotime($tanggal_buka)),
'tanggal_tutup' => date('d M Y', strtotime($tanggal_tutup)),
'syarat'        => nl2br($syarat),
'prodi'         => 'Seluruh Program Studi',
'link'          => 'http://localhost/proyekPBL-1E-5/mahasiswa/beasiswa.php'
];

$body = emailBeasiswaCard($dataEmail);

/* ===============================
   5. KIRIM EMAIL
================================ */
while ($m = mysqli_fetch_assoc($q_mhs)) {
    kirimEmail($m['email'], $m['nama'], $subject, $body);
}

/* ===============================
   REDIRECT
================================ */
header("Location: beasiswa.php?status=berhasil");
exit;

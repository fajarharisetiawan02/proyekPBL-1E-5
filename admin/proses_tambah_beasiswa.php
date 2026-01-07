<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";
require_once "../config/email_helper.php";
<<<<<<< HEAD
require_once "../config/helper_aktivitas.php"; // 🔑 AKTIVITAS FIX
=======
require_once "../admin/kirim_notifikasi_beasiswa.php";
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717

if (!isset($_POST['simpan'])) {
    header("Location: beasiswa.php");
    exit;
}

<<<<<<< HEAD
/* ===============================
   AMBIL DATA FORM
=======
$id_login = $_SESSION['id_login'];

/* ===============================
   AMBIL DATA
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
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
<<<<<<< HEAD
(nama_beasiswa, deskripsi, syarat, periode, tanggal_buka, tanggal_tutup, status)
VALUES
(
 '$nama_beasiswa',
 '$deskripsi',
 '$syarat',
 '$periode',
 '$tanggal_buka',
 '$tanggal_tutup',
 '$status'
)
");

/* ===============================
   2. AKTIVITAS ADMIN (FIX)
================================ */
logAktivitasAdmin(
    $koneksi,
    "Menambahkan beasiswa: $nama_beasiswa"
);

/* ===============================
   3. 🔔 NOTIFIKASI WEB ADMIN
================================ */
mysqli_query($koneksi, "
INSERT INTO notifikasi
(judul, isi, role, tanggal, status, is_read)
VALUES
(
 'Beasiswa Baru Ditambahkan',
 'Beasiswa <b>$nama_beasiswa</b> berhasil ditambahkan.',
 'admin',
 NOW(),
 'aktif',
 0
)
");

/* ===============================
   4. 🔔 NOTIFIKASI WEB MAHASISWA
================================ */
$isiMhs = "
Beasiswa <b>$nama_beasiswa</b> telah dibuka.<br>
Periode: $periode<br>
Pendaftaran:
".date('d M Y', strtotime($tanggal_buka))." s/d
".date('d M Y', strtotime($tanggal_tutup))."
";

mysqli_query($koneksi, "
INSERT INTO notifikasi
(judul, isi, role, tanggal, status, is_read)
VALUES
(
 'Beasiswa Baru Dibuka',
 '".mysqli_real_escape_string($koneksi, $isiMhs)."',
 'mahasiswa',
 NOW(),
 'aktif',
 0
)
");

/* ===============================
   5. EMAIL MAHASISWA
=======
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
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
================================ */
$q_mhs = mysqli_query($koneksi, "
SELECT nama, email
FROM mahasiswa
WHERE email IS NOT NULL
AND email != ''
<<<<<<< HEAD
");

$dataEmail = [
    'nama_beasiswa' => $nama_beasiswa,
    'periode'       => $periode,
    'tanggal_buka'  => date('d M Y', strtotime($tanggal_buka)),
    'tanggal_tutup' => date('d M Y', strtotime($tanggal_tutup)),
    'syarat'        => nl2br($syarat),
    'prodi'         => 'Seluruh Program Studi',
    'link'          => 'http://localhost/proyekPBL-1E-5/mahasiswa/beasiswa.php'
=======
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
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
];

$body = emailBeasiswaCard($dataEmail);

<<<<<<< HEAD
while ($m = mysqli_fetch_assoc($q_mhs)) {
    kirimEmail(
        $m['email'],
        $m['nama'],
        "🎓 Informasi Beasiswa – $nama_beasiswa",
        $body
    );
}

/* ===============================
   SELESAI
=======
/* ===============================
   5. KIRIM EMAIL
================================ */
while ($m = mysqli_fetch_assoc($q_mhs)) {
    kirimEmail($m['email'], $m['nama'], $subject, $body);
}

/* ===============================
   REDIRECT
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
================================ */
header("Location: beasiswa.php?status=berhasil");
exit;

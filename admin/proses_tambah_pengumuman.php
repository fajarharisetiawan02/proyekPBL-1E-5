<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";
require_once "../config/email_helper.php";
require_once "../admin/kirim_notifikasi_pengumuman.php"; // EMAIL
require_once "../config/helper_aktivitas.php"; // 🔑 AKTIVITAS

/* ===============================
   VALIDASI REQUEST
================================ */
if (!isset($_POST['judul'], $_POST['isi'], $_POST['kategori'])) {
    header("Location: pengumuman.php");
    exit;
}

/* ===============================
   AMBIL DATA
================================ */
$judul    = trim($_POST['judul']);
$isi      = trim($_POST['isi']);
$kategori = trim($_POST['kategori']);
$tanggal  = date('Y-m-d');

/* ===============================
   1. SIMPAN PENGUMUMAN
================================ */
$stmt = mysqli_prepare(
    $koneksi,
    "INSERT INTO pengumuman (judul, isi, kategori, dibuat_pada)
     VALUES (?, ?, ?, ?)"
);
mysqli_stmt_bind_param($stmt, "ssss", $judul, $isi, $kategori, $tanggal);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

/* ===============================
   1.5 ✅ AKTIVITAS ADMIN (INI KUNCI DASHBOARD)
================================ */
logAktivitasAdmin(
    $koneksi,
    "Menambahkan pengumuman: $judul"
);

/* ===============================
   2. 🔔 NOTIFIKASI WEB MAHASISWA
================================ */
$notifMhsIsi = "
<b>$judul</b><br>
Pengumuman baru telah dipublikasikan.
Silakan buka menu <b>Pengumuman</b> untuk membaca detail lengkap.
";

mysqli_query($koneksi, "
INSERT INTO notifikasi
(judul, isi, role, tanggal, status, is_read)
VALUES
(
 'Pengumuman Baru',
 '".mysqli_real_escape_string($koneksi, $notifMhsIsi)."',
 'mahasiswa',
 NOW(),
 'aktif',
 0
)
");

/* ===============================
   3. 🔔 NOTIFIKASI WEB ADMIN
================================ */
$notifAdminIsi = "
Pengumuman <b>$judul</b> berhasil dipublikasikan
dan dikirim ke seluruh mahasiswa.
";

mysqli_query($koneksi, "
INSERT INTO notifikasi
(judul, isi, role, tanggal, status, is_read)
VALUES
(
 'Pengumuman Dipublikasikan',
 '".mysqli_real_escape_string($koneksi, $notifAdminIsi)."',
 'admin',
 NOW(),
 'aktif',
 0
)
");

/* ===============================
   4. EMAIL KE MAHASISWA
================================ */
$q_mhs = mysqli_query($koneksi, "
SELECT nama, email
FROM mahasiswa
WHERE email IS NOT NULL
  AND email != ''
");

$emailData = [
    'judul'    => $judul,
    'kategori' => $kategori,
    'tanggal'  => date('d M Y'),
    'isi'      => nl2br($isi),
    'link'     => 'http://localhost/proyekPBL-1E-5/mahasiswa/pengumuman.php'
];

$body = emailPengumumanCard($emailData);

while ($m = mysqli_fetch_assoc($q_mhs)) {
    kirimEmail(
        $m['email'],
        $m['nama'],
        "📢 Pengumuman Akademik – $judul",
        $body
    );
}

/* ===============================
   SELESAI
================================ */
header("Location: pengumuman.php?status=berhasil");
exit;

<?php
<<<<<<< HEAD
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";
require_once "../config/helper_aktivitas.php"; // 🔑 WAJIB
=======
session_start();
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";
require_once "../config/email_helper.php";
require_once "../admin/kirim_notifikasi_perubahan.php";
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717

if (!isset($_POST['simpan'])) {
    header("Location: perubahan_kelas.php");
    exit;
}

<<<<<<< HEAD
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
=======
/* ===============================
   AMBIL DATA FORM
================================ */
$mata_kuliah       = mysqli_real_escape_string($koneksi, $_POST['mata_kuliah']);
$tanggal_perubahan = $_POST['tanggal_perubahan'];
$jurusan           = mysqli_real_escape_string($koneksi, $_POST['jurusan']);
$prodi             = mysqli_real_escape_string($koneksi, $_POST['prodi']);
$kelas             = mysqli_real_escape_string($koneksi, $_POST['kelas']);
$shift             = mysqli_real_escape_string($koneksi, $_POST['shift']);
$semester          = (int) $_POST['semester'];
$kelas_asal        = mysqli_real_escape_string($koneksi, $_POST['kelas_asal']);
$kelas_baru        = mysqli_real_escape_string($koneksi, $_POST['kelas_baru']);
$dosen             = mysqli_real_escape_string($koneksi, $_POST['dosen']);

/* ===============================
   VALIDASI
================================ */
if (
    empty($mata_kuliah) || empty($tanggal_perubahan) ||
    empty($jurusan) || empty($prodi) || empty($kelas) ||
    empty($shift) || empty($semester) ||
    empty($kelas_asal) || empty($kelas_baru) || empty($dosen)
) {
    die("ERROR: Data perubahan kelas belum lengkap");
}
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717

/* ===============================
   1. SIMPAN PERUBAHAN KELAS
================================ */
mysqli_query($koneksi, "
<<<<<<< HEAD
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
=======
    INSERT INTO perubahan_kelas
    (mata_kuliah, tanggal_perubahan, jurusan, prodi, kelas, shift, semester, kelas_asal, kelas_baru, dosen)
    VALUES
    ('$mata_kuliah', '$tanggal_perubahan', '$jurusan', '$prodi', '$kelas', '$shift', '$semester',
     '$kelas_asal', '$kelas_baru', '$dosen')
");

/* ===============================
   2. SIMPAN AKTIVITAS ADMIN ✅
================================ */
$id_login = $_SESSION['id_login'];

$aktivitas = "Perubahan kelas: $mata_kuliah | $prodi $kelas_asal → $kelas_baru $kelas ($shift)";

mysqli_query($koneksi, "
    INSERT INTO aktivitas_admin (id_login, aktivitas)
    VALUES ('$id_login', '$aktivitas')
");

/* ===============================
   3. NOTIFIKASI WEB
================================ */
$judul_notif = "Pemberitahuan Perubahan Kelas";

$isi_notif = "
<div style='border:1px solid #e5e7eb;border-radius:12px;padding:14px'>
    <div style='font-weight:700;color:#111827;margin-bottom:6px'>
        Perubahan Kelas Mata Kuliah
    </div>
    <div style='font-size:13px;color:#374151'>
        <b>$mata_kuliah</b> mengalami perubahan kelas dari
        <b>$kelas_asal</b> ke <b>$kelas_baru</b>.
    </div>
    <div style='font-size:12px;color:#6b7280;margin-top:6px'>
        $jurusan • $prodi • Kelas $kelas • $shift • Semester $semester
    </div>
</div>
";

mysqli_query($koneksi, "
    INSERT INTO notifikasi (judul, isi, role, status)
    VALUES (
        '$judul_notif',
        '".mysqli_real_escape_string($koneksi, $isi_notif)."',
        'mahasiswa',
        'aktif'
    )
");

/* ===============================
   4. AMBIL MAHASISWA (FILTER)
================================ */
$q_mhs = mysqli_query($koneksi, "
    SELECT nama, email
    FROM mahasiswa
    WHERE jurusan  = '$jurusan'
      AND prodi    = '$prodi'
      AND kelas    = '$kelas'
      AND shift    = '$shift'
      AND semester = '$semester'
      AND email IS NOT NULL
      AND email != ''
");

/* ===============================
   5. KIRIM EMAIL
================================ */
$dataEmail = [
    'jurusan'     => $jurusan,
    'prodi'       => $prodi,
    'mata_kuliah' => $mata_kuliah,
    'dosen'       => $dosen,
    'kelas'       => $kelas,
    'shift'       => $shift,
    'semester'    => $semester,
    'kelas_asal'  => $kelas_asal,
    'kelas_baru'  => $kelas_baru,
    'tanggal'     => date('d-m-Y', strtotime($tanggal_perubahan)),
    'link'        => 'http://localhost/proyekPBL-1E-5/mahasiswa/perkuliahan.php'
];

while ($m = mysqli_fetch_assoc($q_mhs)) {
    $subject = "🔄 Pemberitahuan Perubahan Kelas – $prodi";
    $body    = emailPerubahanKelasCard($dataEmail);
    kirimEmail($m['email'], $m['nama'], $subject, $body);
}

/* ===============================
   REDIRECT
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
================================ */
header("Location: perubahan_kelas.php?status=berhasil");
exit;

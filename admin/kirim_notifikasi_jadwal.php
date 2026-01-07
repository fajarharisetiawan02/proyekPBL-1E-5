<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";
require_once "../config/email_helper.php";

date_default_timezone_set('Asia/Jakarta');

/* ===============================
   VALIDASI PRODI (WAJIB)
================================ */
$prodi = trim($_GET['prodi'] ?? '');
if ($prodi === '') {
    die("ERROR: Prodi wajib dipilih.");
}

$prodi_sql = mysqli_real_escape_string($koneksi, $prodi);
$tahun = date('Y');

/* ===============================
   CEK JADWAL UJIAN ADA
================================ */
$cek = mysqli_query($koneksi, "
    SELECT 1 
    FROM jadwal_ujian
    WHERE TRIM(LOWER(prodi)) = TRIM(LOWER('$prodi_sql'))
    LIMIT 1
");

if (mysqli_num_rows($cek) === 0) {
    die("ERROR: Jadwal ujian belum tersedia untuk prodi ini.");
}

/* ===============================
   🔔 NOTIFIKASI MAHASISWA
================================ */
$judulMhs = "Jadwal Ujian Telah Dipublikasikan";

$isiMhs = "
<b>Jadwal ujian telah dipublikasikan.</b><br>
Silakan cek menu <b>Jadwal Ujian</b> untuk melihat detail jadwal
sesuai kelas dan semester Anda.
";

mysqli_query($koneksi, "
INSERT INTO notifikasi
(judul, isi, role, tanggal, status, is_read)
VALUES
(
 '$judulMhs',
 '".mysqli_real_escape_string($koneksi, $isiMhs)."',
 'mahasiswa',
 NOW(),
 'aktif',
 0
)
");

/* ===============================
   🔔 NOTIFIKASI ADMIN
================================ */
$judulAdmin = "Jadwal Ujian Dipublikasikan";

$isiAdmin = "
Jadwal ujian tahun <b>$tahun</b> untuk
Program Studi <b>$prodi</b>
telah berhasil dipublikasikan.
";

mysqli_query($koneksi, "
INSERT INTO notifikasi
(judul, isi, role, tanggal, status, is_read)
VALUES
(
 '$judulAdmin',
 '".mysqli_real_escape_string($koneksi, $isiAdmin)."',
 'admin',
 NOW(),
 'aktif',
 0
)
");

/* ===============================
   AMBIL MAHASISWA (HANYA PRODI)
================================ */
$q_mhs = mysqli_query($koneksi, "
SELECT nama, email, jurusan, kelas, shift, semester
FROM mahasiswa
WHERE TRIM(LOWER(prodi)) = TRIM(LOWER('$prodi_sql'))
AND email IS NOT NULL
AND email != ''
");

/* ===============================
   5. KIRIM EMAIL (PERSONAL)
================================ */
while ($m = mysqli_fetch_assoc($q_mhs)) {

    $jurusan  = $m['jurusan'];
    $kelas    = $m['kelas'];
    $shift    = $m['shift'];
    $semester = $m['semester'];

/* ===============================
   EMAIL
   (ISI PERSIS – TIDAK DIUBAH)
================================ */
$subject = "📘 Pemberitahuan Jadwal Ujian – $prodi";

$body = "
<div style='font-family:Arial,Helvetica,sans-serif;color:#111827'>
  <div style='max-width:620px;margin:auto;border:1px solid #e5e7eb;
              border-radius:14px;overflow:hidden'>
    <div style='background:#1e3a8a;color:#fff;padding:16px 20px'>
      <div style='font-size:18px;font-weight:700'>Pemberitahuan Akademik</div>
      <div style='opacity:.9'>Jadwal Ujian Program Studi $prodi</div>
    </div>

    <div style='padding:18px 20px'>
      <p>Yth. Mahasiswa/i,</p>
      <p>
        Dengan hormat, kami informasikan bahwa <strong>jadwal ujian</strong> untuk
        Program Studi <strong>$prodi</strong> telah dipublikasikan melalui
        Sistem Pengumuman Akademik Online.
      </p>

      <table width='100%' cellpadding='10' cellspacing='0'
             style='border-collapse:collapse;font-size:14px;margin:14px 0'>
        <tr><td style='border:1px solid #e5e7eb;font-weight:700'>Jurusan</td><td style='border:1px solid #e5e7eb'>$jurusan</td></tr>
        <tr><td style='border:1px solid #e5e7eb;font-weight:700'>Program Studi</td><td style='border:1px solid #e5e7eb'>$prodi</td></tr>
        <tr><td style='border:1px solid #e5e7eb;font-weight:700'>Kelas</td> 
       <td style='border:1px solid #e5e7eb'>{$m['kelas']} ({$m['shift']})</td></tr>
        <tr><td style='border:1px solid #e5e7eb;font-weight:700'>Semester</td><td style='border:1px solid #e5e7eb'>$semester</td></tr>
        <tr>
                   <td style='border:1px solid #e5e7eb;font-weight:700'>Status</td>
          <td style='border:1px solid #e5e7eb;color:#16a34a;font-weight:700'>
            Telah Dipublikasikan
          </td>
        </tr>
        <tr>
          <td style='border:1px solid #e5e7eb;font-weight:700'>Akses Informasi</td>
          <td style='border:1px solid #e5e7eb'>
            <a href='http://localhost/proyekPBL-1E-5/mahasiswa/jadwal_ujian.php'>
              Pengumuman Akademik Online
            </a>
          </td>
        </tr>
      </table>

      <p>
        Untuk memastikan informasi yang selalu terbaru, detail jadwal ujian
        dapat dilihat langsung melalui sistem.
      </p>

      <a href='http://localhost/proyekPBL-1E-5/mahasiswa/jadwal_ujian.php'
         style='display:inline-block;margin-top:6px;padding:10px 18px;
                background:#1e3a8a;color:#fff;text-decoration:none;
                border-radius:10px;font-weight:700'>
         Akses Jadwal Ujian
      </a>

      <p style='margin-top:18px'>
        Hormat kami,<br>
        <strong>Bagian Akademik</strong><br>
        <strong>Politeknik Negeri Batam</strong>
      </p>
    </div>

    <div style='background:#f9fafb;color:#6b7280;
                padding:10px 20px;font-size:12px'>
      Email ini dikirim otomatis oleh Sistem Pengumuman Akademik Online.
      Mohon tidak membalas email ini.
    </div>
  </div>
</div>
";


/* ===============================
   KIRIM EMAIL
================================ */
kirimEmail($m['email'], $m['nama'], $subject, $body);
}

header("Location: jadwal_ujian.php?status=notifikasi_terkirim");
exit;
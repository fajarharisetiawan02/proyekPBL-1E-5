<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";
require_once "../config/email_helper.php";

/* ===============================
   1. FILTER (HANYA PRODI)
================================ */
$prodi = $_GET['prodi'] ?? '';
if ($prodi === '') {
    die("ERROR: Prodi wajib dipilih.");
}

/* ===============================
   2. CEK JADWAL ADA
================================ */
$cek = mysqli_query($koneksi, "
    SELECT 1 FROM jadwal_ujian
    WHERE prodi = '$prodi'
    LIMIT 1
");

if (mysqli_num_rows($cek) === 0) {
    die("ERROR: Jadwal ujian belum tersedia untuk prodi ini.");
}

/* ===============================
   NOTIFIKASI WEB
   (ISI TIDAK DIUBAH)
================================ */
$judul_notif = "Pemberitahuan Jadwal Ujian $prodi";

$isi_notif = "
<div style='border:1px solid #e5e7eb;border-radius:12px;padding:14px'>
  <div style='display:flex;gap:10px;align-items:center;margin-bottom:10px'>
    <div style='width:36px;height:36px;border-radius:8px;background:#eef2ff;
                display:flex;align-items:center;justify-content:center;
                color:#1e3a8a;font-weight:700'>UJ</div>
    <div>
      <div style='font-weight:700;color:#111827'>Jadwal Ujian Dipublikasikan</div>
      <div style='font-size:12px;color:#6b7280'>Program Studi $prodi</div>
    </div>
  </div>

  <table style='width:100%;border-collapse:collapse;font-size:14px'>
    <tr><td style='padding:8px;border:1px solid #e5e7eb;font-weight:600'>Jurusan</td><td style='padding:8px;border:1px solid #e5e7eb'>$jurusan</td></tr>
    <tr><td style='padding:8px;border:1px solid #e5e7eb;font-weight:600'>Program Studi</td><td style='padding:8px;border:1px solid #e5e7eb'>$prodi</td></tr>
    <tr><td style='padding:8px;border:1px solid #e5e7eb;font-weight:600'>Kelas</td><td style='padding:8px;border:1px solid #e5e7eb'>$kelas</td></tr>
    <tr><td style='padding:8px;border:1px solid #e5e7eb;font-weight:600'>Shift</td><td style='padding:8px;border:1px solid #e5e7eb'>$shift</td></tr>
    <tr><td style='padding:8px;border:1px solid #e5e7eb;font-weight:600'>Semester</td><td style='padding:8px;border:1px solid #e5e7eb'>$semester</td></tr>

  </table>

  <p style='margin:12px 0 10px 0;color:#374151'>
    Silakan akses sistem untuk melihat detail jadwal ujian secara lengkap.
  </p>

  <a href='../mahasiswa/jadwal_ujian.php'
     style='display:inline-block;padding:9px 14px;background:#1e3a8a;color:#fff;
            text-decoration:none;border-radius:8px;font-size:13px;font-weight:700'>
     Lihat Jadwal Ujian
  </a>
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
   4. AMBIL MAHASISWA (DATA LENGKAP)
================================ */
$q_mhs = mysqli_query($koneksi, "
    SELECT 
        nama,
        email,
        jurusan,
        prodi,
        kelas,
        shift,
        semester
    FROM mahasiswa
    WHERE prodi = '$prodi'
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
        <tr><td style='border:1px solid #e5e7eb;font-weight:700'>Kelas</td><td style='border:1px solid #e5e7eb'>$kelas</td></tr>
        <tr><td style='border:1px solid #e5e7eb;font-weight:700'>Shift</td><td style='border:1px solid #e5e7eb'>$shift</td></tr>
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
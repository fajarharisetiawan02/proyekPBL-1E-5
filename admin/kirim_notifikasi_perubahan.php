<?php
function emailPerubahanKelasCard($data)
{
    return "
<div style='font-family:Arial,Helvetica,sans-serif;color:#111827'>
  <div style='max-width:620px;margin:auto;border:1px solid #e5e7eb;
              border-radius:14px;overflow:hidden'>

    <!-- HEADER (SAMA DENGAN JADWAL UJIAN) -->
    <div style='background:#1e3a8a;color:#fff;padding:16px 20px'>
      <div style='font-size:18px;font-weight:700'>Pemberitahuan Akademik</div>
      <div style='opacity:.9'>Perubahan Kelas Program Studi {$data['prodi']}</div>
    </div>

    <!-- BODY -->
    <div style='padding:18px 20px'>
      <p>Yth. Mahasiswa/i,</p>

      <p>
        Dengan hormat, kami informasikan bahwa telah dilakukan
        <strong>perubahan kelas</strong> pada kegiatan perubahan kelas
        Program Studi <strong>{$data['prodi']}</strong>
        telah dipublikasikan melalui Sistem Pengumuman Akademik Online.
    </p>

      <!-- TABEL (STRUKTUR IDENTIK) -->
      <table width='100%' cellpadding='10' cellspacing='0'
             style='border-collapse:collapse;font-size:14px;margin:14px 0'>

        <tr>
          <td style='border:1px solid #e5e7eb;font-weight:700'>Jurusan</td>
          <td style='border:1px solid #e5e7eb'>{$data['jurusan']}</td>
        </tr>
        <tr>
          <td style='border:1px solid #e5e7eb;font-weight:700'>Program Studi</td>
          <td style='border:1px solid #e5e7eb'>{$data['prodi']}</td>
        </tr>
        <tr>
          <td style='border:1px solid #e5e7eb;font-weight:700'>Mata Kuliah</td>
          <td style='border:1px solid #e5e7eb'>{$data['mata_kuliah']}</td>
        </tr>
        <tr>
          <td style='border:1px solid #e5e7eb;font-weight:700'>Dosen</td>
          <td style='border:1px solid #e5e7eb'>{$data['dosen']}</td>
        </tr>
        <tr>
          <td style='border:1px solid #e5e7eb;font-weight:700'>Kelas</td>
          <td style='border:1px solid #e5e7eb'>
            {$data['kelas']} ({$data['shift']})
          </td>
        </tr>
        <tr>
          <td style='border:1px solid #e5e7eb;font-weight:700'>Semester</td>
          <td style='border:1px solid #e5e7eb'>{$data['semester']}</td>
        </tr>
        <tr>
          <td style='border:1px solid #e5e7eb;font-weight:700'>Kelas Asal</td>
          <td style='border:1px solid #e5e7eb'>{$data['kelas_asal']}</td>
        </tr>
        <tr>
          <td style='border:1px solid #e5e7eb;font-weight:700'>Kelas Baru</td>
          <td style='border:1px solid #e5e7eb;color:#16a34a;font-weight:700'>
            {$data['kelas_baru']}
          </td>
        </tr>
        <tr>
          <td style='border:1px solid #e5e7eb;font-weight:700'>Status</td>
          <td style='border:1px solid #e5e7eb;color:#16a34a;font-weight:700'>
            Telah Diperbarui
          </td>
        </tr>
      </table>

      <p>
        Mahasiswa diharapkan memperhatikan kembali jadwal perubahan kelas
        sesuai dengan kelas terbaru.
      </p>

      <!-- BUTTON (SAMA) -->
      <a href='{$data['link']}'
         style='display:inline-block;margin-top:6px;padding:10px 18px;
                background:#1e3a8a;color:#fff;text-decoration:none;
                border-radius:10px;font-weight:700'>
         Akses Pengumuman Akademik
      </a>

      <p style='margin-top:18px'>
        Hormat kami,<br>
        <strong>Bagian Akademik</strong><br>
        <strong>Politeknik Negeri Batam</strong>
      </p>
    </div>

    <!-- FOOTER (SAMA) -->
    <div style='background:#f9fafb;color:#6b7280;
                padding:10px 20px;font-size:12px'>
     Email ini dikirim otomatis oleh Sistem Pengumuman Akademik Online.
      Mohon tidak membalas email ini.
    </div>

  </div>
</div>
";
}

<?php
function emailPengumumanCard($data)
{
    return "
<div style='font-family:Arial,Helvetica,sans-serif;color:#111827'>
  <div style='max-width:620px;margin:auto;
              border:1px solid #e5e7eb;
              border-radius:14px;
              overflow:hidden'>

    <!-- HEADER -->
    <div style='background:#1e3a8a;color:#fff;padding:16px 20px'>
      <div style='font-size:18px;font-weight:700'>
        Pemberitahuan Akademik
      </div>
      <div style='opacity:.9'>
        Informasi Pengumuman
      </div>
    </div>

    <!-- BODY -->
    <div style='padding:18px 20px'>
      <p>Yth. Mahasiswa/i,</p>

      <p>
        Dengan hormat, kami sampaikan <strong>pengumuman akademik</strong>
        berikut melalui Sistem Pengumuman Akademik Online:
      </p>

      <!-- TABLE (RINGKAS & FORMAL) -->
      <table width='100%' cellpadding='10' cellspacing='0'
             style='border-collapse:collapse;
                    font-size:14px;
                    margin:14px 0'>

        <tr>
          <td style='border:1px solid #e5e7eb;font-weight:700'>
            Judul Pengumuman
          </td>
          <td style='border:1px solid #e5e7eb'>
            {$data['judul']}
          </td>
        </tr>

        <tr>
          <td style='border:1px solid #e5e7eb;font-weight:700'>
            Kategori
          </td>
          <td style='border:1px solid #e5e7eb'>
            {$data['kategori']}
          </td>
        </tr>

        <tr>
          <td style='border:1px solid #e5e7eb;font-weight:700'>
            Tanggal Publikasi
          </td>
          <td style='border:1px solid #e5e7eb'>
            {$data['tanggal']}
          </td>
        </tr>
      </table>

      <p>
        <strong>Ringkasan Pengumuman:</strong><br>
        {$data['isi']}
      </p>

      <!-- BUTTON -->
      <a href='{$data['link']}'
         style='display:inline-block;
                margin-top:6px;
                padding:10px 18px;
                background:#1e3a8a;
                color:#fff;
                text-decoration:none;
                border-radius:10px;
                font-weight:700'>
        Lihat Detail Pengumuman
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
}

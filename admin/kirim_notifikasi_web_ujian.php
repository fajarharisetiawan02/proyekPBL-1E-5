<?php
function kirimNotifWebUjian(
    $koneksi,
    $jenis_ujian,
    $mata_kuliah,
    $tanggal,
    $waktu_mulai,
    $waktu_selesai,
    $ruang,
    $jurusan = null,
    $prodi   = null,
    $kelas   = null,
    $shift   = null,
    $semester = null
) {

    /* ===============================
       NOTIFIKASI ADMIN
    ================================ */
    $isiAdmin = "
        Jadwal <b>$jenis_ujian</b> untuk mata kuliah
        <b>$mata_kuliah</b> berhasil ditambahkan.
    ";

    mysqli_query($koneksi, "
        INSERT INTO notifikasi
        (judul, isi, role, tanggal, status, is_read)
        VALUES
        (
            'Jadwal Ujian Ditambahkan',
            '$isiAdmin',
            'admin',
            NOW(),
            'aktif',
            0
        )
    ");

    /* ===============================
       NOTIFIKASI MAHASISWA
    ================================ */
    $isiMhs = "
        <b>$jenis_ujian</b> mata kuliah <b>$mata_kuliah</b><br>
        Tanggal: ".date('d M Y', strtotime($tanggal))."<br>
        Waktu: $waktu_mulai – $waktu_selesai<br>
        Ruang: $ruang
    ";

    mysqli_query($koneksi, "
        INSERT INTO notifikasi
        (judul, isi, role, jurusan, prodi, kelas, shift, semester, tanggal, status, is_read)
        VALUES
        (
            'Informasi Jadwal Ujian',
            '$isiMhs',
            'mahasiswa',
            ".($jurusan ? "'$jurusan'" : "NULL").",
            ".($prodi   ? "'$prodi'"   : "NULL").",
            ".($kelas   ? "'$kelas'"   : "NULL").",
            ".($shift   ? "'$shift'"   : "NULL").",
            ".($semester? "'$semester'": "NULL").",
            NOW(),
            'aktif',
            0
        )
    ");
}

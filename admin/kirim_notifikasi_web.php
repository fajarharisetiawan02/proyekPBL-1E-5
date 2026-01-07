<?php
function kirimNotifWebBeasiswa(
    $koneksi,
    $nama_beasiswa,
    $periode,
    $tanggal_buka,
    $tanggal_tutup
) {

    /* ========= NOTIFIKASI ADMIN ========= */
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

    /* ========= NOTIFIKASI MAHASISWA ========= */
    $isiMhs = "
        Beasiswa <b>$nama_beasiswa</b> telah dibuka.<br>
        Periode: $periode<br>
        Pendaftaran: ".date('d M Y', strtotime($tanggal_buka))."
        s/d ".date('d M Y', strtotime($tanggal_tutup))."
    ";

    mysqli_query($koneksi, "
        INSERT INTO notifikasi
        (judul, isi, role, jurusan, prodi, kelas, shift, semester, tanggal, status, is_read)
        VALUES
        (
            'Beasiswa Baru Dibuka',
            '$isiMhs',
            'mahasiswa',
            NULL,NULL,NULL,NULL,NULL,
            NOW(),
            'aktif',
            0
        )
    ");
}

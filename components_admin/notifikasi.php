<?php
$id_login = $_SESSION['id_login'];

// AMBIL NOTIFIKASI ADMIN
$notif = mysqli_query($koneksi, "
    SELECT * FROM notifikasi
    WHERE role = 'admin'
    AND status = 'aktif'
    ORDER BY tanggal DESC
    LIMIT 6
");

// HITUNG YANG BELUM DIBACA
$jumlah_notif = mysqli_num_rows(mysqli_query($koneksi, "
    SELECT id_notifikasi FROM notifikasi
    WHERE role='admin'
    AND status='aktif'
    AND is_read=0
"));
?>

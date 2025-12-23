<?php
require_once "../config/auth_mahasiswa.php";
require_once "../config/koneksi.php";

$id_login = $_SESSION['id_login'];

$notifikasi = mysqli_query($koneksi, "
    SELECT *
    FROM notifikasi
    WHERE role = 'mahasiswa'
    ORDER BY tanggal DESC
");

if (!$notifikasi) {
    die("Query error: " . mysqli_error($koneksi));
}

$jumlah = mysqli_num_rows($notifikasi);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Semua Notifikasi</title>

    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/style3.css">
    <link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

    <div class="main-wrapper">

        <?php include "../components_mahasiswa/sidebar.php"; ?>
        <?php include "../components_mahasiswa/topbar.php"; ?>

        <div class="main-content">
            <div class="content-container">

                <div class="notif-hero">
                    <div class="notif-hero-left">
                        <div class="notif-hero-icon">
                            <i class="fa-solid fa-bell"></i>
                        </div>
                        <div class="notif-hero-text">
                            <h2>Semua Notifikasi</h2>
                            <p>Riwayat aktivitas akademik terbaru</p>
                        </div>
                    </div>

                    <div class="notif-hero-right">
                        <span class="notif-count">
                            <?= mysqli_num_rows($notifikasi); ?> Notifikasi
                        </span>
                    </div>
                </div>

                <div class="notif-list">

                    <?php if (mysqli_num_rows($notifikasi) > 0): ?>
                    <?php while ($n = mysqli_fetch_assoc($notifikasi)): ?>
                    <div class="notif-card <?= $n['status'] === 'aktif' ? 'unread' : 'read'; ?>">

                        <div class="notif-icon">
                            <i class="fa-solid fa-bell"></i>
                        </div>

                        <div class="notif-content">
                            <h4><?= htmlspecialchars($n['judul']); ?></h4>
                            <p><?= htmlspecialchars($n['isi']); ?></p>

                            <div class="notif-meta">
                                <span>
                                    <i class="fa-regular fa-clock"></i>
                                    <?= date('d M Y · H:i', strtotime($n['tanggal'])); ?>
                                </span>

                                <?php if ($n['status'] === 'aktif'): ?>
                                <span class="badge-new">BARU</span>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                    <?php endwhile; ?>
                    <?php else: ?>
                    <div class="notif-empty">
                        <i class="fa-regular fa-bell-slash"></i>
                        <p>Tidak ada notifikasi</p>
                    </div>
                    <?php endif; ?>

                </div>

            </div>
        </div>

    </div>

    <footer>
        © 2025 Aplikasi Pengumuman Akademik Online | Politeknik Negeri Batam
    </footer>

</body>

</html>

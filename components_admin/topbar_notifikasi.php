<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once "../config/koneksi.php";

$id_login = $_SESSION['id_login'];

$qUser = mysqli_query($koneksi,"
    SELECT last_notif_read FROM login WHERE id_login='$id_login'
");
$user = mysqli_fetch_assoc($qUser);
$last_read = $user['last_notif_read'] ?? '1970-01-01 00:00:00';

$qJumlah = mysqli_query($koneksi,"
    SELECT id_notifikasi FROM notifikasi
    WHERE role='admin' AND tanggal > '$last_read'
");
$jumlah_notif = mysqli_num_rows($qJumlah);

$notif = mysqli_query($koneksi,"
    SELECT * FROM notifikasi
    WHERE role='admin'
    ORDER BY tanggal DESC
    LIMIT 6
");
?>

<div class="notif-wrapper">
    <button class="notif-btn" id="notifBtn">
        <i class="fa-solid fa-bell"></i>
        <?php if ($jumlah_notif > 0): ?>
            <span class="notif-badge"><?= $jumlah_notif ?></span>
        <?php endif; ?>
    </button>

    <div class="notif-dropdown" id="notifDropdown">
        <div class="notif-header">
            <i class="fa-solid fa-graduation-cap"></i>
            <span>Notifikasi</span>
        </div>

        <div class="notif-body">
            <?php if (mysqli_num_rows($notif) == 0): ?>
                <div class="notif-empty">Tidak ada notifikasi</div>
            <?php endif; ?>

            <?php while ($n = mysqli_fetch_assoc($notif)): ?>
            <div class="notif-item unread">
                <div class="notif-icon">
                    <i class="fa-solid fa-circle-exclamation"></i>
                </div>
                <div class="notif-content">
                    <strong><?= htmlspecialchars($n['judul']) ?></strong>
                    <p><?= substr(strip_tags($n['isi']),0,70) ?>...</p>
                    <span><?= date('d M Y • H:i', strtotime($n['tanggal'])) ?></span>
                </div>
            </div>
            <?php endwhile; ?>
        </div>

        <a href="../admin/notifikasi.php" class="notif-footer">
            Lihat Semua Notifikasi
        </a>
    </div>
</div>

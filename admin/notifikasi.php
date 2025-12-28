<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";

/* ===== TANDAI SUDAH DIBACA ===== */
if (isset($_GET['read'])) {
    $id = (int) $_GET['read'];
    mysqli_query($koneksi, "
        UPDATE notifikasi 
        SET is_read = 1 
        WHERE id_notifikasi = '$id'
    ");
    header("Location: notifikasi.php");
    exit;
}

/* ===== AMBIL NOTIFIKASI ===== */
$notifikasi = mysqli_query($koneksi, "
    SELECT * FROM notifikasi
    WHERE role='admin'
    ORDER BY tanggal DESC
");
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

<style>
/* ===== NOTIFIKASI TIMELINE ===== */
.notif-timeline{
    border-left: 2px solid #e5e7eb;
    padding-left: 25px;
}
.notif-item{
    position: relative;
    background: #fff;
    padding: 18px 20px;
    border-radius: 14px;
    margin-bottom: 18px;
    box-shadow: 0 4px 14px rgba(0,0,0,.05);
    transition: .25s;
}
.notif-item:hover{
    transform: translateY(-2px);
}
.notif-dot{
    position: absolute;
    left: -33px;
    top: 22px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: #c7cdd8;
}
.notif-item.unread .notif-dot{
    background: #2563eb;
}
.notif-title{
    font-weight: 600;
    margin-bottom: 4px;
}
.notif-time{
    font-size: 12px;
    color: #6b7280;
    margin-top: 6px;
    display: flex;
    align-items: center;
    gap: 6px;
}
.badge-new{
    background: #ef4444;
    color: #fff;
    font-size: 11px;
    padding: 3px 8px;
    border-radius: 999px;
    margin-left: 8px;
}
.notif-link{
    text-decoration: none;
    color: inherit;
    display: block;
}
.notif-item.unread{
    background:#f0f6ff;
}

</style>
</head>

<body>
<div class="main-wrapper">

<?php include "../components_admin/sidebar.php"; ?>
<?php include "../components_admin/topbar.php"; ?>

<div class="main-content">
<div class="content-container">

<h2>Semua Notifikasi</h2>
<p class="page-desc">Riwayat aktivitas akademik terbaru</p>

<div class="notif-timeline">

<?php if (mysqli_num_rows($notifikasi) > 0): ?>
<?php while ($n = mysqli_fetch_assoc($notifikasi)): ?>
<a href="?read=<?= $n['id_notifikasi']; ?>" class="notif-link">
<div class="notif-item <?= $n['is_read']==0 ? 'unread' : ''; ?>">

    <span class="notif-dot"></span>

    <div class="notif-title">
        <?= htmlspecialchars($n['judul']); ?>
        <?php if ($n['is_read']==0): ?>
            <span class="badge-new">BARU</span>
        <?php endif; ?>
    </div>

    <div class="notif-desc">
        <?= htmlspecialchars($n['isi']); ?>
    </div>

    <div class="notif-time">
        <i class="fa-regular fa-clock"></i>
        <?= date('d M Y · H:i', strtotime($n['tanggal'])); ?>
    </div>

</div>
</a>
<?php endwhile; ?>

<?php else: ?>
<p>Tidak ada notifikasi.</p>
<?php endif; ?>

</div>

</div>
</div>
</div>

<footer>
© 2025 Aplikasi Pengumuman Akademik Online | Politeknik Negeri Batam
</footer>

<script src="../assets/js/script3.js"></script>
</body>
</html>

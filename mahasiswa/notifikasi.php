<?php
require_once "../config/auth_mahasiswa.php";
require_once "../config/koneksi.php";

/* ===== DATA MAHASISWA DARI SESSION ===== */
$prodi = $_SESSION['prodi'];
$kelas = $_SESSION['kelas'];
$shift = $_SESSION['shift'];

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

/* ===== AMBIL NOTIFIKASI (FILTERED) ===== */
$notifikasi = mysqli_query($koneksi, "
    SELECT *
    FROM notifikasi
    WHERE role = 'mahasiswa'
      AND status = 'aktif'
      AND prodi = '$prodi'
      AND kelas = '$kelas'
      AND shift = '$shift'
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

    <!-- HERO -->
    <div class="notif-hero">
        <div class="notif-hero-left">
            <div class="notif-hero-icon">
                <i class="fa-solid fa-bell"></i>
            </div>
            <div class="notif-hero-text">
                <h2>Notifikasi</h2>
                <p>
                    <?= htmlspecialchars($prodi); ?> ·
                    Kelas <?= htmlspecialchars($kelas); ?> ·
                    <?= htmlspecialchars($shift); ?>
                </p>
            </div>
        </div>

        <div class="notif-hero-right">
            <span class="notif-count">
                <?= $jumlah; ?> Notifikasi
            </span>
        </div>
    </div>

    <!-- LIST -->
    <div class="notif-list">

    <?php if ($jumlah > 0): ?>
        <?php while ($n = mysqli_fetch_assoc($notifikasi)): ?>
        <a href="?read=<?= $n['id_notifikasi']; ?>" class="notif-link">

        <div class="notif-card <?= $n['is_read'] == 0 ? 'unread' : 'read'; ?>">

            <div class="notif-icon">
                <i class="fa-solid fa-bell"></i>
            </div>

            <div class="notif-content">
                <h4>
                    <?= htmlspecialchars($n['judul']); ?>
                    <?php if ($n['is_read'] == 0): ?>
                        <span class="badge-new">BARU</span>
                    <?php endif; ?>
                </h4>

                <p><?= nl2br(htmlspecialchars($n['isi'])); ?></p>

                <div class="notif-meta">
                    <span>
                        <i class="fa-regular fa-clock"></i>
                        <?= date('d M Y · H:i', strtotime($n['tanggal'])); ?>
                    </span>
                </div>
            </div>

        </div>
        </a>
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

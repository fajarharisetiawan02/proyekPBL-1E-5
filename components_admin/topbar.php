<?php
// ===============================
// SESSION & BASIC SAFETY
// ===============================
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
<<<<<<< HEAD

require_once "../config/koneksi.php";

// ===============================
// SESSION DATA (AMAN PHP 8)
// ===============================
$id_login = $_SESSION['id_login'] ?? null;
$nama     = $_SESSION['nama'] ?? 'Admin';
$nim      = $_SESSION['username'] ?? '-';

// Inisial aman walau nama kosong
$inisial  = strtoupper(substr($nama ?: 'A', 0, 1));

// ===============================
// NOTIFIKASI ADMIN
// ===============================
$last_read = '1970-01-01 00:00:00';

if ($id_login) {
    $qUser = mysqli_query($koneksi, "
        SELECT last_notif_read 
        FROM login 
        WHERE id_login = '$id_login'
    ");

    if ($qUser) {
        $user = mysqli_fetch_assoc($qUser);
        $last_read = $user['last_notif_read'] ?? $last_read;
    }
}

// Hitung notifikasi belum dibaca
$qJumlah = mysqli_query($koneksi, "
    SELECT id_notifikasi 
    FROM notifikasi
    WHERE role = 'admin'
    AND tanggal > '$last_read'
");

$jumlah_notif = $qJumlah ? mysqli_num_rows($qJumlah) : 0;

// Ambil notifikasi terbaru
$notif_admin = mysqli_query($koneksi, "
    SELECT * FROM notifikasi
    WHERE role = 'admin'
    AND tanggal > '$last_read'
    ORDER BY tanggal DESC
    LIMIT 5
");
=======

include "../config/koneksi.php";

/* =========================
   PROTEKSI LOGIN
========================= */
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}

/* =========================
   DATA USER LOGIN
========================= */
$nama = $_SESSION['nama'] ?? 'User';
$nim  = $_SESSION['username'];
$role = $_SESSION['role'] ?? 'mahasiswa';

/* Inisial nama */
$inisial = strtoupper(substr($nama, 0, 1));

/* =========================
   NOTIFIKASI (ADMIN / ALL)
========================= */
$notif_admin = mysqli_query($koneksi, "
    SELECT * FROM notifikasi
    WHERE status='aktif'
    AND role IN ('$role','all')
    ORDER BY tanggal DESC
    LIMIT 5
");

$jumlah_notif = mysqli_num_rows($notif_admin);

/* =========================
   LINK PROFIL BERDASARKAN ROLE
========================= */
$link_profil = ($role === 'admin')
    ? "../admin/profil_admin.php"
    : "../mahasiswa/profil_mahasiswa.php";
>>>>>>> 3cdbf79c7137e21f59cd2a8c7e5656cb38e4e55b
?>

<!-- =============================== -->
<!-- TOPBAR -->
<!-- =============================== -->
<div class="topbar">

    <!-- Toggle Sidebar -->
    <i class="fa-solid fa-bars" id="menu-toggle"></i>

    <!-- Search -->
    <div class="search-box">
        <input type="text" placeholder="Search...">
        <i class="fa-solid fa-search"></i>
    </div>

    <!-- Right Icons -->
    <div class="header-icons">

        <!-- NOTIFIKASI -->
<<<<<<< HEAD
        <div class="notif-wrapper">
            <button class="notif-btn" id="notifBtn">
                <i class="fa-solid fa-bell"></i>
                <?php if ($jumlah_notif > 0): ?>
                    <span class="notif-badge"><?= $jumlah_notif; ?></span>
                <?php endif; ?>
            </button>

            <div class="notif-dropdown" id="notifDropdown">
                <h4>Notifikasi</h4>

                <?php if ($notif_admin && mysqli_num_rows($notif_admin) > 0): ?>
                    <ul class="notif-list">
                        <?php while ($n = mysqli_fetch_assoc($notif_admin)): ?>
                            <li class="unread">
                                <strong><?= htmlspecialchars($n['judul']); ?></strong><br>
                                <small><?= date('d M Y H:i', strtotime($n['tanggal'])); ?></small>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php else: ?>
                    <div class="notif-empty">Tidak ada notifikasi</div>
                <?php endif; ?>

                <a href="../admin/notifikasi.php" class="notif-link">Lihat Semua</a>
            </div>
        </div>

        <!-- PROFILE -->
=======
<div class="notif-wrapper" id="notifWrapper">
    <button id="notifBtn" class="notif-btn">
        <i class="fa-solid fa-bell"></i>
        <?php if ($jumlah_notif > 0): ?>
            <span class="notif-badge"><?= $jumlah_notif; ?></span>
        <?php endif; ?>
    </button>

    <div class="notif-dropdown" id="notifDropdown">
        <h4>Notifikasi</h4>

        <?php if ($jumlah_notif > 0): ?>
            <ul>
                <?php while ($n = mysqli_fetch_assoc($notif_admin)): ?>
                    <li>
                        <strong><?= htmlspecialchars($n['judul']); ?></strong>
                        <br>
                        <small><?= date('d M Y', strtotime($n['tanggal'])); ?></small>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <div class="notif-empty">Tidak ada notifikasi</div>
        <?php endif; ?>

        <a href="../notifikasi.php" class="notif-link">Lihat Semua</a>
    </div>
</div>


        <!-- PROFIL -->
>>>>>>> 3cdbf79c7137e21f59cd2a8c7e5656cb38e4e55b
        <div class="profile-dropdown">
            <div class="profile-info" id="profileIcon">
                <div class="profile-avatar"><?= htmlspecialchars($inisial); ?></div>

                <div class="profile-text">
                    <span class="profile-name"><?= htmlspecialchars($nama); ?></span>
                    <span class="profile-nim"><?= htmlspecialchars($nim); ?></span>
                </div>
            </div>

            <div class="dropdown-menu" id="dropdownMenu">
<<<<<<< HEAD
                <a href="../admin/profil_admin.php">
=======
                <a href="<?= $link_profil; ?>">
>>>>>>> 3cdbf79c7137e21f59cd2a8c7e5656cb38e4e55b
                    <i class="fa-solid fa-id-card"></i> Profil
                </a>
                <a href="../ubah_sandi.php">
                    <i class="fa-solid fa-key"></i> Ubah Kata Sandi
                </a>
                <a href="../logout.php">
                    <i class="fa-solid fa-right-from-bracket"></i> Keluar
                </a>
            </div>
        </div>

    </div>
</div>

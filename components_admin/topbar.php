<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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
?>

<div class="topbar">
    <i class="fa-solid fa-bars" id="menu-toggle"></i>

    <div class="search-box">
        <input type="text" placeholder="Search">
        <i class="fa-solid fa-search"></i>
    </div>

    <div class="header-icons">

        <!-- NOTIFIKASI -->
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
        <div class="profile-dropdown">
            <div class="profile-info" id="profileIcon">
                <div class="profile-avatar"><?= $inisial; ?></div>

                <div class="profile-text">
                    <span class="profile-name"><?= htmlspecialchars($nama); ?></span>
                    <span class="profile-nim"><?= htmlspecialchars($nim); ?></span>
                </div>
            </div>

            <div class="dropdown-menu" id="dropdownMenu">
                <a href="<?= $link_profil; ?>">
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

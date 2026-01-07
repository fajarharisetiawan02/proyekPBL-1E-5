<?php
// ===============================
// SESSION & BASIC SAFETY
// ===============================
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "../config/koneksi.php";

<<<<<<< HEAD
/* ===============================
   WAJIB LOGIN ADMIN / DOSEN
================================ */
if (empty($_SESSION['id_admin'])) {
    header("Location: ../login.php");
    exit;
}

/* ===============================
   DATA ADMIN
================================ */
$nama = $_SESSION['nama'] ?? 'Dosen';
$nidn = $_SESSION['nidn'] ?? '-';
$inisial = strtoupper(substr($nama, 0, 1));

/* ===============================
   HITUNG NOTIFIKASI BELUM DIBACA
================================ */
$qJumlah = mysqli_query($koneksi, "
    SELECT COUNT(*) total
    FROM notifikasi
    WHERE role = 'admin'
      AND status = 'aktif'
      AND (is_read = 0 OR is_read IS NULL)
");
$jumlah_notif = mysqli_fetch_assoc($qJumlah)['total'] ?? 0;

/* ===============================
   LIST NOTIFIKASI (TOP 5)
================================ */
$notif = mysqli_query($koneksi, "
    SELECT *
    FROM notifikasi
    WHERE role = 'admin'
      AND status = 'aktif'
=======
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
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
    ORDER BY tanggal DESC
    LIMIT 5
");
?>
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======

>>>>>>> 9a567987dd90af1392f8d15dfcbd79423ecb4815
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
<!-- =============================== -->
<!-- TOPBAR -->
<!-- =============================== -->
<div class="topbar">
<<<<<<< HEAD

    <i class="fa-solid fa-bars" id="menu-toggle"></i>
=======

    <!-- Toggle Sidebar -->
    <i class="fa-solid fa-bars" id="menu-toggle"></i>

<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
    <!-- Search -->
    <div class="search-box">
        <input type="text" placeholder="Search...">
        <i class="fa-solid fa-search"></i>
    </div>
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717

>>>>>>> 9a567987dd90af1392f8d15dfcbd79423ecb4815
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
    <!-- Right Icons -->
    <div class="header-icons">

        <!-- NOTIFIKASI -->
        <div class="notif-wrapper">
<<<<<<< HEAD
            <div class="notif-btn" id="notifBtn">
                <i class="fa-solid fa-bell"></i>
                <?php if ($jumlah_notif > 0): ?>
                    <span class="notif-badge" id="notifBadge"><?= $jumlah_notif ?></span>
                <?php endif; ?>
            </div>

            <div class="notif-dropdown" id="notifDropdown">
                <div class="notif-header">
                    <strong>Notifikasi</strong>
                </div>

                <div class="notif-body" id="notifBody">
                    <?php if ($notif && mysqli_num_rows($notif) > 0): ?>
                        <?php while ($n = mysqli_fetch_assoc($notif)): ?>
                            <div class="notif-item <?= ($n['is_read']==0 || $n['is_read']===null) ? 'unread' : '' ?>"
                                 data-id="<?= $n['id_notifikasi'] ?>"
                                 onclick="readNotifTopbar(this)">

                                <div class="notif-content">
                                    <strong><?= htmlspecialchars($n['judul']) ?></strong>
                                    <p><?= htmlspecialchars(mb_substr(strip_tags($n['isi']),0,60)) ?>...</p>
                                    <small><?= date('d M Y H:i', strtotime($n['tanggal'])) ?></small>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <div class="notif-empty">Tidak ada notifikasi</div>
                    <?php endif; ?>
                </div>

                <a href="../admin/notifikasi.php" class="notif-footer">
                    Lihat Semua
                </a>
=======
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
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
            </div>
        </div>

        <!-- PROFILE -->
        <div class="profile-dropdown">
            <div class="profile-info" id="profileIcon">
<<<<<<< HEAD
                <div class="profile-avatar"><?= $inisial ?></div>
                <div class="profile-text">
                    <span class="profile-name"><?= htmlspecialchars($nama) ?></span>
                    <span class="profile-nim"><?= htmlspecialchars($nidn) ?></span>
=======
                <div class="profile-avatar"><?= htmlspecialchars($inisial); ?></div>

                <div class="profile-text">
                    <span class="profile-name"><?= htmlspecialchars($nama); ?></span>
                    <span class="profile-nim"><?= htmlspecialchars($nim); ?></span>
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
                </div>
            </div>

            <div class="dropdown-menu" id="dropdownMenu">
<<<<<<< HEAD
                <a href="../admin/profil_dosen.php">
=======
                <a href="../admin/profil_admin.php">
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
                    <i class="fa-solid fa-id-card"></i> Profil
                </a>
                <a href="../admin/ubah_sandi.php">
                    <i class="fa-solid fa-key"></i> Ubah Kata Sandi
                </a>
                <a href="../logout.php">
                    <i class="fa-solid fa-right-from-bracket"></i> Keluar
                </a>
            </div>
        </div>

    </div>
</div>

<script>
function readNotifTopbar(el) {
    if (!el.classList.contains('unread')) return;

    const id = el.dataset.id;
    const badge = document.getElementById('notifBadge');

    fetch('../admin/notif_ajax.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'action=read_one&id=' + id
    })
    .then(r => r.text())
    .then(r => {
        if (r === 'ok') {
            el.classList.remove('unread');

            if (badge) {
                let count = parseInt(badge.innerText);
                count--;
                if (count <= 0) badge.remove();
                else badge.innerText = count;
            }
        }
    });
}
</script>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "../config/koneksi.php";

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
    ORDER BY tanggal DESC
    LIMIT 5
");
?>

<div class="topbar">

    <i class="fa-solid fa-bars" id="menu-toggle"></i>

    <div class="header-icons">

        <!-- NOTIFIKASI -->
        <div class="notif-wrapper">
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
            </div>
        </div>

        <!-- PROFILE -->
        <div class="profile-dropdown">
            <div class="profile-info" id="profileIcon">
                <div class="profile-avatar"><?= $inisial ?></div>
                <div class="profile-text">
                    <span class="profile-name"><?= htmlspecialchars($nama) ?></span>
                    <span class="profile-nim"><?= htmlspecialchars($nidn) ?></span>
                </div>
            </div>

            <div class="dropdown-menu" id="dropdownMenu">
                <a href="../admin/profil_dosen.php">
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

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once "../config/koneksi.php";

<<<<<<< HEAD
/* ===============================
   WAJIB LOGIN MAHASISWA
================================ */
if (empty($_SESSION['id_login'])) {
    header("Location: ../login.php");
    exit;
}

$nama    = $_SESSION['nama'] ?? 'Mahasiswa';
$nim     = $_SESSION['username'] ?? '-';
$inisial = strtoupper(substr($nama ?: 'M', 0, 1));

/* ===============================
   HITUNG NOTIF BELUM DIBACA
================================ */
$qJumlah = mysqli_query($koneksi, "
    SELECT COUNT(*) total
    FROM notifikasi
    WHERE role='mahasiswa'
      AND status='aktif'
      AND (is_read=0 OR is_read IS NULL)
");
$jumlah_notif = mysqli_fetch_assoc($qJumlah)['total'] ?? 0;

/* ===============================
   LIST NOTIF TERBARU (TOP 6)
================================ */
$notif_mhs = mysqli_query($koneksi, "
    SELECT *
    FROM notifikasi
    WHERE role='mahasiswa'
      AND status='aktif'
    ORDER BY tanggal DESC
    LIMIT 6
");
=======
require_once "../config/koneksi.php";

$notif_mahasiswa = mysqli_query($koneksi, "
    SELECT *
    FROM notifikasi
    WHERE role = 'mahasiswa'
      AND status = 'aktif'
    ORDER BY tanggal DESC
    LIMIT 5
");

$jumlah_notif = mysqli_num_rows($notif_mahasiswa);

$nama = $_SESSION['nama'];
$nim  = $_SESSION['username'];
$inisial = strtoupper(substr($nama, 0, 1));
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
?>



<div class="topbar">

    <i class="fa-solid fa-bars" id="menu-toggle"></i>

    <div class="header-icons">

<<<<<<< HEAD
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
                    <i class="fa-solid fa-envelope"></i>
                    <span>Notifikasi</span>
                </div>

                <div class="notif-body" id="notifBody">
                <?php if ($notif_mhs && mysqli_num_rows($notif_mhs) > 0): ?>
                    <?php while ($n = mysqli_fetch_assoc($notif_mhs)): ?>
                        <div class="notif-item <?= ($n['is_read']==0 || $n['is_read']===null) ? 'unread' : 'read' ?>"
                             data-id="<?= $n['id_notifikasi'] ?>"
                             onclick="readNotifMhs(this)">

                            <div class="notif-icon">
                                <i class="fa-solid fa-circle-info"></i>
                            </div>

                            <div class="notif-content">
                                <div class="notif-title">
                                    <strong><?= htmlspecialchars($n['judul']) ?></strong>
                                    <?php if ($n['is_read']==0 || $n['is_read']===null): ?>
                                        <span class="badge-new">BARU</span>
                                    <?php endif; ?>
                                </div>

                                <p><?= htmlspecialchars(mb_substr(strip_tags($n['isi']),0,70)) ?>...</p>
                                <span class="notif-time">
                                    <?= date('d M Y • H:i', strtotime($n['tanggal'])) ?>
                                </span>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="notif-empty">Tidak ada notifikasi</div>
                <?php endif; ?>
                </div>

                <a href="../mahasiswa/notifikasi.php" class="notif-footer">
                    Lihat Semua Notifikasi
                </a>
            </div>
        </div>

        <!-- PROFILE -->
        <div class="profile-dropdown">
            <div class="profile-info" id="profileIcon">
                <div class="profile-avatar"><?= htmlspecialchars($inisial); ?></div>

                <div class="profile-text">
                    <span class="profile-name"><?= htmlspecialchars($nama); ?></span>
                    <span class="profile-nim"><?= htmlspecialchars($nim); ?></span>
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
        <!-- NOTIFIKASI -->
        <div class="notif-wrapper">
            <button class="notif-btn" id="notifBtn">
                <i class="fa-solid fa-bell"></i>
                <?php if ($jumlah_notif > 0): ?>
                    <span class="notif-badge"><?= $jumlah_notif ?></span>
                <?php endif; ?>
            </button>
<<<<<<< HEAD

=======
=======
<div class="notif-wrapper">
    <button class="notif-btn" id="notifBtn">
        <i class="fa-solid fa-bell"></i>
        <?php if ($jumlah_notif > 0): ?>
            <span class="notif-badge"><?= $jumlah_notif ?></span>
        <?php endif; ?>
    </button>

    <div class="notif-dropdown" id="notifDropdown">
        <h4>Notifikasi</h4>

        <?php if ($jumlah_notif > 0): ?>
            <ul class="notif-list">
                <?php while ($n = mysqli_fetch_assoc($notif_mahasiswa)): ?>
                    <li class="unread">
                        <strong><?= htmlspecialchars($n['judul']) ?></strong><br>
                        <small><?= date('d M Y H:i', strtotime($n['tanggal'])) ?></small>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <div class="notif-empty">Tidak ada notifikasi</div>
        <?php endif; ?>

        <a href="../mahasiswa/notifikasi.php" class="notif-link">Lihat Semua</a>
    </div>
</div>

>>>>>>> 9a567987dd90af1392f8d15dfcbd79423ecb4815

>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
            <div class="notif-dropdown notifikasi-dropdown" id="notifDropdown">
                <h4>Notifikasi</h4>

                <?php if ($jumlah_notif > 0): ?>
                    <ul class="notif-list">
                        <?php while ($n = mysqli_fetch_assoc($notif_mahasiswa)): ?>
                            <li class="notif-item unread">
                                <strong><?= htmlspecialchars($n['judul']) ?></strong>
                                <small><?= date('d M Y H:i', strtotime($n['tanggal'])) ?></small>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php else: ?>
                    <div class="notif-empty">Tidak ada notifikasi</div>
                <?php endif; ?>

                <a href="../mahasiswa/notifikasi.php" class="notif-link">Lihat Semua</a>
            </div>
        </div>

        <!-- PROFIL -->
        <div class="profile-dropdown">
            <div class="profile-info" id="profileIcon">
                <div class="profile-avatar"><?= $inisial ?></div>
                <div class="profile-text">
                    <span class="profile-name"><?= $nama ?></span>
                    <span class="profile-nim"><?= $nim ?></span>
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
                </div>
            </div>

            <div class="dropdown-menu" id="dropdownMenu">
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======

>>>>>>> 9a567987dd90af1392f8d15dfcbd79423ecb4815
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
                <a href="../mahasiswa/profil_mahasiswa.php">
                    <i class="fa-solid fa-id-card"></i> Profil
                </a>
                <a href="../mahasiswa/ubah_sandi.php">
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
function readNotifMhs(el) {
    if (!el.classList.contains('unread')) return;

    const id = el.dataset.id;
    const badge = document.getElementById('notifBadge');

    fetch('notif_ajax.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'action=read_one&id=' + id
    })
    .then(r => r.text())
    .then(r => {
        if (r === 'ok') {
            el.classList.remove('unread');

            const b = el.querySelector('.badge-new');
            if (b) b.remove();

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

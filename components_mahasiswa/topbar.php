<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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
?>



<div class="topbar">
    <i class="fa-solid fa-bars" id="menu-toggle"></i>

    <div class="search-box">
        <input type="text" placeholder="Search">
        <i class="fa-solid fa-search"></i>
    </div>

    <div class="header-icons">

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
                </div>
            </div>

            <div class="dropdown-menu" id="dropdownMenu">
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======

>>>>>>> 9a567987dd90af1392f8d15dfcbd79423ecb4815
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
                <a href="../mahasiswa/profil_mahasiswa.php">
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

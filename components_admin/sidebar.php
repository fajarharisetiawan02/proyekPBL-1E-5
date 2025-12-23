<div class="sidebar">

    <!-- HEADER -->
    <div class="header">
        <div class="logo-wrapper">
            <img src="../assets/img/Logo Politeknik.png" class="logo-img">
            <div class="logo-text">
                Pengumuman<br>Akademik Online
            </div>
        </div>
    </div>

    <!-- MENU -->
<div class="menu">
    <div class="menu-title">MENU UTAMA</div>

    <a href="../admin/dashboard.php" class="menu-item active">
        <i class="fas fa-home"></i><span>Dashboard</span>
    </a>

    <a href="../admin/tambah_pengumuman.php" class="menu-item">
        <i class="fas fa-bullhorn"></i><span>Pengumuman</span>
    </a>

    <a href="../admin/jadwal_ujian.php" class="menu-item">
        <i class="fas fa-calendar-alt"></i><span>Jadwal Ujian</span>
    </a>

    <a href="../admin/perubahan_kelas.php" class="menu-item">
        <i class="fas fa-exchange-alt"></i><span>Perubahan Kelas</span>
    </a>

    <a href="../admin/beasiswa.php" class="menu-item">
        <i class="fas fa-award"></i><span>Beasiswa</span>
    </a>

<!-- MANAGEMEN PENGGUNA -->
<div class="menu-group">
<!-- DATA PENGGUNA (PARENT) -->
<div class="menu-item menu-parent" id="toggleUser">
    <i class="fas fa-users"></i>
    <span>Data Pengguna</span>
    <i class="fas fa-chevron-down arrow"></i>
</div>

<!-- SUBMENU (MUNCUL DI BAWAH) -->
<div class="submenu" id="submenuUser">
    <a href="mahasiswa.php" class="submenu-item">
        <i class="fas fa-user-graduate"></i>
        <span>Data Mahasiswa</span>
    </a>

    <a href="tambah_mahasiswa.php" class="submenu-item">
        <i class="fas fa-user-plus"></i>
        <span>Tambah Mahasiswa</span>
    </a>

    <a href="import_mahasiswa.php" class="submenu-item">
        <i class="fas fa-file-excel"></i>
        <span>Import Mahasiswa</span>
    </a>
</div>

</div>
</div>

    <!-- FOOTER -->
    <div class="sidebar-footer">
        <div class="admin-info">
            <div class="avatar">A</div>
            <div class="admin-text">
                <strong>Admin</strong>
                <span>Administrator</span>
            </div>
        </div>

        <a href="../admin/ubah_sandi.php" class="footer-link">
            <i class="fas fa-key"></i> Ubah Kata Sandi
        </a>

        <a href="../logout.php" class="footer-link logout">
            <i class="fas fa-sign-out-alt"></i> Keluar
        </a>
    </div>
</div>

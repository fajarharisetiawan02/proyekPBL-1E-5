<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<div class="sidebar">

    <!-- HEADER -->
    <div class="header">
        <div class="logo-wrapper">
            <img src="../assets/img/Logo Politeknik.png" class="logo-img" alt="Logo">
            <div class="logo-text">
                Pengumuman<br>Akademik Online
            </div>
        </div>
    </div>

    <!-- MENU -->
    <div class="menu">
        <div class="menu-title">MENU UTAMA</div>

        <a href="dashboard.php" class="menu-item <?= $currentPage=='dashboard.php'?'active':'' ?>">
            <i class="fas fa-home"></i><span>Dashboard</span>
        </a>

        <a href="pengumuman.php" class="menu-item <?= $currentPage=='pengumuman.php'?'active':'' ?>">
            <i class="fas fa-bullhorn"></i><span>Pengumuman</span>
        </a>

        <a href="jadwal_ujian.php" class="menu-item <?= $currentPage=='jadwal_ujian.php'?'active':'' ?>">
            <i class="fas fa-calendar-alt"></i><span>Jadwal Ujian</span>
        </a>

        <a href="perubahan_kelas.php" class="menu-item <?= $currentPage=='perubahan_kelas.php'?'active':'' ?>">
            <i class="fas fa-exchange-alt"></i><span>Perubahan Kelas</span>
        </a>

        <a href="beasiswa.php" class="menu-item <?= $currentPage=='beasiswa.php'?'active':'' ?>">
            <i class="fas fa-award"></i><span>Beasiswa</span>
        </a>

        <!-- DATA PENGGUNA -->
        <div class="menu-group">
            <div class="menu-item menu-parent" id="toggleUser">
                <i class="fas fa-users"></i>
                <span>Data Pengguna</span>
                <i class="fas fa-chevron-down arrow"></i>
            </div>

            <div class="submenu">
                <a href="mahasiswa.php" class="submenu-item">
                    <i class="fas fa-user-graduate"></i><span>Data Mahasiswa</span>
                </a>
                <a href="dosen.php" class="submenu-item">
                    <i class="fas fa-chalkboard-teacher"></i><span>Data Dosen</span>
                </a>
            </div>
        </div>
    </div>

</div>
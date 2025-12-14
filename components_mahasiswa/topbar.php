<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$nama = $_SESSION['nama'];
$nim  = $_SESSION['username']; // username = NIM
$inisial = strtoupper(substr($nama, 0, 1));
?>

<div class="topbar">
    <i class="fa-solid fa-bars" id="menu-toggle"></i>

    <div class="search-box">
        <input type="text" placeholder="Search">
        <i class="fa-solid fa-search"></i>
    </div>

    <div class="header-icons">

        <i class="fa-solid fa-bell" style="font-size:30px;color:black;"></i>

        <div class="profile-dropdown">
            <div class="profile-info" id="profileIcon">
                <div class="profile-avatar"><?= $inisial; ?></div>

                <div class="profile-text">
                    <span class="profile-name"><?= $nama; ?></span>
                    <span class="profile-nim"><?= $nim; ?></span>
                </div>
            </div>

            <div class="dropdown-menu" id="dropdownMenu">

                <a href="../admin/profil_mahasiswa.php">
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

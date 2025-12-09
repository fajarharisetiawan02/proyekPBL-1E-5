<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$id_mhs = isset($_SESSION['id_mahasiswa']) ? $_SESSION['id_mahasiswa'] : 0;
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
            <i class="fa-solid fa-circle-user" id="profileIcon"></i>

            <div class="dropdown-menu" id="dropdownMenu">

                <?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>

                <a href="../admin/profil_mahasiswa.php?id=<?= $_SESSION['id_mahasiswa'] ?>">
                    <i class="fa-solid fa-id-card"></i> Profil
                </a>

                <a href="../admin/ubah_sandi.php">
                    <i class="fa-solid fa-key"></i> Change Password
                </a>

                <a href="../login.php">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </a>

            </div>
        </div>
    </div>
</div>
    <script src="../assets/js/script.3.js"></script>

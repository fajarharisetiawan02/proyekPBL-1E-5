<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";

$id_login = $_SESSION['id_login'];

$q = mysqli_query($koneksi, "
    SELECT id_login, nama, username, email, role, foto
    FROM login
    WHERE id_login = '$id_login'
");

$admin = mysqli_fetch_assoc($q);

if (!$admin) {
    echo "<h2 style='padding:20px;color:red'>❌ Data admin tidak ditemukan</h2>";
    exit;
}

// FOTO PROFIL
$fotoAdmin = !empty($admin['foto'])
    ? "../uploads/foto_admin/" . $admin['foto']
    : null;

$inisial = strtoupper(substr($admin['nama'], 0, 1));

$statusAkun = 'Aktif';
$lastLogin  = $_SESSION['last_login'] ?? date('Y-m-d H:i:s');
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Profil Admin</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">

         <link rel="icon" type="image/png" href="../assets/img/Logo Politeknik.png">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/profil-admin.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
</head>

<body>

    <div class="main-wrapper">

        <?php include "../components_admin/sidebar.php"; ?>

        <div class="main-content">
            <div class="content-container">

                <?php include "../components_admin/topbar.php"; ?>

                <div class="profile-header admin-header">
                    <div class="photo-wrapper">
                        <?php if ($fotoAdmin): ?>
                        <img src="<?= $fotoAdmin ?>" class="profile-photo">
                        <?php else: ?>
                        <div class="profile-photo avatar-inisial">
                            <?= $inisial ?>
                        </div>
                        <?php endif; ?>

                        <label class="edit-photo-btn">
                            <i class="fa-solid fa-camera"></i>
                            <input type="file" id="fotoAdmin" accept="image/*">
                        </label>
                    </div>

                    <div class="profile-info">
                        <h1><?= strtoupper($admin['nama']) ?></h1>
                        <span class="badge-admin">
                            <i class="fa-solid fa-user-shield"></i> ADMINISTRATOR
                        </span>
                        <p>Username : <b><?= $admin['username'] ?></b></p>
                    </div>
                </div>

                <div class="profile-card admin-card">
                    <h2><i class="fa-solid fa-id-card"></i> Informasi Akun</h2>

                    <div class="info-row">
                        <span>Nama Lengkap</span>
                        <strong><?= $admin['nama'] ?></strong>
                    </div>

                    <div class="info-row">
                        <span>Email</span>
                        <strong><?= $admin['email'] ?></strong>
                    </div>

                    <div class="info-row">
                        <span>Username</span>
                        <strong><?= $admin['username'] ?></strong>
                    </div>

                    <div class="info-row">
                        <span>Role</span>
                        <strong><?= strtoupper($admin['role']) ?></strong>
                    </div>

                    <div class="info-row">
                        <span>Status Akun</span>
                        <strong class="status-active">
                            <i class="fa-solid fa-circle-check"></i> <?= $statusAkun ?>
                        </strong>
                    </div>

                    <div class="info-row">
                        <span>Terakhir Login</span>
                        <strong>
                            <?= date('d M Y, H:i', strtotime($lastLogin)) ?>
                        </strong>
                    </div>

                    <div class="action-group">
                        <a href="ubah_sandi.php" class="btn-edit">
                            <i class="fa-solid fa-key"></i> Ubah Kata Sandi
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="../assets/js/script1.js"></script>

    <script>
        document.getElementById('fotoAdmin') ? .addEventListener('change', function () {
            const formData = new FormData();
            formData.append('foto', this.files[0]);

            fetch('upload_foto_admin.php', {
                    method: 'POST',
                    body: formData
                })
                .then(res => res.text())
                .then(() => location.reload());
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../assets/js/script3.js"></script>

</body>

</html>

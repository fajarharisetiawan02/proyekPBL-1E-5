<?php
require_once "../config/auth.php";
require_once "../config/koneksi.php";

$role = $_SESSION['role'] ?? null;

if ($role === 'admin') {

    if (!isset($_GET['id'])) {
        echo "<h2 style='padding:20px;color:red'>❌ ID mahasiswa tidak ada</h2>";
        exit;
    }

    $id = mysqli_real_escape_string($koneksi, $_GET['id']);

    $q = mysqli_query($koneksi,
        "SELECT * FROM mahasiswa WHERE id_mahasiswa='$id'"
    );

} else {

    $nim = $_SESSION['username'];

    $q = mysqli_query($koneksi,
        "SELECT * FROM mahasiswa WHERE nim='$nim'"
    );
}

$mhs = mysqli_fetch_assoc($q);

if (!$mhs) {
    echo "<h2 style='padding:20px;color:red'>❌ Data mahasiswa tidak ditemukan.</h2>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Profil Mahasiswa</title>

<link rel="stylesheet" href="../assets/css/style7.css">
<link rel="stylesheet" href="../assets/css/style_profil_mahasiswa.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />

</head>
<body>
    <div class="main-wrapper">

        <?php include "../components_admin/sidebar.php"; ?>

        <div class="main-content">
            <div class="content-container">

        <?php include "../components_admin/topbar.php"; ?>

        <div class="profile-header">

            <div class="photo-wrapper">
                <img id="profilePhoto" src="<?= $fotoPath ?>">

                <label class="edit-photo-btn">
                    <i class="fa-solid fa-camera"></i>
                    <input type="file" id="photoInput" name="foto" accept="image/*">
                </label>

                <input type="hidden" id="mhs_id" value="<?= $mhs['id_mahasiswa'] ?>">
            </div>

            <div class="profile-info">
                <h1><?= strtoupper($mhs['nama']) ?></h1>
                <p>Mahasiswa – <?= $mhs['prodi'] ?></p>
                <p>NIM : <?= $mhs['nim'] ?></p>
            </div>
        </div>
        
        <div class="profile-card">
            <h2>Data Pribadi</h2>

            <div class="data-grid">
                <div class="label">Nama Lengkap</div>
                <div>: <?= $mhs['nama'] ?></div>

                <div class="label">Program Studi</div>
                <div>: <?= $mhs['prodi'] ?></div>

                <div class="label">Email</div>
                <div>: <?= $mhs['email'] ?></div>

                <div class="label">No HP</div>
                <div>: <?= $mhs['no_hp'] ?></div>
            </div>

            <button class="btn-edit"
                onclick="window.location='edit_mahasiswa.php?id=<?= $mhs['id_mahasiswa'] ?>'">
                Edit Profil
            </button>
        </div>

    </div>

</div>

<script src="../assets/js/script1.js"></script>
</body>
</html>
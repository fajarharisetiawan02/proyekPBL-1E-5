<?php
require_once "../config/auth_mahasiswa.php";
require_once "../config/koneksi.php";

$id_mahasiswa = $_SESSION['id_mahasiswa'];

$pengumuman = mysqli_query($koneksi, "
    SELECT * FROM pengumuman
    WHERE untuk_mahasiswa IS NULL 
       OR untuk_mahasiswa = '$id_mahasiswa'
    ORDER BY dibuat_pada DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Pengumuman Akademik</title>

<link rel="stylesheet" href="../assets/css/pengumuman_mahasiswa.css">
<link rel="stylesheet" href="../assets/css/style4.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
<link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>

<div class="pengumuman-wrapper">


    <?php include "../components_mahasiswa/sidebar.php"; ?>
    <?php include "../components_mahasiswa/topbar.php"; ?>

    <div class="main-content">
        <div class="content-container">
    <h2 class="page-title">
        <i class="fa-solid fa-bullhorn"></i>
        Pengumuman Akademik
    </h2>

    <?php if(mysqli_num_rows($pengumuman) == 0): ?>
        <div class="empty">
            <i class="fa-solid fa-circle-info"></i>
            <p>Belum ada pengumuman</p>
        </div>
    <?php endif; ?>

    <?php while($p = mysqli_fetch_assoc($pengumuman)): ?>
    <div class="pengumuman-card">

        <div class="card-header">
            <span class="badge <?= strtolower($p['kategori']); ?>">
                <?= strtoupper($p['kategori']); ?>
            </span>

            <span class="tanggal">
                <i class="fa-regular fa-calendar"></i>
                <?= date("d M Y", strtotime($p['dibuat_pada'])); ?>
            </span>
        </div>

        <h3 class="judul"><?= htmlspecialchars($p['judul']); ?></h3>

        <p class="isi">
            <?= nl2br(htmlspecialchars($p['isi'])); ?>
        </p>

    </div>
    <?php endwhile; ?>

</div>

</body>
</html>

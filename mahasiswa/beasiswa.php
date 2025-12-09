<?php 
require_once "../config/koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beasiswa - Mahasiswa</title>

    <link rel="stylesheet" href="../assets/css/style...6.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
</head>

<body>

<div class="main-wrapper">

    <?php include "../components_mahasiswa/sidebar.php"; ?>
    <?php include "../components_mahasiswa/topbar.php"; ?>

<div class="main-content">
    <div class="content-container">

        <div class="alert-box">
            Terdapat berbagai program beasiswa untuk mahasiswa aktif! <br>
            <strong>Baca syarat dan tenggat waktu sebelum mendaftar.</strong>
        </div>

        <!-- KONTEN BEASISWA -->
        <div class="beasiswa-grid">

                <?php
                $data = mysqli_query($koneksi, "SELECT * FROM beasiswa WHERE status='aktif' ORDER BY created_at DESC");

                if (mysqli_num_rows($data) == 0) {
                    echo "<p style='text-align:center; width:100%;'>Belum ada beasiswa tersedia.</p>";
                }

                while ($row = mysqli_fetch_assoc($data)) { ?>

                <div class="beasiswa-card">

                    <?php if (!empty($row['gambar'])) { ?>
                        <img src="../uploads/beasiswa/<?= $row['gambar']; ?>" class="beasiswa-img">
                    <?php } ?>

                    <h3><?= $row['nama_beasiswa']; ?></h3>

                    <p><?= substr($row['deskripsi'], 0, 110); ?>...</p>

                    <p><strong>Periode:</strong> <?= $row['periode']; ?></p>

                    <p>
                        <strong>Buka:</strong> <?= date("d M Y", strtotime($row['tanggal_buka'])); ?><br>
                        <strong>Tutup:</strong> <?= date("d M Y", strtotime($row['tanggal_tutup'])); ?>
                    </p>

                    <a href="detail_beasiswa.php?id=<?= $row['id_beasiswa']; ?>" class="btn-detail">
                        Lihat Detail
                    </a>

                </div>

                <?php } ?>

            </div> <!-- end beasiswa-grid -->

        </div> <!-- end content-container -->

    </div> <!-- end main-content -->

</div> <!-- end wrapper -->

<footer>
    © 2025 Aplikasi Pengumuman Akademik Online | Politeknik Negeri Batam
</footer>

<script src="../assets/js/script3.js"></script>

</body>
</html>

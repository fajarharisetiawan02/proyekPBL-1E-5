<?php
require_once "../config/auth_mahasiswa.php";
require_once "../config/koneksi.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
<<<<<<< HEAD
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Beasiswa - Mahasiswa</title>

<link rel="icon" type="image/png" href="../assets/img/Logo Politeknik.png">
<link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
<link rel="stylesheet" href="../assets/css/style6.css">
<link rel="stylesheet" href="../assets/css/sidebar.css">
<link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
<link rel="stylesheet" href="../assets/css/box_lihatdetail.css">

<style>
/* ==================================================
   PERBAIKAN FINAL: BADGE DIBUKA / DITUTUP (DIKECILKAN)
   TIDAK MENGUBAH TAMPILAN LAIN
================================================== */
.beasiswa-card .badge{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    padding:4px 12px;     /* lebih kecil */
    font-size:12px;       /* font diperkecil */
    font-weight:600;
    border-radius:999px;  /* pill kecil */
    line-height:1;
    margin:6px 0 8px;
    white-space:nowrap;
}

.beasiswa-card .bg-success{
    background:#16a34a;
    color:#fff;
}

.beasiswa-card .bg-danger{
    background:#dc2626;
    color:#fff;
}
</style>
=======
    <meta charset="UTF-8">
    <title>Beasiswa - Mahasiswa</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<<<<<<< HEAD
<link rel="icon" type="image/png" href="../assets/img/Logo Politeknik.png">
<link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style5.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
=======
<<<<<<< HEAD
    <link rel="stylesheet" href="../assets/css/style5.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
=======
    <link rel="stylesheet" href="../assets/css/style6.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />

>>>>>>> 9a567987dd90af1392f8d15dfcbd79423ecb4815
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
</head>

<body>

    <div class="main-wrapper">

<<<<<<< HEAD
<?php include "../components_mahasiswa/sidebar.php"; ?>
<?php include "../components_mahasiswa/topbar.php"; ?>

<div class="main-content">
<div class="content-container">

<div class="alert-box">
    Terdapat berbagai program beasiswa untuk mahasiswa aktif! <br>
    <strong>Baca syarat dan tenggat waktu sebelum mendaftar.</strong>
</div>

<!-- GRID BEASISWA -->
<div class="beasiswa-grid">

<?php
$data = mysqli_query($koneksi, "
    SELECT * FROM beasiswa
    WHERE status = 'aktif'
    ORDER BY tanggal_buka DESC
");

if (mysqli_num_rows($data) == 0) {
    echo "<p style='text-align:center;width:100%'>Belum ada informasi beasiswa.</p>";
}

while ($row = mysqli_fetch_assoc($data)) {
    $hari_ini = date('Y-m-d');
    $status_beasiswa = ($hari_ini <= $row['tanggal_tutup']) ? 'Dibuka' : 'Ditutup';
?>
=======
        <?php include "../components_mahasiswa/sidebar.php"; ?>
        <?php include "../components_mahasiswa/topbar.php"; ?>

<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
    <div class="main-content">
        <div class="content-container">

            <div class="alert-box">
            Terdapat berbagai program beasiswa untuk mahasiswa aktif! <br>
            <strong>Baca syarat dan tenggat waktu sebelum mendaftar.</strong>
            </div>

            <!-- GRID BEASISWA -->
            <div class="beasiswa-grid">

            <?php
            $data = mysqli_query($koneksi, "
                SELECT * FROM beasiswa
                WHERE status = 'aktif'
                ORDER BY tanggal_buka DESC
            ");
<<<<<<< HEAD

            if (!$data) {
                die("Query Error: " . mysqli_error($koneksi));
            }

            if (mysqli_num_rows($data) == 0) {
                echo "<p style='text-align:center; width:100%;'>Belum ada informasi beasiswa.</p>";
            }

            while ($row = mysqli_fetch_assoc($data)) {

                $hari_ini = date('Y-m-d');
                $status_beasiswa = ($hari_ini <= $row['tanggal_tutup']) ? 'Dibuka' : 'Ditutup';
            ?>
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717

<div class="beasiswa-card">

<<<<<<< HEAD
<?php if (!empty($row['gambar'])) { ?>
    <img src="../uploads/beasiswa/<?= htmlspecialchars($row['gambar']); ?>" class="beasiswa-img">
<?php } ?>

<h3><?= htmlspecialchars($row['nama_beasiswa']); ?></h3>

<span class="badge <?= $status_beasiswa == 'Dibuka' ? 'bg-success' : 'bg-danger' ?>">
    <?= $status_beasiswa ?>
</span>

<p style="margin-top:6px;">
    <?= substr(strip_tags($row['deskripsi']), 0, 120); ?>...
</p>

<p>
    <strong>Periode:</strong> <?= htmlspecialchars($row['periode']); ?><br>
    <strong>Dibuka:</strong>
    <?= date("d M Y", strtotime($row['tanggal_buka'])); ?>
</p>

<button class="btn-detail"
    data-bs-target="#modal<?= $row['id_beasiswa'] ?>">
    Lihat Detail
</button>
</div>

<!-- MODAL DETAIL (CUSTOM) -->
<div class="modal" id="modal<?= $row['id_beasiswa'] ?>">
<div class="modal-dialog modal-lg modal-dialog-scrollable">
<div class="modal-content">

<div class="modal-header">
    <h5 class="modal-title"><?= htmlspecialchars($row['nama_beasiswa']); ?></h5>
    <button type="button" class="btn-close">&times;</button>
</div>

<div class="modal-body">
    <hr>
    <strong>Deskripsi:</strong>
    <p><?= nl2br(htmlspecialchars($row['deskripsi'])); ?></p>

    <hr>
    <strong>Syarat:</strong>
    <p><?= nl2br(htmlspecialchars($row['syarat'])); ?></p>

    <hr>
    <strong>Periode:</strong> <?= htmlspecialchars($row['periode']); ?><br>
    <strong>Tanggal:</strong>
    <?= date("d M Y", strtotime($row['tanggal_buka'])); ?> -
    <?= date("d M Y", strtotime($row['tanggal_tutup'])); ?>
</div>

<div class="modal-footer">
    <button class="btn btn-secondary">Tutup</button>
</div>

</div>
</div>
</div>

<?php } ?>

</div>
</div>
</div>
=======
                    <?php if (!empty($row['gambar'])) { ?>
                        <img src="../uploads/beasiswa/<?= htmlspecialchars($row['gambar']); ?>" class="beasiswa-img">
                    <?php } ?>

                    <h3><?= htmlspecialchars($row['nama_beasiswa']); ?></h3>

                    <span class="badge <?= $status_beasiswa == 'Dibuka' ? 'bg-success' : 'bg-danger' ?>">
                        <?= $status_beasiswa ?>
                    </span>

                    <p style="margin-top:8px;">
                        <?= substr(strip_tags($row['deskripsi']), 0, 120); ?>...
                    </p>

                    <p>
                        <strong>Periode:</strong> <?= htmlspecialchars($row['periode']); ?><br>
                        <strong>Dibuka:</strong>
                        <?= date("d M Y", strtotime($row['tanggal_buka'])); ?>
                    </p>

                    <button class="btn-detail"
                        data-bs-toggle="modal"
                        data-bs-target="#modal<?= $row['id_beasiswa'] ?>">
                        Lihat Detail
                    </button>
                </div>

                <!-- MODAL DETAIL -->
                <div class="modal fade"
                    id="modal<?= $row['id_beasiswa'] ?>"
                    tabindex="-1"
                    data-bs-backdrop="static"
                    data-bs-keyboard="false">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title"><?= htmlspecialchars($row['nama_beasiswa']); ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">

                                <hr>
                                <strong>Deskripsi:</strong>
                                <p><?= nl2br(htmlspecialchars($row['deskripsi'])); ?></p>

=======
=======
        <div class="main-content">
            <div class="content-container">

                <div class="alert-box">
                    Terdapat berbagai program beasiswa untuk mahasiswa aktif! <br>
                    <strong>Baca syarat dan tenggat waktu sebelum mendaftar.</strong>
                </div>

                <div class="beasiswa-grid">

                    <?php
                $data = mysqli_query($koneksi, "SELECT * FROM beasiswa WHERE status='aktif' ORDER BY created_at DESC");
>>>>>>> 9a567987dd90af1392f8d15dfcbd79423ecb4815

            if (!$data) {
                die("Query Error: " . mysqli_error($koneksi));
            }

            if (mysqli_num_rows($data) == 0) {
                echo "<p style='text-align:center; width:100%;'>Belum ada informasi beasiswa.</p>";
            }

            while ($row = mysqli_fetch_assoc($data)) {

                $hari_ini = date('Y-m-d');
                $status_beasiswa = ($hari_ini <= $row['tanggal_tutup']) ? 'Dibuka' : 'Ditutup';
            ?>

                    <div class="beasiswa-card">

<<<<<<< HEAD
                    <?php if (!empty($row['gambar'])) { ?>
                        <img src="../uploads/beasiswa/<?= htmlspecialchars($row['gambar']); ?>" class="beasiswa-img">
                    <?php } ?>

                    <h3><?= htmlspecialchars($row['nama_beasiswa']); ?></h3>

                    <span class="badge <?= $status_beasiswa == 'Dibuka' ? 'bg-success' : 'bg-danger' ?>">
                        <?= $status_beasiswa ?>
                    </span>

                    <p style="margin-top:8px;">
                        <?= substr(strip_tags($row['deskripsi']), 0, 120); ?>...
                    </p>

                    <p>
                        <strong>Periode:</strong> <?= htmlspecialchars($row['periode']); ?><br>
                        <strong>Dibuka:</strong>
                        <?= date("d M Y", strtotime($row['tanggal_buka'])); ?>
                    </p>

                    <button class="btn-detail"
                        data-bs-toggle="modal"
                        data-bs-target="#modal<?= $row['id_beasiswa'] ?>">
                        Lihat Detail
                    </button>
                </div>

                <!-- MODAL DETAIL -->
                <div class="modal fade"
                    id="modal<?= $row['id_beasiswa'] ?>"
                    tabindex="-1"
                    data-bs-backdrop="static"
                    data-bs-keyboard="false">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title"><?= htmlspecialchars($row['nama_beasiswa']); ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">

                                <hr>
                                <strong>Deskripsi:</strong>
                                <p><?= nl2br(htmlspecialchars($row['deskripsi'])); ?></p>

>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
                                <hr>
                                <strong>Syarat:</strong>
                                <p><?= nl2br(htmlspecialchars($row['syarat'])); ?></p>

                                <hr>
                                <strong>Periode:</strong> <?= htmlspecialchars($row['periode']); ?><br>
                                <strong>Tanggal:</strong>
                                <?= date("d M Y", strtotime($row['tanggal_buka'])); ?>
                                -
                                <?= date("d M Y", strtotime($row['tanggal_tutup'])); ?>

                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>

                        </div>
                    </div>
                </div>

            <?php } ?>

            </div>
        </div>
    </div>
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
</div>

<footer>
© 2025 Aplikasi Pengumuman Akademik Online | Politeknik Negeri Batam
</footer>

<script src="../assets/js/script3.js"></script>
<<<<<<< HEAD
<script>
document.querySelectorAll('.btn-detail').forEach(btn=>{
    btn.addEventListener('click',()=>{
        document.querySelector(btn.dataset.bsTarget).classList.add('show');
    });
});
document.querySelectorAll('.btn-close,.btn-secondary').forEach(btn=>{
    btn.addEventListener('click',()=>{
        btn.closest('.modal').classList.remove('show');
    });
});
</script>
=======
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<<<<<<< HEAD
=======
=======
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

                </div> 

            </div> 

        </div>

    </div> 

    <footer>
        © 2025 Aplikasi Pengumuman Akademik Online | Politeknik Negeri Batam
    </footer>

    <script src="../assets/js/script3.js"></script>
>>>>>>> 9a567987dd90af1392f8d15dfcbd79423ecb4815
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717

</body>

</html>

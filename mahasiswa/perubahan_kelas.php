<?php
require_once "../config/auth_mahasiswa.php";
require_once "../config/koneksi.php";

$kelas = $_SESSION['kelas'] ?? '';
$prodi = $_SESSION['prodi'] ?? '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perubahan Kelas - Mahasiswa</title>

    <link rel="stylesheet" href="../assets/css/style5.css">
<link rel="stylesheet" href="../assets/css/sidebar.css">
<link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        /* header konsisten dengan jadwal ujian */
        .header-flex {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-bottom: 12px;
            margin-bottom: 18px;
            border-bottom: 1px solid #e6eef5;
        }
        .header-center {
            text-align: center;
            font-size: 13px;
            color: #444;
        }
        .header-right {
            font-size: 13px;
            color: #666;
        }
    </style>
</head>

<body>

<div class="main-wrapper">

    <?php include "../components_mahasiswa/sidebar.php"; ?>
    <?php include "../components_mahasiswa/topbar.php"; ?>

    <div class="main-content">
        <div class="content-container">

            <!-- HEADER (SAMA DENGAN JADWAL UJIAN) -->
            <div class="header-section header-flex">
                <h3>Perubahan Kelas</h3>

                <small class="header-center">
                    Kelas: <b><?= $kelas ?: '-'; ?></b> |
                    Prodi: <b><?= $prodi ?: '-'; ?></b>
                </small>

                <small class="header-right">
                    Menampilkan informasi perubahan kelas terbaru.
                </small>
            </div>

            <!-- TABEL -->
            <div class="table-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Mata Kuliah</th>
                            <th>Kelas Asal</th>
                            <th>Kelas Baru</th>
                            <th>Dosen</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php
                    // filter kelas
                    $query = mysqli_query($koneksi, "
                        SELECT * FROM perubahan_kelas
                        WHERE kelas='$kelas'
                        ORDER BY tanggal_perubahan DESC
                    ");

                    // fallback prodi
                    if (mysqli_num_rows($query) === 0 && $prodi != '') {
                        $query = mysqli_query($koneksi, "
                            SELECT * FROM perubahan_kelas
                            WHERE prodi='$prodi'
                            ORDER BY tanggal_perubahan DESC
                        ");
                    }

                    // fallback semua
                    if (mysqli_num_rows($query) === 0) {
                        $query = mysqli_query($koneksi, "
                            SELECT * FROM perubahan_kelas
                            ORDER BY tanggal_perubahan DESC
                        ");
                    }

                    if (!$query || mysqli_num_rows($query) === 0) {
                        echo "<tr>
                                <td colspan='6' style='text-align:center;'>
                                    Belum ada data perubahan kelas
                                </td>
                              </tr>";
                    }

                    $no = 1;
                    while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= date("d M Y", strtotime($row['tanggal_perubahan'])); ?></td>
                            <td><?= $row['mata_kuliah']; ?></td>
                            <td><?= $row['kelas_asal']; ?></td>
                            <td><?= $row['kelas_baru']; ?></td>
                            <td><?= $row['dosen']; ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>

                </table>
            </div>

        </div>
    </div>
</div>

<footer>
    © 2025 Aplikasi Pengumuman Akademik Online | Politeknik Negeri Batam
</footer>

<script src="../assets/js/script3.js"></script>
</body>
</html>

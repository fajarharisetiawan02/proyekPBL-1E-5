<?php
require_once "../config/auth_mahasiswa.php";
require_once "../config/koneksi.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Jadwal Ujian - Mahasiswa</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="icon" type="image/png" href="../assets/img/Logo Politeknik.png">
<link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style4.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
<link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
</head>

<body>

    <div class="main-wrapper">

        <?php include "../components_mahasiswa/sidebar.php"; ?>
        <?php include "../components_mahasiswa/topbar.php"; ?>

        <div class="main-content">

            <div class="content-container">

                <div class="header-section">
                    <h3>IF MALAM 1E</h3>
                </div>

                <div class="table-wrapper">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Mata Kuliah</th>
                                <th>Dosen</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                        $data = mysqli_query($koneksi, "SELECT * FROM perkuliahan ORDER BY tanggal DESC");

                        if (mysqli_num_rows($data) === 0) {
                        echo "<tr><td colspan='6' style='text-align:center;'>Belum ada data.</td></tr>";
                        }

                        while ($row = mysqli_fetch_assoc($data)) { ?>
                            <tr>
                                <td><?= date("d M Y", strtotime($row['tanggal'])); ?></td>
                                <td><?= date("g:i A", strtotime($row['waktu'])); ?></td>
                                <td><?= $row['mata_kuliah']; ?></td>
                                <td><?= $row['dosen']; ?></td>
                                <td><?= $row['ket']; ?></td>
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

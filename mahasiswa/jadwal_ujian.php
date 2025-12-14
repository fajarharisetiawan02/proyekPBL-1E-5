<?php
require_once "../config/auth.php";
require_once "../config/koneksi.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Ujian - Mahasiswa</title>

    <link rel="stylesheet" href="../assets/css/style3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
</head>

<body>

    <!-- ================== WRAPPER ================== -->
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
                                <th>Mata Kuliah</th>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Ruang</th>
                                <th>Dosen</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                        $data = mysqli_query($koneksi, "SELECT * FROM jadwal_ujian ORDER BY tanggal, waktu");

                        if (mysqli_num_rows($data) === 0) {
                            echo "<tr><td colspan='5' style='text-align:center;'>Belum ada jadwal ujian.</td></tr>";
                        }

                        while ($row = mysqli_fetch_assoc($data)) { ?>
                            <tr>
                                <td><?= $row['mata_kuliah']; ?></td>
                                <td><?= date("d M Y", strtotime($row['tanggal'])); ?></td>
                                <td><?= date("g:i A", strtotime($row['waktu'])); ?></td>
                                <td><?= $row['ruang']; ?></td>
                                <td><?= $row['dosen']; ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>

                    </table>
                </div>

            </div> <!-- end content-container -->

        </div> <!-- end main-content -->

    </div> <!-- end wrapper -->

    <footer>
        © 2025 Aplikasi Pengumuman Akademik Online | Politeknik Negeri Batam
    </footer>

    <script src="../assets/js/script3.js"></script>
</body>

</html>

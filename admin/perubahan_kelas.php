<?php
require_once "../config/koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Perubahan Kelas - Admin</title>

    <link rel="stylesheet" href="../assets/css/style5.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
</head>

<body>

    <div class="main-wrapper">

        <?php include "../components_admin/sidebar.php"; ?>
        <?php include "../components_admin/topbar.php"; ?>

        <div class="main-content">
            <div class="content-container">

                <div class="header-section">
                    <h3>Perubahan Kelas</h3>

                    <a href="tambah_perubahan_kelas.php" class="btn-add">
                        <i class="fa-solid fa-plus"></i> Tambah Perubahan Kelas
                    </a>
                </div>

                <div class="table-wrapper">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Mata Kuliah</th>
                                <th>Kelas Asal</th>
                                <th>Kelas Baru</th>
                                <th>Dosen</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php 
                        $data = mysqli_query($koneksi, 
                        "SELECT * FROM perubahan_kelas ORDER BY tanggal_perubahan DESC"
                        );

                        if (mysqli_num_rows($data) === 0) {
                        echo "<tr><td colspan='6' style='text-align:center;'>Belum ada data.</td></tr>";
                        }

                        while ($row = mysqli_fetch_assoc($data)) { ?>
                            <tr>
                                <td><?= date("d M Y", strtotime($row['tanggal_perubahan'])); ?></td>
                                <td><?= $row['mata_kuliah']; ?></td>
                                <td><?= $row['kelas_asal']; ?></td>
                                <td><?= $row['kelas_baru']; ?></td>
                                <td><?= $row['dosen']; ?></td>

                                <td class="text-center">
                                    <a href="edit_perubahan_kelas.php?id=<?= $row['id_kelas']; ?>"
                                        class="btn-icon btn-edit">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    <a href="hapus_perubahan_kelas.php?id=<?= $row['id_kelas']; ?>"
                                        class="btn-icon btn-delete" onclick="return confirm('Hapus data ini?');">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
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

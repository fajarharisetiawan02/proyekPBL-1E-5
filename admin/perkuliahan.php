<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Perkuliahan - Admin</title>

    <link rel="stylesheet" href="../assets/css/style4.css">
        <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
</head>

<body>
    <div class="main-wrapper">

        <?php include "../components_admin/sidebar.php"; ?>
        <?php include "../components_admin/topbar.php"; ?>

        <div class="main-content">
            <div class="content-container">

                <div class="header-section">
                    <h3>Perkuliahan</h3>

                    <a href="tambah_perkuliahan.php" class="btn-add">
                        <i class="fa-solid fa-plus"></i> Tambah Perkuliahan
                    </a>
                </div>
                <div class="table-wrapper">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Mata Kuliah</th>
                                <th>Dosen</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $no = 1; 
                        $data = mysqli_query($koneksi, "SELECT * FROM perkuliahan ORDER BY tanggal DESC");

                        if (mysqli_num_rows($data) === 0) {
                        echo "<tr><td colspan='6' style='text-align:center;'>Belum ada data.</td></tr>";
                        }

                        while ($row = mysqli_fetch_assoc($data)) { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= date("d M Y", strtotime($row['tanggal'])); ?></td>
                                <td><?= date("g:i A", strtotime($row['waktu'])); ?></td>
                                <td><?= $row['mata_kuliah']; ?></td>
                                <td><?= $row['dosen']; ?></td>
                                <td><?= $row['ket']; ?></td>

                                <td class="text-center">
                                    <a href="edit_perkuliahan.php?id=<?= $row['id_perkuliahan']; ?>"
                                        class="btn-icon btn-edit">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    <a href="hapus_perkuliahan.php?id=<?= $row['id_perkuliahan']; ?>"
                                        onclick="return confirm('Hapus data ini?');" class="btn-icon btn-delete">
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

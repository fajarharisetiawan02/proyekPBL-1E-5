<?php
require_once "../config/auth.php";
require_once "../config/koneksi.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Beasiswa - Admin</title>
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
                    <h3>Beasiswa</h3>

                    <a href="tambah_beasiswa.php" class="btn-add">
                        <i class="fa-solid fa-plus"></i> Tambah Beasiswa
                    </a>
                </div>

                <div class="table-wrapper">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Periode</th>
                                <th>Tanggal Buka</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $no = 1; // ← nomor mulai dari 1
                        $data = mysqli_query($koneksi, "SELECT * FROM beasiswa ORDER BY created_at DESC");

                        if (mysqli_num_rows($data) == 0) {
                        echo "<tr><td colspan='5' style='text-align:center;'>Belum ada data beasiswa.</td></tr>";
                        }

                        while ($row = mysqli_fetch_assoc($data)) { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $row['nama_beasiswa']; ?></td>
                                <td><?= $row['periode']; ?></td>
                                <td><?= date('d M Y', strtotime($row['tanggal_buka'])); ?></td>
                                <td><?= ucfirst($row['status']); ?></td>

                                <td class="text-center">
                                    <a href="edit_beasiswa.php?id=<?= $row['id_beasiswa']; ?>"
                                        class="btn-icon btn-edit">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    <a href="hapus_beasiswa.php?id=<?= $row['id_beasiswa']; ?>"
                                        onclick="return confirm('Hapus beasiswa ini?');" class="btn-icon btn-delete">
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

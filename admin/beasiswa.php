<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Beasiswa - Admin</title>

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

                <!-- HEADER -->
                <div class="header-section header-beasiswa">
                    <h3>Beasiswa</h3>

                    <a href="tambah_beasiswa.php" class="btn-add">
                        <i class="fa-solid fa-plus"></i> Tambah Beasiswa
                    </a>
                </div>

                <!-- TABLE -->
                <div class="table-wrapper">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th width="50">No</th>
                                <th>Nama Beasiswa</th>
                                <th>Periode</th>
                                <th>Tanggal Buka</th>
                                <th>Status</th>
                                <th width="120">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                    $no = 1;
                    $data = mysqli_query($koneksi, "SELECT * FROM beasiswa ORDER BY created_at DESC");

                    if (mysqli_num_rows($data) == 0) {
                        echo "
                        <tr>
                            <td colspan='6' class='empty-table'>
                                <i class='fa-solid fa-circle-info'></i><br>
                                Belum ada data beasiswa
                            </td>
                        </tr>";
                    }

                    while ($row = mysqli_fetch_assoc($data)) {

                        // Badge status
                        if ($row['status'] == 'aktif') {
                            $badge = "<span class='badge badge-aktif'>Aktif</span>";
                        } elseif ($row['status'] == 'nonaktif') {
                            $badge = "<span class='badge badge-nonaktif'>Ditutup</span>";
                        } else {
                            $badge = "<span class='badge badge-menunggu'>Menunggu</span>";
                        }
                    ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><strong><?= $row['nama_beasiswa']; ?></strong></td>
                                <td><?= $row['periode'] ?: 'Belum ditentukan'; ?></td>
                                <td><?= date('d M Y', strtotime($row['tanggal_buka'])); ?></td>
                                <td><?= $badge; ?></td>

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

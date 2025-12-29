<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";

// ambil data dosen
$query = mysqli_query($koneksi, "
    SELECT 
        id_dosen,
        nidn,
        nama_dosen,
        email,
        no_hp,
        fakultas,
        prodi
    FROM dosen
    ORDER BY nama_dosen ASC
");

if (!$query) {
    die("Query error: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Dosen</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/png" href="../assets/img/Logo Politeknik.png">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/mahasiswa.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
</head>

<body>

<div class="main-wrapper">

    <?php include "../components_admin/sidebar.php"; ?>
    <?php include "../components_admin/topbar.php"; ?>

    <div class="main-content">
        <div class="content-container">

            <h2>Data Dosen</h2>
            <p class="page-desc">Daftar dosen yang terdaftar sebagai admin sistem.</p>

            <!-- ===== AKSI ===== -->
            <div class="action-bar">
                <a href="tambah_dosen.php" class="btn-primary">
                    <i class="fa-solid fa-user-plus"></i> Tambah Dosen
                </a>
            </div>

            <!-- ===== TABEL ===== -->
            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIDN</th>
                            <th>Nama Dosen</th>
                            <th>Fakultas</th>
                            <th>Program Studi</th>
                            <th>Email</th>
                            <th>No HP</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; while ($row = mysqli_fetch_assoc($query)) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row['nidn']; ?></td>
                            <td><?= $row['nama_dosen']; ?></td>
                            <td><?= $row['fakultas']; ?></td>
                            <td><?= $row['prodi']; ?></td>
                            <td><?= $row['email']; ?></td>
                            <td><?= $row['no_hp']; ?></td>
                            <td class="aksi">
                                <a href="edit_dosen.php?id=<?= $row['id_dosen']; ?>" class="btn-edit">Edit</a>
                                <a href="hapus_dosen.php?id=<?= $row['id_dosen']; ?>" class="btn-hapus"
                                   onclick="return confirm('Yakin ingin menghapus data dosen ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<footer>
© 2025 Aplikasi Pengumuman Akademik Online | Politeknik Negeri Batam
</footer>

</body>
</html>

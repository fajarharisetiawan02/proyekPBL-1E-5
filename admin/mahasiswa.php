<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";

// ambil data mahasiswa
$query = mysqli_query($koneksi, "
    SELECT 
        m.id_mahasiswa,
        m.nim,
        m.nama,
        m.prodi,
        m.jurusan,
        m.kelas,
        m.email
    FROM mahasiswa m
    ORDER BY m.nama ASC
");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="../assets/css/mahasiswa.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


</head>

<body>
    <div class="main-wrapper">

        <?php include "../components_admin/sidebar.php"; ?>
        <?php include "../components_admin/topbar.php"; ?>

        <div class="main-content">
            <div class="content-container">

                <h2>Data Mahasiswa</h2>
                <p class="page-desc">
                    Daftar mahasiswa yang terdaftar di sistem akademik.
                </p>

                <div class="table-wrapper">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Program Studi</th>
                                <th>Jurusan</th>
                                <th>Kelas</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; while ($row = mysqli_fetch_assoc($query)) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $row['nim']; ?></td>
                                <td><?= $row['nama']; ?></td>
                                <td><?= $row['prodi']; ?></td>
                                <td><?= $row['jurusan']; ?></td>
                                <td><?= $row['kelas']; ?></td>
                                <td><?= $row['email']; ?></td>
                                <td class="aksi">
                                    <a href="edit_mahasiswa.php?id=<?= $row['id_mahasiswa']; ?>"
                                        class="btn-edit">Edit</a>
                                    <a href="reset_password.php?id=<?= $row['id_mahasiswa']; ?>" class="btn-reset"
                                        onclick="return confirm('Reset password mahasiswa ke NIM?')">
                                        Reset
                                    </a>
                                    <a href="hapus_mahasiswa.php?id=<?= $row['id_mahasiswa']; ?>" class="btn-hapus"
                                        onclick="return confirm('Yakin ingin menghapus data mahasiswa ini?')">
                                        Hapus
                                    </a>
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

    <script src="../assets/js/script3.js"></script>

</body>

</html>

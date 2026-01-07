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
        m.shift,
        m.semester,
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

            <h2>Data Mahasiswa</h2>
            <p class="page-desc">Daftar mahasiswa yang terdaftar di sistem akademik.</p>

            <!-- ===== NOTIFIKASI ===== -->
            <?php if (isset($_GET['reset']) && $_GET['reset'] == 'success'): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    Password mahasiswa berhasil direset ke <b>NIM</b>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['hapus']) && $_GET['hapus'] == 'success'): ?>
                <div class="alert alert-danger">
                    <i class="fas fa-trash"></i>
                    Data mahasiswa berhasil dihapus
                </div>
            <?php endif; ?>

            <!-- ===== AKSI ===== -->
            <div class="action-bar">
                <a href="tambah_mahasiswa.php" class="btn-primary">
                    <i class="fa-solid fa-user-plus"></i> Tambah Mahasiswa
                </a>

                <a href="import_mahasiswa.php" class="btn-secondary">
                    <i class="fa-solid fa-file-excel"></i> Import Excel
                </a>
            </div>

            <!-- ===== FILTER ===== -->
            <div class="filter-bar">
                
                <select id="filterProdi">
                    <option value="">Semua Prodi</option>
                    <option value="Teknik Informatika">Teknik Informatika</option>
                    <option value="Teknik Multimedia">Teknik Multimedia</option>
                </select>

                <select id="filterJurusan">
                    <option value="">Semua Jurusan</option>
                    <option value="Teknik Informatika">Teknik Informatika</option>
                </select>
                
                <select id="filterKelas">
                    <option value="">Semua Kelas</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                    <option value="E">E</option>
                </select>
                <select id="filterShift">
                    <option value="">Semua Shift</option>
                    <option value="Pagi">Pagi</option>
                    <option value="Malam">Malam</option>
                </select>
                <select id="filterSemester">
                    <option value="">Semua Semester</option>
                    <?php for($i=1;$i<=8;$i++): ?>
                        <option value="<?= $i ?>"><?= $i ?></option>
                    <?php endfor; ?>
                </select>
                <input type="text" id="searchData" placeholder="Cari Nama / NIM...">
            </div>

            <small id="jumlahData"></small>

            <!-- ===== TABEL ===== -->
            <div class="table-wrapper">
                <table class="data-table" id="tabelMahasiswa">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Program Studi</th>
                            <th>Jurusan</th>
                            <th>Kelas</th>
                            <th>Shift</th>
                            <th>Semester</th>
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
                            <td><?= $row['shift']; ?></td>
                            <td><?= $row['semester']; ?></td>
                            <td><?= $row['email']; ?></td>
                            <td class="aksi">
                                <div class="aksi-wrap">
                                    <a href="edit_mahasiswa.php?id=<?= $row['id_mahasiswa']; ?>" class="btn-edit">Edit</a>
                                    <a href="reset_password_mahasiswa.php?id=<?= $row['id_mahasiswa']; ?>" class="btn-reset"
                                    onclick="return confirm('Reset password mahasiswa ke NIM?')">Reset</a>
                                    <a href="hapus_mahasiswa.php?id=<?= $row['id_mahasiswa']; ?>" class="btn-hapus"
                                    onclick="return confirm('Yakin ingin menghapus data mahasiswa ini?')">Hapus</a>
                                </div>
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

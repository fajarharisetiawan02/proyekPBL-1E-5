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

    <link rel="stylesheet" href="../assets/css/mahasiswa.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        .action-bar {
            display: flex;
            gap: 12px;
            margin: 15px 0;
        }

        .btn-primary {
            background: #2563eb;
            color: #fff;
            padding: 9px 14px;
            border-radius: 6px;
            font-size: 14px;
            text-decoration: none;
        }

        .btn-secondary {
            background: #16a34a;
            color: #fff;
            padding: 9px 14px;
            border-radius: 6px;
            font-size: 14px;
            text-decoration: none;
        }

        .filter-bar {
            display: flex;
            gap: 12px;
            margin: 10px 0 20px;
            flex-wrap: wrap;
        }

        .filter-bar select,
        .filter-bar input {
            padding: 8px 12px;
            border-radius: 6px;
            border: 1px solid #ddd;
            font-size: 14px;
        }

        .filter-bar input {
            width: 220px;
        }

        /* ALERT */
        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin: 12px 0 15px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .alert-success {
            background: #ecfdf5;
            color: #065f46;
            border: 1px solid #34d399;
        }

        .alert-danger {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #f87171;
        }
    </style>
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
                                <a href="edit_mahasiswa.php?id=<?= $row['id_mahasiswa']; ?>" class="btn-edit">Edit</a>
                                <a href="reset_password.php?id=<?= $row['id_mahasiswa']; ?>" class="btn-reset"
                                   onclick="return confirm('Reset password mahasiswa ke NIM?')">Reset</a>
                                <a href="hapus_mahasiswa.php?id=<?= $row['id_mahasiswa']; ?>" class="btn-hapus"
                                   onclick="return confirm('Yakin ingin menghapus data mahasiswa ini?')">Hapus</a>
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

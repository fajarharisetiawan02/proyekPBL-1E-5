<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";

<<<<<<< HEAD
/* ===== AMBIL DATA DOSEN ===== */
$query = mysqli_query($koneksi, "
    SELECT 
        id_admin,
        nidn,
        nama,
        prodi,
        jabatan,
        email,
        role,
        status
    FROM admin
    WHERE role IN ('dosen','kaprodi')
    ORDER BY nama ASC
");
=======
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
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
?>

<!DOCTYPE html>
<html lang="id">
<head>
<<<<<<< HEAD
<meta charset="UTF-8">
<title>Data Dosen</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="icon" href="../assets/img/Logo Politeknik.png">
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
<p class="page-desc">Daftar dosen yang terdaftar di sistem akademik.</p>

<!-- NOTIF -->
<?php if(isset($_GET['reset']) && $_GET['reset']=='success'): ?>
<div class="alert alert-success">
    <i class="fas fa-check-circle"></i>
    Password dosen berhasil direset ke <b>NIDN</b>
</div>
<?php endif; ?>

<?php if(isset($_GET['hapus']) && $_GET['hapus']=='success'): ?>
<div class="alert alert-danger">
    <i class="fas fa-trash"></i>
    Data dosen berhasil dihapus
</div>
<?php endif; ?>

<!-- AKSI -->
<div class="action-bar">
    <a href="tambah_dosen.php" class="btn-primary">
        <i class="fa-solid fa-user-plus"></i> Tambah Dosen
    </a>
</div>

<!-- FILTER -->
<div class="filter-bar">
    <select id="filterProdi">
        <option value="">Semua Prodi</option>
        <option value="Teknik Informatika">Teknik Informatika</option>
        <option value="Teknik Multimedia">Teknik Multimedia</option>
    </select>

    <select id="filterRole">
        <option value="">Semua Role</option>
        <option value="dosen">Dosen</option>
        <option value="kaprodi">Kaprodi</option>
    </select>

    <input type="text" id="searchData" placeholder="Cari Nama / NIDN...">
</div>

<!-- TABEL -->
<div class="table-wrapper">
<table class="data-table" id="tabelDosen">
<thead>
<tr>
    <th>No</th>
    <th>NIDN</th>
    <th>Nama</th>
    <th>Program Studi</th>
    <th>Jabatan</th>
    <th>Email</th>
    <th>Role</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>
</thead>
<tbody>
<?php $no=1; while($row=mysqli_fetch_assoc($query)): ?>
<tr>
<td><?= $no++ ?></td>
<td><?= $row['nidn'] ?></td>
<td><?= $row['nama'] ?></td>
<td><?= $row['prodi'] ?></td>
<td><?= $row['jabatan'] ?></td>
<td><?= $row['email'] ?></td>
<td><?= ucfirst($row['role']) ?></td>
<td>
<span class="badge <?= $row['status']=='aktif'?'badge-aktif':'badge-nonaktif' ?>">
<?= ucfirst($row['status']) ?>
</span>
</td>
<td class="aksi">
<a href="edit_dosen.php?id=<?= $row['id_admin'] ?>" class="btn-edit">Edit</a>
<a href="reset_password_dosen.php?id=<?= $row['id_admin'] ?>"
   class="btn-reset"
   onclick="return confirm('Reset password dosen ke NIDN?')">Reset</a>
<a href="hapus_dosen.php?id=<?= $row['id_admin'] ?>"
   class="btn-hapus"
   onclick="return confirm('Yakin hapus data dosen?')">Hapus</a>
</td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>

</div>
</div>
=======
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
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
</div>

<footer>
© 2025 Aplikasi Pengumuman Akademik Online | Politeknik Negeri Batam
</footer>

<<<<<<< HEAD
<script src="../assets/js/script3.js"></script>
=======
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
</body>
</html>

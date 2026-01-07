<?php
require_once "../config/auth_admin.php";
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
require_once "../config/auth_admin.php";
>>>>>>> 9a567987dd90af1392f8d15dfcbd79423ecb4815
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
require_once "../config/koneksi.php";

/* ======================
   AMBIL PARAMETER FILTER
====================== */
$jurusan  = $_GET['jurusan']  ?? '';
$prodi    = $_GET['prodi']    ?? '';
$kelas    = $_GET['kelas']    ?? '';
$shift    = $_GET['shift']    ?? '';
$semester = $_GET['semester'] ?? '';
$search   = $_GET['search']   ?? '';

$isFiltered = ($jurusan || $prodi || $kelas || $shift || $semester || $search);
$data = false;

/* ======================
   QUERY DATA
====================== */
if ($isFiltered) {
    $where = [];

    if ($jurusan)  $where[] = "jurusan='$jurusan'";
    if ($prodi)    $where[] = "prodi='$prodi'";
    if ($kelas)    $where[] = "kelas='$kelas'";
    if ($shift)    $where[] = "shift='$shift'";
    if ($semester) $where[] = "semester='$semester'";

    if ($search) {
        $search = mysqli_real_escape_string($koneksi, $search);
        $where[] = "(mata_kuliah LIKE '%$search%' OR dosen LIKE '%$search%')";
    }

    $sql = "SELECT * FROM perubahan_kelas";
    if ($where) {
        $sql .= " WHERE " . implode(" AND ", $where);
    }
    $sql .= " ORDER BY tanggal_perubahan DESC";

    $data = mysqli_query($koneksi, $sql);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Perubahan Kelas - Admin</title>
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
     <meta name="viewport" content="width=device-width, initial-scale=1.0">

         <link rel="icon" type="image/png" href="../assets/img/Logo Politeknik.png">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
<link rel="stylesheet" href="../assets/css/style4.css">
<link rel="stylesheet" href="../assets/css/sidebar.css">
<link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
<<<<<<< HEAD
=======
=======

<link rel="stylesheet" href="../assets/css/style4.css">
<link rel="stylesheet" href="../assets/css/sidebar.css">
<link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
</head>

<body>

<div class="main-wrapper">

<<<<<<< HEAD
<?php include "../components_admin/sidebar.php"; ?>
<?php include "../components_admin/topbar.php"; ?>
=======
<<<<<<< HEAD
<?php include "../components_admin/sidebar.php"; ?>
<?php include "../components_admin/topbar.php"; ?>
=======
<<<<<<< HEAD
<?php include "../components_admin/sidebar.php"; ?>
<?php include "../components_admin/topbar.php"; ?>
=======
    <?php include "../components_admin/sidebar.php"; ?>
    <?php include "../components_admin/topbar.php"; ?>
>>>>>>> 9a567987dd90af1392f8d15dfcbd79423ecb4815
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717

<div class="main-content">
<div class="content-container">

<!-- ===== FILTER & SEARCH (SAMA DENGAN JADWAL UJIAN) ===== -->
<div class="form-card" style="margin-bottom:20px;">
<h4 class="form-section-title">
<i class="fa-solid fa-filter"></i> Filter & Pencarian Perubahan Kelas
</h4>

<form method="GET" class="form-grid">

<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
<div class="search-wrapper">
    <i class="fa fa-search"></i>
    <input type="text" name="search"
        placeholder="Cari mata kuliah / dosen"
        value="<?= htmlspecialchars($search); ?>">
</div>
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
=======
            <!-- ===== TABEL ===== -->
            <div class="table-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Mata Kuliah</th>
                            <th>Kelas Asal</th>
                            <th>Kelas Baru</th>
                            <th>Dosen</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
>>>>>>> 9a567987dd90af1392f8d15dfcbd79423ecb4815
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717

<select name="jurusan">
<option value="">Semua Jurusan</option>
<?php foreach (["Manajemen Bisnis","Teknik Elektro","Teknik Informatika","Teknik Mesin"] as $j): ?>
<option value="<?= $j ?>" <?= $jurusan==$j?'selected':'' ?>><?= $j ?></option>
<?php endforeach; ?>
</select>

<select name="prodi">
<option value="">Semua Prodi</option>
<?php
$prodiList = [
"D3 Akuntansi","D4 Akuntansi Manajerial","D4 Administrasi Bisnis Terapan",
"D3 Teknik Informatika","D4 Rekayasa Perangkat Lunak","D4 Animasi",
"D4 Teknologi Permainan","Magister Terapan (S2) / Teknik Komputer"
];
foreach ($prodiList as $p):
?>
<option value="<?= $p ?>" <?= $prodi==$p?'selected':'' ?>><?= $p ?></option>
<?php endforeach; ?>
</select>

<select name="kelas">
<option value="">Semua Kelas</option>
<?php foreach (['A','B','C','D','E'] as $k): ?>
<option value="<?= $k ?>" <?= $kelas==$k?'selected':'' ?>><?= $k ?></option>
<?php endforeach; ?>
</select>

<select name="shift">
<option value="">Semua Shift</option>
<option value="Pagi" <?= $shift=='Pagi'?'selected':'' ?>>Pagi</option>
<option value="Malam" <?= $shift=='Malam'?'selected':'' ?>>Malam</option>
</select>

<select name="semester">
<option value="">Semua Semester</option>
<?php for($i=1;$i<=8;$i++): ?>
<option value="<?= $i ?>" <?= $semester==$i?'selected':'' ?>><?= $i ?></option>
<?php endfor; ?>
</select>

<button class="btn-primary">
<i class="fa fa-search"></i> Terapkan
</button>

</form>
</div>

<<<<<<< HEAD
<!-- ===== HEADER (SAMA DENGAN JADWAL UJIAN) ===== -->
<div class="header-admin">
<h3>Data Perubahan Kelas</h3>
=======
<<<<<<< HEAD
<!-- ===== HEADER (SAMA DENGAN JADWAL UJIAN) ===== -->
<div class="header-admin">
<h3>Data Perubahan Kelas</h3>
=======
<<<<<<< HEAD
<!-- ===== HEADER (SAMA DENGAN JADWAL UJIAN) ===== -->
<div class="header-admin">
<h3>Data Perubahan Kelas</h3>
=======
<footer>
    © 2025 Aplikasi Pengumuman Akademik Online | Politeknik Negeri Batam
</footer>
>>>>>>> 9a567987dd90af1392f8d15dfcbd79423ecb4815
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717

<a href="tambah_perubahan_kelas.php" class="btn-add">
<i class="fa fa-plus"></i> Tambah Perubahan Kelas
</a>
</div>

<!-- ===== TABEL ===== -->
<div class="table-wrapper">
<table class="admin-table">
<thead>
<tr>
<th width="50">No</th>
<th>Tanggal</th>
<th>Mata Kuliah</th>
<th>Kelas Asal</th>
<th>Kelas Baru</th>
<th>Dosen</th>
<th width="120">Aksi</th>
</tr>
</thead>

<tbody>
<?php
if (!$isFiltered) {
    echo "<tr>
        <td colspan='7' class='empty-table'>
        <i class='fa-solid fa-circle-info'></i><br>
        Silakan gunakan filter untuk menampilkan data perubahan kelas
        </td>
    </tr>";
}
elseif ($data && mysqli_num_rows($data) == 0) {
    echo "<tr>
        <td colspan='7' class='empty-table'>
        Data tidak ditemukan
        </td>
    </tr>";
}
else {
    $no = 1;
    while ($row = mysqli_fetch_assoc($data)) {
?>
<tr>
<td><?= $no++; ?></td>
<td><?= date('d M Y', strtotime($row['tanggal_perubahan'])); ?></td>

<td>
<strong><?= $row['mata_kuliah']; ?></strong><br>
<small>
Kelas <?= $row['kelas']; ?> | <?= $row['shift']; ?> | Smt <?= $row['semester']; ?>
</small>
</td>

<td><span class="badge badge-asal"><?= $row['kelas_asal']; ?></span></td>
<td><span class="badge badge-baru"><?= $row['kelas_baru']; ?></span></td>
<td><?= $row['dosen']; ?></td>

<td class="text-center">
<a href="edit_perubahan_kelas.php?id=<?= $row['id_kelas']; ?>"
   class="btn-icon btn-edit">
<i class="fa fa-pen"></i>
</a>

<a href="hapus_perubahan_kelas.php?id=<?= $row['id_kelas']; ?>"
   class="btn-icon btn-delete"
   onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ujian ini?')">
<i class="fa fa-trash"></i>
</a>
</td>
</tr>
<?php } } ?>
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

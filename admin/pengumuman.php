<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";

/* ======================
   PARAMETER FILTER
====================== */
$kategori = $_GET['kategori'] ?? '';
$search   = $_GET['search']   ?? '';

$isFiltered = ($kategori || $search);
$data = false;

/* ======================
   QUERY DATA
====================== */
if ($isFiltered) {

    $where = [];

    if ($kategori) {
        $kategori = mysqli_real_escape_string($koneksi, $kategori);
        $where[] = "kategori = '$kategori'";
    }

    if ($search) {
        $search = mysqli_real_escape_string($koneksi, $search);
        $where[] = "(
            judul LIKE '%$search%' OR
            isi LIKE '%$search%'
        )";
    }

    $sql = "SELECT * FROM pengumuman";
    if ($where) {
        $sql .= " WHERE " . implode(" AND ", $where);
    }
    $sql .= " ORDER BY dibuat_pada DESC";

    $data = mysqli_query($koneksi, $sql);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Pengumuman - Admin</title>
<<<<<<< HEAD
     <meta name="viewport" content="width=device-width, initial-scale=1.0">

         <link rel="icon" type="image/png" href="../assets/img/Logo Politeknik.png">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
<link rel="stylesheet" href="../assets/css/pengumuman-admin.css">
<link rel="stylesheet" href="../assets/css/sidebar.css">
<link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
=======

<link rel="stylesheet" href="../assets/css/pengumuman-admin.css">
<link rel="stylesheet" href="../assets/css/sidebar.css">
<link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
</head>

<body>

<div class="main-wrapper">

<?php include "../components_admin/sidebar.php"; ?>
<?php include "../components_admin/topbar.php"; ?>

<div class="main-content">
<div class="content-container">

<!-- ===== FILTER ===== -->
<div class="form-card" style="margin-bottom:20px;">
<h4 class="form-section-title">
<i class="fa-solid fa-filter"></i> Filter & Pencarian Pengumuman
</h4>

<form method="GET" class="form-grid">

<div class="search-wrapper">
    <i class="fa fa-search"></i>
    <input type="text" name="search"
        placeholder="Cari judul / isi pengumuman"
        value="<?= htmlspecialchars($search); ?>">
</div>

<select name="kategori">
<option value="">Semua Kategori</option>
<?php foreach (['Akademik','Beasiswa','Ujian','Informasi'] as $k): ?>
<option value="<?= $k ?>" <?= $kategori==$k?'selected':'' ?>><?= $k ?></option>
<?php endforeach; ?>
</select>

<button class="btn-primary">
<i class="fa fa-search"></i> Terapkan
</button>

</form>
</div>

<!-- ===== HEADER ===== -->
<div class="header-admin">
<h3>Data Pengumuman</h3>

<a href="tambah_pengumuman.php" class="btn-add">
<i class="fa fa-plus"></i> Tambah Pengumuman
</a>
</div>

<!-- ===== TABLE ===== -->
<div class="table-wrapper">
<table class="admin-table">
<thead>
<tr>
<th width="50">No</th>
<th>Judul</th>
<th>Kategori</th>
<th>Tanggal</th>
<th width="120">Aksi</th>
</tr>
</thead>

<tbody>
<?php
if (!$isFiltered) {
    echo "<tr>
        <td colspan='5' class='empty-table'>
        <i class='fa-solid fa-circle-info'></i><br>
        Silakan gunakan filter untuk menampilkan pengumuman
        </td>
    </tr>";
}
elseif ($data && mysqli_num_rows($data) == 0) {
    echo "<tr>
        <td colspan='5' class='empty-table'>
        Data pengumuman tidak ditemukan
        </td>
    </tr>";
}
else {
    $no = 1;
    while ($row = mysqli_fetch_assoc($data)) {
?>
<tr>
<td><?= $no++; ?></td>
<td>
<strong><?= $row['judul']; ?></strong><br>
<small><?= substr(strip_tags($row['isi']), 0, 80); ?>...</small>
</td>
<td><?= $row['kategori']; ?></td>
<td><?= date("d M Y", strtotime($row['dibuat_pada'])); ?></td>
<td class="text-center">

<a href="detail_pengumuman.php?id=<?= $row['id_pengumuman']; ?>"
   class="btn-icon btn-detail" title="Detail">
<i class="fa fa-eye"></i>
</a>

<a href="edit_pengumuman.php?id=<?= $row['id_pengumuman']; ?>"
   class="btn-icon btn-edit">
<i class="fa fa-pen"></i>
</a>

<a href="hapus_pengumuman.php?id=<?= $row['id_pengumuman']; ?>"
   class="btn-icon btn-delete"
   onclick="return confirm('Hapus pengumuman ini?')">
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

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
   QUERY DATA (TIDAK DIUBAH)
====================== */
if ($isFiltered) {
    $where = [];

    if ($kategori) {
        $kategori = mysqli_real_escape_string($koneksi, $kategori);
        $where[] = "kategori = '$kategori'";
    }

    if ($search) {
        $search = mysqli_real_escape_string($koneksi, $search);
        $where[] = "(judul LIKE '%$search%' OR isi LIKE '%$search%')";
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
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="icon" href="../assets/img/Logo Politeknik.png">
<link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
<link rel="stylesheet" href="../assets/css/pengumuman-admin.css">
<link rel="stylesheet" href="../assets/css/sidebar.css">
<link rel="stylesheet" href="../assets/css/notifikasi+profil.css">

</head>

<body>

<div class="main-wrapper">
<?php include "../components_admin/sidebar.php"; ?>
<?php include "../components_admin/topbar.php"; ?>

<div class="main-content">
<div class="content-container">

<!-- ======================
     FILTER (TIDAK DIUBAH)
====================== -->
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

<!-- HEADER (TIDAK DIUBAH) -->
<div class="header-admin">
  <div>
<h2>
  <i class="fa-solid fa-bullhorn"></i>
  Pengumuman
</h2>
<small class="page-desc">
Kelola, cari, dan pantau seluruh pengumuman akademik & non-akademik
</small>
</div>

<a href="tambah_pengumuman.php" class="btn-add">
<i class="fa fa-plus"></i> Tambah Pengumuman
</a>
</div>

<!-- TABLE (TIDAK DIUBAH) -->
<div class="table-wrapper">
<table class="admin-table">
<thead>
<tr>
<th>No</th>
<th>Judul</th>
<th>Kategori</th>
<th>Tanggal</th>
<th>Aksi</th>
</tr>
</thead>
<tbody>
<?php
if (!$isFiltered) {
    echo "<tr><td colspan='5' class='empty-table'>
        <i class='fa-solid fa-circle-info'></i><br>
    Silakan gunakan filter untuk menampilkan pengumuman
    </td></tr>";
}
elseif ($data && mysqli_num_rows($data) == 0) {
    echo "<tr><td colspan='5' class='empty-table'>
    Data pengumuman tidak ditemukan
    </td></tr>";
}
else {

$no=1;
while($row=mysqli_fetch_assoc($data)){
?>
<tr>
<td><?= $no++ ?></td>
<td>
<strong><?= htmlspecialchars($row['judul']) ?></strong><br>
<small><?= htmlspecialchars(substr(strip_tags($row['isi']),0,80)) ?>...</small>
</td>
<td><?= htmlspecialchars($row['kategori']) ?></td>
<td><?= date('d M Y',strtotime($row['dibuat_pada'])) ?></td>
<td class="text-center">
<div class="action-wrapper">
<button class="btn-icon btn-detail"
onclick="openModal('modal<?= $row['id_pengumuman'] ?>')">
<i class="fa fa-eye"></i>
</button>
<a href="edit_pengumuman.php?id=<?= $row['id_pengumuman'] ?>"
class="btn-icon btn-edit"><i class="fa fa-pen"></i></a>
<a href="hapus_pengumuman.php?id=<?= $row['id_pengumuman'] ?>"
class="btn-icon btn-delete"
onclick="return confirm('Hapus pengumuman ini?')">
<i class="fa fa-trash"></i></a>
</div>
</td>
</tr>

<!-- MODAL DETAIL -->
<div class="modal-custom" id="modal<?= $row['id_pengumuman'] ?>">
<div class="modal-content" onclick="event.stopPropagation()">

<div class="modal-header">
<h5><?= htmlspecialchars($row['judul']) ?></h5>
<button class="close-modal"
onclick="closeModal('modal<?= $row['id_pengumuman'] ?>')">&times;</button>
</div>

<div class="modal-body">
<strong>Pengumuman:</strong>
<p><?= nl2br(htmlspecialchars($row['isi'])) ?></p>
<hr>
<strong>Kategori:</strong>
<p><?= ucfirst($row['kategori']) ?></p>
<hr>
<strong>Dibuat Pada:</strong>
<p><?= date('d M Y',strtotime($row['dibuat_pada'])) ?></p>
</div>

<div class="modal-footer">
<button class="btn-close-modal"
onclick="closeModal('modal<?= $row['id_pengumuman'] ?>')">
Tutup
</button>
</div>

</div>
</div>

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

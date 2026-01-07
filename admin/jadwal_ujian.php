<?php
require_once "../config/auth_admin.php";
<<<<<<< HEAD
require_once "../config/koneksi.php";

date_default_timezone_set('Asia/Jakarta');

/* ======================
   HELPER HARI INDONESIA
====================== */
function hariIndo($tanggal) {
    $hari = date('l', strtotime($tanggal));
    $map = [
        'Monday'    => 'Senin',
        'Tuesday'   => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday'  => 'Kamis',
        'Friday'    => 'Jumat',
        'Saturday'  => 'Sabtu',
        'Sunday'    => 'Minggu'
    ];
    return $map[$hari] ?? $hari;
}

/* ======================
   PARAMETER FILTER
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
require_once "../config/auth_admin.php";
>>>>>>> 9a567987dd90af1392f8d15dfcbd79423ecb4815
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
require_once "../config/koneksi.php";

/* ======================
   AMBIL PARAMETER FILTER
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
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
        $where[] = "(
            mata_kuliah LIKE '%$search%' OR
            dosen LIKE '%$search%' OR
            ruang LIKE '%$search%'
        )";
    }

    $sql = "SELECT * FROM jadwal_ujian";
    if ($where) {
        $sql .= " WHERE " . implode(" AND ", $where);
    }
    $sql .= " ORDER BY tanggal ASC, waktu_mulai ASC";

    $data = mysqli_query($koneksi, $sql);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Jadwal Ujian - Admin</title>
<<<<<<< HEAD
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="icon" type="image/png" href="../assets/img/Logo Politeknik.png">
<link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
<link rel="stylesheet" href="../assets/css/style3.css">
<link rel="stylesheet" href="../assets/css/sidebar.css">
<link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
=======
<<<<<<< HEAD
     <meta name="viewport" content="width=device-width, initial-scale=1.0">

         <link rel="icon" type="image/png" href="../assets/img/Logo Politeknik.png">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
<link rel="stylesheet" href="../assets/css/style3.css">
<link rel="stylesheet" href="../assets/css/sidebar.css">
<link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
=======

<link rel="stylesheet" href="../assets/css/style3.css">
<link rel="stylesheet" href="../assets/css/sidebar.css">
<link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
</head>

<body>

<div class="main-wrapper">

<?php include "../components_admin/sidebar.php"; ?>
<?php include "../components_admin/topbar.php"; ?>

<div class="main-content">
<div class="content-container">

<<<<<<< HEAD
<!-- FILTER -->
=======
<!-- ===== FILTER & SEARCH ===== -->
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
<div class="form-card" style="margin-bottom:20px;">
<h4 class="form-section-title">
<i class="fa-solid fa-filter"></i> Filter & Pencarian Jadwal Ujian
</h4>

<form method="GET" class="form-grid">

<div class="search-wrapper">
    <i class="fa fa-search"></i>
    <input type="text" name="search"
        placeholder="Cari mata kuliah / dosen / ruang"
        value="<?= htmlspecialchars($search); ?>">
</div>

<select name="jurusan">
<option value="">Semua Jurusan</option>
<?php foreach(["Manajemen Bisnis","Teknik Elektro","Teknik Informatika","Teknik Mesin"] as $j): ?>
<option value="<?= $j ?>" <?= $jurusan==$j?'selected':'' ?>><?= $j ?></option>
<?php endforeach; ?>
</select>

<select name="prodi">
<option value="">Semua Prodi</option>
<?php
$prodiList=[
"D3 Akuntansi","D4 Rekayasa Perangkat Lunak","D4 Animasi",
"D3 Teknik Informatika","D4 Teknologi Permainan"
];
foreach($prodiList as $p):
?>
<option value="<?= $p ?>" <?= $prodi==$p?'selected':'' ?>><?= $p ?></option>
<?php endforeach; ?>
</select>

<select name="kelas">
<option value="">Semua Kelas</option>
<?php foreach(['A','B','C','D','E'] as $k): ?>
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
<!-- HEADER -->
<div class="header-admin">
    <div>
        <h2>
            <i class="fa-solid fa-calendar-days"></i>
            Jadwal Ujian
        </h2>
        <small class="page-desc">
            Kelola dan pantau jadwal ujian mahasiswa berdasarkan jurusan, kelas, dan semester
        </small>
    </div>

    <div>
        <a href="tambah_jadwal.php" class="btn-add">
            <i class="fa fa-plus"></i> Tambah Jadwal Ujian
        </a>

        <?php if ($isFiltered && $prodi): ?>
        <a href="kirim_notifikasi_jadwal.php
        ?jurusan=<?= urlencode($jurusan) ?>
        &prodi=<?= urlencode($prodi) ?>
        &kelas=<?= urlencode($kelas) ?>
        &shift=<?= urlencode($shift) ?>
        &semester=<?= urlencode($semester) ?>"
        class="btn-kirim"
        onclick="return confirm('Kirim email jadwal ujian ke mahasiswa sesuai filter?')">
        📧 Kirim Email Jadwal
        </a>
        <?php endif; ?>

    </div>
</div>
<!-- TABEL -->
=======
<<<<<<< HEAD
<!-- ===== HEADER ===== -->
<div class="header-admin">
<h3>Data Jadwal Ujian</h3>
=======
<<<<<<< HEAD
<!-- ===== HEADER ===== -->
<div class="header-admin">
<h3>Data Jadwal Ujian</h3>
=======
<footer>
© 2025 Aplikasi Pengumuman Akademik Online | Politeknik Negeri Batam
</footer>
>>>>>>> 9a567987dd90af1392f8d15dfcbd79423ecb4815
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e

<div style="display:flex; gap:10px;">
<a href="tambah_jadwal.php" class="btn-add">
<i class="fa fa-plus"></i> Tambah Jadwal Ujian
</a>

<?php if ($isFiltered && $prodi): ?>
<a href="kirim_notifikasi_jadwal.php
?jurusan=<?= urlencode($jurusan) ?>
&prodi=<?= urlencode($prodi) ?>
&kelas=<?= urlencode($kelas) ?>
&shift=<?= urlencode($shift) ?>
&semester=<?= urlencode($semester) ?>"
   class="btn-primary"
   onclick="return confirm('Kirim email jadwal ujian ke mahasiswa sesuai filter?')">
   📧 Kirim Email Jadwal
</a>
<?php endif; ?>
</div>

</div>

<!-- ===== TABEL ===== -->
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
<div class="table-wrapper">
<table class="admin-table">
<thead>
<tr>
    <th>No</th>
<<<<<<< HEAD
    <th>Hari</th>
    <th>Tanggal</th>
    <th>Waktu</th>
=======
    <th>Tanggal & Waktu</th>
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
    <th>Mata Kuliah</th>
    <th>Ruang</th>
    <th>Dosen</th>
    <th>Aksi</th>
</tr>
</thead>

<<<<<<< HEAD
<tbody>
<?php
if(!$isFiltered){
    echo "<tr><td colspan='8' class='empty-table'>
=======

<tbody>
<?php
if(!$isFiltered){
    echo "<tr><td colspan='6' class='empty-table'>
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
    <i class='fa-solid fa-circle-info'></i><br>
    Silakan gunakan filter untuk menampilkan jadwal ujian
    </td></tr>";
}elseif($data && mysqli_num_rows($data)==0){
<<<<<<< HEAD
    echo "<tr><td colspan='8' class='empty-table'>Data tidak ditemukan</td></tr>";
=======
    echo "<tr><td colspan='6' class='empty-table'>Data tidak ditemukan</td></tr>";
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
}else{
    $no=1;
    while($row=mysqli_fetch_assoc($data)){
?>
<tr>
    <td><?= $no++; ?></td>

<<<<<<< HEAD
    <!-- 🔥 SATU-SATUNYA PERUBAHAN -->
    <td><strong><?= $row['hari']; ?></strong></td>

    <td><?= date("d M Y", strtotime($row['tanggal'])); ?></td>
    <td>
        <?= date('H:i', strtotime($row['waktu_mulai'])); ?> -
        <?= date('H:i', strtotime($row['waktu_selesai'])); ?>
    </td>
    <td><strong><?= $row['mata_kuliah']; ?></strong></td>
    <td><?= $row['ruang']; ?></td>
    <td><?= $row['dosen']; ?></td>
=======
    <!-- TANGGAL & WAKTU -->
    <td>
        <?= date("d M Y",strtotime($row['tanggal'])); ?><br>
       <?= date('H:i', strtotime($row['waktu_mulai'])); ?> – <?= date('H:i', strtotime($row['waktu_selesai'])); ?>
    </td>

    <!-- MATA KULIAH -->
    <td><strong><?= $row['mata_kuliah']; ?></strong></td>

    <!-- RUANG -->
    <td><?= $row['ruang']; ?></td>

    <!-- DOSEN -->
    <td><?= $row['dosen']; ?></td>

    <!-- AKSI -->
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
    <td>
        <a href="edit_jadwal.php?id=<?= $row['id_jadwal_ujian']; ?>" class="btn-icon btn-edit">
            <i class="fa fa-pen"></i>
        </a>
        <a href="hapus_jadwal.php?id=<?= $row['id_jadwal_ujian']; ?>"
           class="btn-icon btn-delete"
           onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ujian ini?')">
            <i class="fa fa-trash"></i>
        </a>
    </td>
</tr>
<?php } } ?>
</tbody>
<<<<<<< HEAD
=======

>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
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
<<<<<<< HEAD
</html>
=======
</html>
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717

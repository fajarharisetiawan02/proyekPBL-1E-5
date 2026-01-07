<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";

/* ===============================
   RINGKASAN DATA
=============================== */
$total_beasiswa = mysqli_num_rows(mysqli_query($koneksi, "SELECT id_beasiswa FROM beasiswa"));
$aktif = mysqli_num_rows(mysqli_query($koneksi, "SELECT id_beasiswa FROM beasiswa WHERE status='aktif'"));
$nonaktif = $total_beasiswa - $aktif;
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Beasiswa - Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="icon" type="image/png" href="../assets/img/Logo Politeknik.png">
<link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
<link rel="stylesheet" href="../assets/css/style5.css">
<link rel="stylesheet" href="../assets/css/sidebar.css">
<link rel="stylesheet" href="../assets/css/box_lihatdetail.css">
<link rel="stylesheet" href="../assets/css/notifikasi+profil.css">

</head>

<body>
<div class="main-wrapper">

<?php include "../components_admin/sidebar.php"; ?>
<?php include "../components_admin/topbar.php"; ?>

<div class="main-content">
<div class="content-container">

<!-- HEADER -->
<div class="header-section header-beasiswa">
    <div>
       <h2>
            <i class="fas fa-award"></i>
            Beasiswa
        </h2>
        <div class="page-desc">
            Kelola informasi beasiswa yang tersedia untuk mahasiswa
        </div>
    </div>

    <a href="tambah_beasiswa.php" class="btn-add btn-tambah-beasiswa">
        <i class="fa-solid fa-plus"></i> Tambah Beasiswa
    </a>
</div>

<!-- SUMMARY -->
<div class="beasiswa-summary">
    <div class="summary-item">
        <span>Total Beasiswa</span>
        <strong><?= $total_beasiswa; ?></strong>
    </div>

    <div class="summary-item active">
        <span>Aktif</span>
        <strong><?= $aktif; ?></strong>
    </div>

    <div class="summary-item inactive">
        <span>Ditutup</span>
        <strong><?= $nonaktif; ?></strong>
    </div>
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
    <th width="140">Aksi</th>
</tr>
</thead>
<tbody>

<?php
$no = 1;
$data = mysqli_query($koneksi, "SELECT * FROM beasiswa ORDER BY created_at DESC");

if (mysqli_num_rows($data) == 0) {
    echo "<tr>
        <td colspan='6' class='empty-table'>
            <i class='fa-solid fa-circle-info'></i><br>
            Belum ada data beasiswa
        </td>
    </tr>";
}

while ($row = mysqli_fetch_assoc($data)) {

    $statusBadge = ($row['status'] === 'aktif')
        ? "<span class='badge-aktif'>Aktif</span>"
        : "<span class='badge-nonaktif'>Ditutup</span>";
?>
<tr>
<td><?= $no++; ?></td>
<td><strong><?= htmlspecialchars($row['nama_beasiswa']); ?></strong></td>
<td><?= $row['periode'] ?: '-'; ?></td>
<td><?= date('d M Y', strtotime($row['tanggal_buka'])); ?></td>
<td><?= $statusBadge; ?></td>
<td class="text-center">

<span class="btn-icon btn-detail"
      onclick='openBeasiswa(
        <?= json_encode($row["nama_beasiswa"]) ?>,
        <?= json_encode($row["deskripsi"]) ?>,
        <?= json_encode($row["syarat"]) ?>,
        <?= json_encode($row["periode"]) ?>,
        <?= json_encode(date("d M Y", strtotime($row["tanggal_buka"]))) ?>,
        <?= json_encode(date("d M Y", strtotime($row["tanggal_tutup"]))) ?>
      )'>
    <i class="fa fa-eye"></i>
</span>

<a href="edit_beasiswa.php?id=<?= $row['id_beasiswa']; ?>" class="btn-icon btn-edit">
    <i class="fa-solid fa-pen"></i>
</a>

<a href="hapus_beasiswa.php?id=<?= $row['id_beasiswa']; ?>"
   onclick="return confirm('Apakah Anda yakin ingin menghapus beasiswa ini?');"
   class="btn-icon btn-delete">
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

<!-- MODAL DETAIL BEASISWA (SAMA PERSIS MAHASISWA) -->
<div class="modal" id="modalBeasiswa">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">

      <div class="modal-header bg-primary">
        <h5 class="modal-title text-white" id="bJudul"></h5>
        <button type="button" class="btn-close btn-close-white" onclick="closeBeasiswa()"></button>
      </div>

      <div class="modal-body">
        <strong>Deskripsi:</strong>
        <p id="bDeskripsi"></p>

        <hr>

        <strong>Syarat:</strong>
        <p id="bSyarat"></p>

        <hr>

        <strong>Periode:</strong> <span id="bPeriode"></span><br>
        <strong>Tanggal:</strong> <span id="bTanggal"></span>
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" onclick="closeBeasiswa()">Tutup</button>
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

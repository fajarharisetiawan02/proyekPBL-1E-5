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

<link rel="stylesheet" href="../assets/css/style5.css">
<link rel="stylesheet" href="../assets/css/sidebar.css">
<link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
<link rel="stylesheet" href="../assets/css/beasiswa-modal.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>
/* ===============================
   HEADER & SUMMARY
================================ */
.header-beasiswa {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 10px;
    position: relative;
}

.page-desc {
    font-size: 14px;
    color: #6b7280;
    margin-top: 4px;
}

.btn-tambah-beasiswa {
    position: absolute;
    right: 0;
    top: 125px;   
}

.beasiswa-summary {
    display: flex;
    gap: 16px;
    margin-bottom: 22px;
}

.summary-item {
    background: #f8fafc;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    padding: 12px 18px;
    min-width: 140px;
}

.summary-item span {
    font-size: 12px;
    color: #6b7280;
}

.summary-item strong {
    display: block;
    font-size: 20px;
    margin-top: 2px;
    color: #111827;
}

.summary-item.active {
    background: #f0fdf4;
    border-color: #bbf7d0;
}

.summary-item.inactive {
    background: #fef2f2;
    border-color: #fecaca;
}

/* ===============================
   TABLE POLISH
================================ */
.admin-table td strong {
    font-size: 15px;
    font-weight: 600;
    color: #111827;
}

.admin-table tbody tr:hover {
    background: #f9fbff;
}

.badge-aktif {
    background: #dcfce7;
    color: #166534;
    padding: 5px 12px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 600;
}

.badge-nonaktif {
    background: #fee2e2;
    color: #991b1b;
    padding: 5px 12px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 600;
}

.btn-icon {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

</style>
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
        <h3>Beasiswa</h3>
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

<button class="btn-icon btn-detail"
    onclick="openDetail(
        '<?= addslashes($row['nama_beasiswa']); ?>',
        '<?= addslashes(nl2br($row['deskripsi'])); ?>',
        '<?= addslashes(nl2br($row['syarat'])); ?>',
        '<?= $row['periode']; ?>',
        '<?= date('d M Y', strtotime($row['tanggal_buka'])); ?>',
        '<?= date('d M Y', strtotime($row['tanggal_tutup'])); ?>',
        '<?= ucfirst($row['status']); ?>'
    )">
    <i class="fa-solid fa-eye"></i>
</button>

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

<!-- MODAL DETAIL -->
<div id="modalDetail" class="modal-overlay">
<div class="modal-box">
    <div class="modal-header">
        <h3 id="detailNama"></h3>
        <button class="modal-close" onclick="closeDetail()">&times;</button>
    </div>

    <div class="modal-body">
        <p class="label">Deskripsi</p>
        <div id="detailDeskripsi" class="modal-text"></div>

        <p class="label">Syarat</p>
        <div id="detailSyarat" class="modal-text"></div>

        <div class="modal-info">
            <p><strong>Periode:</strong> <span id="detailPeriode"></span></p>
            <p><strong>Tanggal:</strong> <span id="detailTanggal"></span></p>
            <p><strong>Status:</strong> <span id="detailStatus"></span></p>
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

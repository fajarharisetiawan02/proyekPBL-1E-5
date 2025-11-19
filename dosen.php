<?php 
include "koneksi.php";
?>

<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="admin.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<title>ADMINISTRATOR</title>
<style>
.nav-link:hover { background-color: gold; color: white !important; }
</style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-info fixed-top">
<div class="container-fluid">
    <a class="navbar-brand text-white" href="#">SELAMAT DATANG ADMIN</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="ms-auto d-flex align-items-center">
            <div class="icon">
                <i class="fas fa-envelope-square me-3"></i>
                <i class="fas fa-bell-slash me-3"></i>
                <i class="fas fa-user-circle me-3"></i>
                <i class="fas fa-sign-out-alt me-3"></i>
            </div>
        </div>
    </div>
</div>
</nav>

<div class="row g-0 mt-5">

<!-- Sidebar -->
<div class="col-md-2 bg-info mt-2 pt-4">
<ul class="nav flex-column ms-3 mb-5">
    <li class="nav-item">
        <a class="nav-link text-white" href="dashboard.php"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a><hr>
    </li>

    <li class="nav-item">
        <a class="nav-link text-white" href="dosen.php"><i class="fas fa-chalkboard-teacher me-2"></i>Daftar Dosen</a><hr>
    </li>
</ul>
</div>


<!-- Content -->
<div class="col-md-10 p-5 pt-2">
<h3><i class="fas fa-chalkboard-teacher me-2"></i> Daftar Dosen</h3><hr>

<button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#tambahdata">
<i class="fas fa-plus-circle me-2"></i> TAMBAH DATA DOSEN
</button>

<!-- Modal Tambah Data -->
<div class="modal fade" id="tambahdata" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Tambah Data Dosen</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <form action="tambah_dosen.php" method="POST">

          <div class="mb-3">
            <label for="nidn" class="form-label">NIDN</label>
            <input type="text" class="form-control" id="nidn" name="nidn" required>
          </div>

          <div class="mb-3">
            <label for="nama" class="form-label">Nama Dosen</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
          </div>

          <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" required>
          </div>

          <div class="mb-3">
            <label for="jabatan" class="form-label">Jabatan</label>
            <input type="text" class="form-control" id="jabatan" name="jabatan" required>
          </div>

          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>

      </div>
    </div>
  </div>
</div>


<!-- Tabel -->
<table class="table table-striped table-bordered mt-3">
<thead>
<tr>
    <th scope="col">NO</th>
    <th scope="col">NIDN</th>
    <th scope="col">NAMA</th>
    <th scope="col">ALAMAT</th>
    <th scope="col">JABATAN</th>
    <th scope="col">AKSI</th>
</tr>
</thead>

<tbody>

<?php
include 'koneksi.php';
$query = mysqli_query($koneksi, "SELECT * FROM dosen");
$no = 1;

while ($data = mysqli_fetch_assoc($query)) {
?>

<tr>
    <td><?= $no++; ?></td>
    <td><?= $data['nidn']; ?></td>
    <td><?= $data['nama']; ?></td>
    <td><?= $data['alamat']; ?></td>
    <td><?= $data['jabatan']; ?></td>
    <td></td>
</tr>

<?php } ?>
</tbody>
</table>

</div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

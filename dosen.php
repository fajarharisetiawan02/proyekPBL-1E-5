<?php
include "koneksi.php";

// -----------------------------
// HANDLE TAMBAH DATA
// -----------------------------
if (isset($_POST['tambah'])) {
    $nidn = $_POST['nidn'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $jabatan = $_POST['jabatan'];

    mysqli_query($koneksi, "INSERT INTO dosen VALUES('$nidn', '$nama', '$alamat', '$jabatan')");
    echo "<script>alert('Data berhasil ditambahkan'); window.location='dosen.php';</script>";
}

// -----------------------------
// HANDLE EDIT DATA
// -----------------------------
if (isset($_POST['edit'])) {
    $nidn_lama = $_POST['nidn_lama'];
    $nidn = $_POST['nidn'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $jabatan = $_POST['jabatan'];

    mysqli_query($koneksi, "
        UPDATE dosen SET 
        nidn='$nidn',
        nama='$nama',
        alamat='$alamat',
        jabatan='$jabatan'
        WHERE nidn='$nidn_lama'
    ");

    echo "<script>alert('Data berhasil diubah'); window.location='dosen.php';</script>";
}

// -----------------------------
// HANDLE HAPUS DATA
// -----------------------------
if (isset($_GET['hapus'])) {
    $nidn = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM dosen WHERE nidn='$nidn'");
    echo "<script>alert('Data berhasil dihapus'); window.location='dosen.php';</script>";
}

?>

<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<title>Data Dosen</title>
</head>

<body>

<div class="container mt-5">

<h3><i class="fas fa-chalkboard-teacher me-2"></i> Data Dosen</h3><hr>

<!-- Button Tambah -->
<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
    <i class="fas fa-plus-circle"></i> Tambah Dosen
</button>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Dosen</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST">
                <div class="modal-body">

                    <div class="mb-3">
                        <label>NIDN</label>
                        <input type="text" class="form-control" name="nidn" required>
                    </div>

                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>

                    <div class="mb-3">
                        <label>Alamat</label>
                        <input type="text" class="form-control" name="alamat" required>
                    </div>

                    <div class="mb-3">
                        <label>Jabatan</label>
                        <input type="text" class="form-control" name="jabatan" required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-success" name="tambah">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- TABEL DOSEN -->
<table class="table table-bordered table-striped">
<thead class="table-dark">
    <tr>
        <th>No</th>
        <th>NIDN</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Jabatan</th>
        <th>Aksi</th>
    </tr>
</thead>

<tbody>
<?php
$no = 1;
$query = mysqli_query($koneksi, "SELECT * FROM dosen ORDER BY nidn ASC");
while ($data = mysqli_fetch_assoc($query)) {
?>
<tr>
    <td><?= $no++; ?></td>
    <td><?= $data['nidn']; ?></td>
    <td><?= $data['nama']; ?></td>
    <td><?= $data['alamat']; ?></td>
    <td><?= $data['jabatan']; ?></td>

    <td>
        <!-- Button Edit -->
        <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
            data-bs-target="#edit<?= $data['nidn']; ?>">
            <i class="fas fa-edit"></i>
        </button>

        <!-- Button Hapus -->
        <a href="dosen.php?hapus=<?= $data['nidn']; ?>"
           onclick="return confirm('Yakin ingin menghapus data ini?');"
           class="btn btn-danger btn-sm">
            <i class="fas fa-trash"></i>
        </a>
    </td>
</tr>

<!-- Modal Edit -->
<div class="modal fade" id="edit<?= $data['nidn']; ?>">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Edit Data Dosen</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST">
                <div class="modal-body">

                    <input type="hidden" name="nidn_lama" value="<?= $data['nidn']; ?>">

                    <div class="mb-3">
                        <label>NIDN</label>
                        <input type="text" class="form-control" name="nidn" value="<?= $data['nidn']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama" value="<?= $data['nama']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label>Alamat</label>
                        <input type="text" class="form-control" name="alamat" value="<?= $data['alamat']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label>Jabatan</label>
                        <input type="text" class="form-control" name="jabatan" value="<?= $data['jabatan']; ?>" required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary" name="edit">Update</button>
                </div>
            </form>

        </div>
    </div>
</div>

<?php } ?>
</tbody>
</table>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

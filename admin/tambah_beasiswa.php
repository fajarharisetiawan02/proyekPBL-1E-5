<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";

if (isset($_POST['simpan'])) {

    $nama_beasiswa = $_POST['nama_beasiswa'];
    $deskripsi     = $_POST['deskripsi'];
    $syarat        = $_POST['syarat'];
    $periode       = $_POST['periode'];
    $tanggal_buka  = $_POST['tanggal_buka'];
    $tanggal_tutup = $_POST['tanggal_tutup'];
    $status        = $_POST['status'];

    $gambar = null;

    mysqli_query($koneksi, "
        INSERT INTO beasiswa 
        (nama_beasiswa, deskripsi, syarat, periode, tanggal_buka, tanggal_tutup, gambar, status)
        VALUES 
        ('$nama_beasiswa','$deskripsi','$syarat','$periode',
         '$tanggal_buka','$tanggal_tutup','$gambar','$status')
    ");

    header("Location: beasiswa.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Beasiswa</title>

    <link rel="stylesheet" href="../assets/css/style4.css">
        <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
</head>

<body>
<div class="main-wrapper">

<?php include "../components_admin/sidebar.php"; ?>
<?php include "../components_admin/topbar.php"; ?>

<div class="main-content">
<div class="content-container">

    <div class="form-header">
        <h3>Tambah Beasiswa</h3>
        <p>Gunakan form ini untuk menambahkan informasi beasiswa yang akan ditampilkan kepada mahasiswa.</p>
    </div>

    <form method="POST" class="form-card">

        <h4 class="form-section-title">
            <i class="fa-solid fa-graduation-cap"></i> Informasi Beasiswa
        </h4>

        <div class="form-group">
            <label>Nama Beasiswa</label>
            <input type="text" name="nama_beasiswa"
                   placeholder="Contoh: Beasiswa Unggulan 2025" required>
        </div>

        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" rows="4"
                placeholder="Jelaskan tujuan dan gambaran singkat beasiswa" required></textarea>
        </div>

        <div class="form-group">
            <label>Syarat Beasiswa</label>
            <textarea name="syarat" rows="4"
                placeholder="Contoh: IPK minimal 3.00, aktif kuliah, tidak menerima beasiswa lain" required></textarea>
        </div>

        <h4 class="form-section-title">
            <i class="fa-solid fa-calendar-days"></i> Periode & Status
        </h4>

        <div class="form-grid">
            <div class="form-group">
                <label>Periode</label>
                <input type="text" name="periode"
                       placeholder="Contoh: 2025 / Ganjil 2025" required>
            </div>

            <div class="form-group">
                <label>Tanggal Buka</label>
                <input type="date" name="tanggal_buka" required>
            </div>

            <div class="form-group">
                <label>Tanggal Tutup</label>
                <input type="date" name="tanggal_tutup" required>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status" required>
                    <option value="aktif">Aktif</option>
                    <option value="nonaktif">Nonaktif</option>
                </select>
                <small class="text-muted">
                    Status aktif berarti beasiswa akan ditampilkan ke mahasiswa
                </small>
            </div>
        </div>

        <div class="form-action">
            <button type="submit" name="simpan" class="btn-primary">
                <i class="fa-solid fa-save"></i> Simpan
            </button>
            <a href="beasiswa.php" class="btn-danger">
                <i class="fa-solid fa-xmark"></i> Batal
            </a>
        </div>

    </form>

</div>
</div>
</div>

<footer>
© 2025 Aplikasi Pengumuman Akademik Online | Politeknik Negeri Batam
</footer>

</body>
</html>

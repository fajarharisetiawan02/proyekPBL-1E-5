<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";

if (!isset($_GET['id'])) {
    header("Location: beasiswa.php");
    exit;
}

$id = $_GET['id'];

// Ambil data beasiswa
$query = mysqli_query($koneksi, "SELECT * FROM beasiswa WHERE id_beasiswa='$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    die("Beasiswa tidak ditemukan!");
}

// PROSES UPDATE
if (isset($_POST['update'])) {

    $nama_beasiswa = $_POST['nama_beasiswa'];
    $deskripsi     = $_POST['deskripsi'];
    $syarat        = $_POST['syarat'];
    $periode       = $_POST['periode'];
    $tanggal_buka  = $_POST['tanggal_buka'];
    $tanggal_tutup = $_POST['tanggal_tutup'];
    $status        = $_POST['status'];

    $update = mysqli_query($koneksi, "
        UPDATE beasiswa SET
            nama_beasiswa   = '$nama_beasiswa',
            deskripsi       = '$deskripsi',
            syarat          = '$syarat',
            periode         = '$periode',
            tanggal_buka    = '$tanggal_buka',
            tanggal_tutup   = '$tanggal_tutup',
            status          = '$status',
            updated_at      = NOW()
        WHERE id_beasiswa = '$id'
    ");

    if ($update) {
        echo "<script>
                alert('Data beasiswa berhasil diperbarui!');
                window.location='beasiswa.php';
              </script>";
    } else {
        echo "<script>alert('Gagal mengupdate data beasiswa!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Beasiswa</title>

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
                    <h3>Edit Beasiswa</h3>
                    <p>Perbarui informasi beasiswa yang akan ditampilkan kepada mahasiswa.</p>
                </div>

                <form method="POST" class="form-card">

                    <h4 class="form-section-title">
                        <i class="fa-solid fa-graduation-cap"></i> Informasi Beasiswa
                    </h4>

                    <div class="form-group">
                        <label>Nama Beasiswa</label>
                        <input type="text" name="nama_beasiswa" value="<?= htmlspecialchars($data['nama_beasiswa']) ?>"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" rows="4"
                            required><?= htmlspecialchars($data['deskripsi']) ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Syarat Beasiswa</label>
                        <textarea name="syarat" rows="4" required><?= htmlspecialchars($data['syarat']) ?></textarea>
                    </div>

                    <h4 class="form-section-title">
                        <i class="fa-solid fa-calendar-days"></i> Periode & Status
                    </h4>

                    <div class="form-grid">
                        <div class="form-group">
                            <label>Periode</label>
                            <input type="text" name="periode" value="<?= htmlspecialchars($data['periode']) ?>"
                                required>
                        </div>

                        <div class="form-group">
                            <label>Tanggal Buka</label>
                            <input type="date" name="tanggal_buka" value="<?= $data['tanggal_buka'] ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Tanggal Tutup</label>
                            <input type="date" name="tanggal_tutup" value="<?= $data['tanggal_tutup'] ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" required>
                                <option value="aktif" <?= $data['status']=='aktif'?'selected':'' ?>>Aktif</option>
                                <option value="nonaktif" <?= $data['status']=='nonaktif'?'selected':'' ?>>Nonaktif
                                </option>
                            </select>
                            <small class="text-muted">
                                Status aktif berarti beasiswa akan ditampilkan ke mahasiswa
                            </small>
                        </div>
                    </div>

                    <div class="form-action">
                        <button type="submit" name="update" class="btn-primary">
                            <i class="fa-solid fa-save"></i> Update
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
    <script src="../assets/js/script3.js"></script>
</body>

</html>

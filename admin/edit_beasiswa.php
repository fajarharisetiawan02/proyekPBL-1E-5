<?php
require_once "../config/auth.php";
require_once "../config/koneksi.php";


// --- Ambil ID dari URL ---
if (!isset($_GET['id'])) {
    header("Location: beasiswa.php");
    exit;
}

$id = $_GET['id'];

// --- Ambil data beasiswa berdasarkan ID ---
$query = mysqli_query($koneksi, "SELECT * FROM beasiswa WHERE id_beasiswa='$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    die("Beasiswa tidak ditemukan!");
}

if (isset($_POST['update'])) {
    
    $nama_beasiswa = $_POST['nama_beasiswa'];
    $deskripsi     = $_POST['deskripsi'];
    $syarat        = $_POST['syarat'];
    $periode       = $_POST['periode'];
    $tanggal_buka  = $_POST['tanggal_buka'];
    $tanggal_tutup = $_POST['tanggal_tutup'];
    $status        = $_POST['status'];

    $update = mysqli_query($koneksi, 
        "UPDATE beasiswa SET 
            nama_beasiswa='$nama_beasiswa',
            deskripsi='$deskripsi',
            syarat='$syarat',
            periode='$periode',
            tanggal_buka='$tanggal_buka',
            tanggal_tutup='$tanggal_tutup',
            status='$status',
            updated_at = NOW()
        WHERE id_beasiswa='$id'"
    );

    if ($update) {
        echo "<script>
                alert('Data beasiswa berhasil diperbarui!');
                window.location='beasiswa.php';
              </script>";
    } else {
        echo "<script>alert('Gagal mengupdate data!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Beasiswa</title>
    <link rel="stylesheet" href="../assets/css/style5.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
</head>

<body>

    <div class="main-wrapper">

        <?php include "../components_admin/sidebar.php"; ?>
        <?php include "../components_admin/topbar.php"; ?>

        <div class="main-content">

            <div class="content-container">

                <div class="header-section">
                    <h3>Edit Beasiswa</h3>
                </div>

                <form method="POST" class="form-box">

                    <label>Nama Beasiswa</label>
                    <input type="text" name="nama_beasiswa" value="<?= $data['nama_beasiswa']; ?>" required>

                    <label>Deskripsi</label>
                    <textarea name="deskripsi" required rows="4"><?= $data['deskripsi']; ?></textarea>

                    <label>Syarat</label>
                    <textarea name="syarat" required rows="4"><?= $data['syarat']; ?></textarea>

                    <label>Periode</label>
                    <input type="text" name="periode" value="<?= $data['periode']; ?>" required>

                    <label>Tanggal Buka</label>
                    <input type="date" name="tanggal_buka" value="<?= $data['tanggal_buka']; ?>" required>

                    <label>Tanggal Tutup</label>
                    <input type="date" name="tanggal_tutup" value="<?= $data['tanggal_tutup']; ?>" required>

                    <label>Status</label>
                    <select name="status">
                        <option value="aktif" <?= ($data['status'] == "aktif") ? "selected" : ""; ?>>Aktif</option>
                        <option value="nonaktif" <?= ($data['status'] == "nonaktif") ? "selected" : ""; ?>>Nonaktif
                        </option>
                    </select>

                    <div class="btn-area">
                        <button type="submit" name="update" class="btn-add">Update</button>
                        <a href="beasiswa.php" class="btn-cancel">Batal</a>
                    </div>

                </form>

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

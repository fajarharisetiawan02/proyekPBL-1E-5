<?php
require_once "../config/koneksi.php";

if (!isset($_GET['id'])) {
    header("Location: perkuliahan.php");
    exit;
}

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM perkuliahan WHERE id_perkuliahan='$id'");
$row  = mysqli_fetch_assoc($data);

if (!$row) {
    echo "Data tidak ditemukan!";
    exit;
}

if (isset($_POST['update'])) {

    $mata_kuliah = $_POST['mata_kuliah'];
    $tanggal     = $_POST['tanggal'];
    $waktu       = $_POST['waktu'];
    $dosen       = $_POST['dosen'];
    $ket         = $_POST['ket'];

    mysqli_query($koneksi, 
        "UPDATE perkuliahan SET 
            mata_kuliah='$mata_kuliah',
            tanggal='$tanggal',
            waktu='$waktu',
            dosen='$dosen',
            ket='$ket'
         WHERE id_perkuliahan='$id'"
    );

    header("Location: perkuliahan.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Perkuliahan</title>

    <link rel="stylesheet" href="../assets/css/style3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
</head>

<body>

    <div class="main-wrapper">

        <?php include "../components_admin/sidebar.php"; ?>
        <?php include "../components_admin/topbar.php"; ?>

        <div class="main-content">

            <div class="content-container">

                <div class="header-section">
                    <h3>Edit Perkuliahan</h3>
                </div>

                <form method="POST" class="form-box">

                    <label>Mata Kuliah</label>
                    <input type="text" name="mata_kuliah" value="<?= $row['mata_kuliah']; ?>" required>

                    <label>Tanggal</label>
                    <input type="date" name="tanggal" value="<?= $row['tanggal']; ?>" required>

                    <label>Waktu</label>
                    <input type="time" name="waktu" value="<?= $row['waktu']; ?>" required>

                    <label>Dosen</label>
                    <input type="text" name="dosen" value="<?= $row['dosen']; ?>" required>

                    <label>Keterangan</label>
                    <input type="text" name="ket" value="<?= $row['ket']; ?>">

                    <div class="btn-area">
                        <button type="submit" name="update" class="btn-add">Update</button>
                        <a href="perkuliahan.php" class="btn-cancel">Batal</a>
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

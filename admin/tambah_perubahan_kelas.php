<?php
require_once "../config/auth.php";
require_once "../config/koneksi.php";

if (isset($_POST['simpan'])) {

    $mata_kuliah        = $_POST['mata_kuliah'];
    $tanggal_perubahan = $_POST['tanggal_perubahan'];
    $kelas_asal         = $_POST['kelas_asal'];
    $kelas_baru         = $_POST['kelas_baru'];
    $dosen              = $_POST['dosen'];

    mysqli_query($koneksi, "INSERT INTO perubahan_kelas 
        (mata_kuliah, tanggal_perubahan, kelas_asal, kelas_baru, dosen)
        VALUES ('$mata_kuliah', '$tanggal_perubahan', '$kelas_asal', '$kelas_baru', '$dosen')");

    header("Location: perubahan_kelas.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tambah Perubahan Kelas</title>

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
                    <h3>Tambah Perubahan Kelas</h3>
                </div>

                <form method="POST" class="form-box">

                    <label>Mata Kuliah</label>
                    <input type="text" name="mata_kuliah" required>

                    <label>Tanggal Perubahan</label>
                    <input type="date" name="tanggal_perubahan" required>

                    <label>Kelas Asal</label>
                    <input type="text" name="kelas_asal" required>

                    <label>Kelas Baru</label>
                    <input type="text" name="kelas_baru" required>

                    <label>Dosen</label>
                    <input type="text" name="dosen" required>

                    <div class="btn-area">
                        <button type="submit" name="simpan" class="btn-add">Simpan</button>
                        <a href="perubahan_kelas.php" class="btn-cancel">Batal</a>
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

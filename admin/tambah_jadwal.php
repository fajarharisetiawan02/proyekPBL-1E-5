<?php
require_once "../config/koneksi.php";

if (isset($_POST['simpan'])) {
    $mata_kuliah = $_POST['mata_kuliah'];
    $tanggal     = $_POST['tanggal'];
    $waktu       = $_POST['waktu'];
    $ruang       = $_POST['ruang'];
    $dosen       = $_POST['dosen'];

    mysqli_query($koneksi, "INSERT INTO jadwal_ujian (mata_kuliah, tanggal, waktu, ruang, dosen)
                            VALUES ('$mata_kuliah', '$tanggal', '$waktu', '$ruang', '$dosen')");

    header("Location: jadwal_ujian.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tambah Jadwal Ujian</title>

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
                    <h3>Tambah Jadwal Ujian</h3>
                </div>

                <form method="POST" class="form-box">

                    <label>Mata Kuliah</label>
                    <input type="text" name="mata_kuliah" required>

                    <label>Tanggal</label>
                    <input type="date" name="tanggal" required>

                    <label>Waktu</label>
                    <input type="time" name="waktu" required>

                    <label>Ruang</label>
                    <input type="text" name="ruang" required>

                    <label>Dosen</label>
                    <input type="text" name="dosen" required>

                    <div class="btn-area">
                        <button type="submit" name="simpan" class="btn-add">Simpan</button>
                        <a href="jadwal_ujian.php" class="btn-cancel">Batal</a>
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

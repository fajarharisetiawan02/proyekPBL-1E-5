<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";

if (isset($_POST['simpan'])) {

    $mata_kuliah        = $_POST['mata_kuliah'];
    $tanggal_perubahan  = $_POST['tanggal_perubahan'];
    $jurusan            = $_POST['jurusan'];
    $prodi              = $_POST['prodi'];
    $kelas              = $_POST['kelas'];
    $shift              = $_POST['shift'];
    $semester           = $_POST['semester'];
    $kelas_asal         = $_POST['kelas_asal'];
    $kelas_baru         = $_POST['kelas_baru'];
    $dosen              = $_POST['dosen'];

    mysqli_query($koneksi, "
        INSERT INTO perubahan_kelas
        (mata_kuliah, tanggal_perubahan, jurusan, prodi, kelas, shift, semester, kelas_asal, kelas_baru, dosen)
        VALUES
        ('$mata_kuliah', '$tanggal_perubahan', '$jurusan', '$prodi', '$kelas', '$shift', '$semester',
         '$kelas_asal', '$kelas_baru', '$dosen')
    ");

    header("Location: perubahan_kelas.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Perubahan Kelas</title>

    <link rel="stylesheet" href="../assets/css/style5.css">
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
                    <h3>Tambah Perubahan Kelas</h3>
                    <p>
                        Gunakan form ini untuk mencatat perubahan kelas yang telah ditetapkan.
                    </p>
                </div>


                <form method="POST" class="form-card">

                    <h4 class="form-section-title">
                        <i class="fa-solid fa-graduation-cap"></i> Informasi Akademik
                    </h4>

                    <div class="form-grid">

                        <div class="form-group">
                            <label>Jurusan</label>
                            <select name="jurusan" required>
                                <option value="">Pilih Jurusan</option>
                                <option>Manajemen Bisnis</option>
                                <option>Teknik Elektro</option>
                                <option>Teknik Informatika</option>
                                <option>Teknik Mesin</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Program Studi</label>
                            <select name="prodi" required>
                                <option value="">Pilih Prodi</option>
                                <option>D3 Akuntansi</option>
                                <option>D4 Akuntansi Manajerial</option>
                                <option>D4 Administrasi Bisnis Terapan</option>
                                <option>D3 Teknik Informatika</option>
                                <option>D4 Rekayasa Perangkat Lunak</option>
                                <option>D4 Animasi</option>
                                <option>D4 Teknologi Permainan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Kelas</label>
                            <select name="kelas" required>
                                <option value="">Pilih Kelas</option>
                                <option>A</option>
                                <option>B</option>
                                <option>C</option>
                                <option>D</option>
                                <option>E</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Shift</label>
                            <select name="shift" required>
                                <option value="">Pilih Shift</option>
                                <option>Pagi</option>
                                <option>Malam</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Semester</label>
                            <select name="semester" required>
                                <option value="">Pilih Semester</option>
                                <?php for($i=1;$i<=8;$i++): ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>

                    </div>

                    <h4 class="form-section-title">
                        <i class="fa-solid fa-arrows-left-right"></i> Informasi Perubahan Kelas
                    </h4>

                    <div class="form-grid">

                        <div class="form-group full">
                            <label>Mata Kuliah</label>
                            <input type="text" name="mata_kuliah" placeholder="Contoh: Dasar Pemrograman" required>
                        </div>

                        <div class="form-group">
                            <label>Tanggal Perubahan</label>
                            <input type="date" name="tanggal_perubahan" required>
                        </div>

                        <div class="form-group">
                            <label>Dosen</label>
                            <input type="text" name="dosen" placeholder="Nama Dosen" required>
                        </div>

                        <div class="form-group">
                            <label>Kelas Asal</label>
                            <input type="text" name="kelas_asal" placeholder="Contoh: A Pagi" required>
                        </div>

                        <div class="form-group">
                            <label>Kelas Baru</label>
                            <input type="text" name="kelas_baru" placeholder="Contoh: E Malam" required>
                        </div>

                    </div>

                    <div class="form-action">
                        <button type="submit" name="simpan" class="btn-primary">
                            <i class="fa-solid fa-save"></i> Simpan
                        </button>
                        <a href="perubahan_kelas.php" class="btn-danger">
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

<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";

if (!isset($_GET['id'])) {
    header("Location: jadwal_ujian.php");
    exit;
}

$id = $_GET['id'];

$data = mysqli_query($koneksi, "SELECT * FROM jadwal_ujian WHERE id_jadwal_ujian='$id'");
$row  = mysqli_fetch_assoc($data);

if (!$row) {
    echo "Data tidak ditemukan";
    exit;
}

if (isset($_POST['update'])) {

    $mata_kuliah = $_POST['mata_kuliah'];
    $jurusan     = $_POST['jurusan'];
    $prodi       = $_POST['prodi'];
    $kelas       = $_POST['kelas'];
    $shift       = $_POST['shift'];
    $semester    = $_POST['semester'];
    $tanggal     = $_POST['tanggal'];
    $waktu_mulai   = $_POST['waktu_mulai'];
    $waktu_selesai = $_POST['waktu_selesai'];
    $ruang       = $_POST['ruang'];
    $dosen       = $_POST['dosen'];

    mysqli_query($koneksi, "
    UPDATE jadwal_ujian SET
        tanggal='$tanggal',
        waktu_mulai='$waktu_mulai',
        waktu_selesai='$waktu_selesai',
        ruang='$ruang',
        dosen='$dosen'
    WHERE id_jadwal_ujian='$id'
");


    header("Location: jadwal_ujian.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Jadwal Ujian</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/png" href="../assets/img/Logo Politeknik.png">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style3.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
<<<<<<< HEAD
    <link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
=======
<<<<<<< HEAD
    <link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
=======
<<<<<<< HEAD
=======
    <link rel="stylesheet" href="../assets/css/sidebar.css">
>>>>>>> 9a567987dd90af1392f8d15dfcbd79423ecb4815
    <link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
</head>

<body>
    <div class="main-wrapper">

        <?php include "../components_admin/sidebar.php"; ?>
        <?php include "../components_admin/topbar.php"; ?>

        <div class="main-content">
            <div class="content-container">

                <div class="form-header">
                    <h3>Edit Jadwal Ujian</h3>
                    <p>
                        Perbarui informasi jadwal ujian yang sudah ada.
                        Pastikan data yang diubah sudah sesuai sebelum disimpan.
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
                                <?php
                            $jurusanList = [
                                "Manajemen Bisnis",
                                "Teknik Elektro",
                                "Teknik Informatika",
                                "Teknik Mesin"
                            ];
                            foreach ($jurusanList as $j) {
                                $sel = $row['jurusan'] == $j ? 'selected' : '';
                                echo "<option value='$j' $sel>$j</option>";
                            }
                            ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Program Studi</label>
                            <select name="prodi" required>
                                <option value="">Pilih Prodi</option>
                                <?php
                            $prodiList = [
                                "D3 Akuntansi",
                                "D4 Akuntansi Manajerial",
                                "D4 Administrasi Bisnis Terapan",
                                "D3 Teknik Informatika",
                                "D4 Rekayasa Perangkat Lunak",
                                "D4 Animasi",
                                "D4 Teknologi Permainan"
                            ];
                            foreach ($prodiList as $p) {
                                $sel = $row['prodi'] == $p ? 'selected' : '';
                                echo "<option value='$p' $sel>$p</option>";
                            }
                            ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Kelas</label>
                            <select name="kelas" required>
                                <option value="">Pilih Kelas</option>
                                <?php foreach (['A','B','C','D','E'] as $k): ?>
                                <option value="<?= $k ?>" <?= $row['kelas']==$k?'selected':'' ?>>
                                    <?= $k ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Shift</label>
                            <select name="shift" required>
                                <option value="">Pilih Shift</option>
                                <option value="Pagi" <?= $row['shift']=='Pagi'?'selected':'' ?>>Pagi</option>
                                <option value="Malam" <?= $row['shift']=='Malam'?'selected':'' ?>>Malam</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Semester</label>
                            <select name="semester" required>
                                <option value="">Pilih Semester</option>
                                <?php for($i=1;$i<=8;$i++): ?>
                                <option value="<?= $i ?>" <?= $row['semester']==$i?'selected':'' ?>>
                                    <?= $i ?>
                                </option>
                                <?php endfor; ?>
                            </select>
                        </div>

                    </div>

                    <h4 class="form-section-title">
                        <h4 class="form-section-title">
                            <i class="fa-solid fa-calendar-days"></i> Informasi Ujian
                        </h4>

                        <div class="form-grid">
                            <div class="form-group full">
                                <label>Mata Kuliah</label>
                                <input type="text" name="mata_kuliah" placeholder="Contoh: Dasar Pemrograman Web"
                                    required>
                            </div>

                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" required>
                            </div>

                            <div class="form-group">
                                <label>Waktu Mulai</label>
                                <input type="time" name="waktu_mulai" required>
                            </div>

                            <div class="form-group">
                                <label>Waktu Selesai</label>
                                <input type="time" name="waktu_selesai" required>
                            </div>

                            <div class="form-group">
                                <label>Ruang</label>
                                <input type="text" name="ruang" placeholder="Contoh: Lab BQ11" required>
                            </div>

                            <div class="form-group">
                                <label>Dosen</label>
                                <input type="text" name="dosen" placeholder="Contoh: Nama Dosen" required>
                            </div>
                        </div>

                        <div class="form-action">
                            <button type="submit" name="update" class="btn-primary">
                                <i class="fa-solid fa-save"></i> Update
                            </button>
                            <a href="jadwal_ujian.php" class="btn-danger">
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

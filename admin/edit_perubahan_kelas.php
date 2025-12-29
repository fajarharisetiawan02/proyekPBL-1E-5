<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";

if (!isset($_GET['id'])) {
    header("Location: perubahan_kelas.php");
    exit;
}

$id = $_GET['id'];

$data = mysqli_query($koneksi, "SELECT * FROM perubahan_kelas WHERE id_kelas='$id'");
$row  = mysqli_fetch_assoc($data);

if (!$row) {
    echo "Data tidak ditemukan!";
    exit;
}

if (isset($_POST['update'])) {

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
        UPDATE perubahan_kelas SET
            mata_kuliah='$mata_kuliah',
            tanggal_perubahan='$tanggal_perubahan',
            jurusan='$jurusan',
            prodi='$prodi',
            kelas='$kelas',
            shift='$shift',
            semester='$semester',
            kelas_asal='$kelas_asal',
            kelas_baru='$kelas_baru',
            dosen='$dosen'
        WHERE id_kelas='$id'
    ");

    header("Location: perubahan_kelas.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Perubahan Kelas</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">

<<<<<<< HEAD
    <link rel="icon" type="image/png" href="../assets/img/Logo Politeknik.png">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style4.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
=======
<<<<<<< HEAD
    <link rel="stylesheet" href="../assets/css/style4.css">
=======
    <link rel="stylesheet" href="../assets/css/style5.css">
>>>>>>> 9a567987dd90af1392f8d15dfcbd79423ecb4815
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
</head>

<body>
    <div class="main-wrapper">

        <?php include "../components_admin/sidebar.php"; ?>
        <?php include "../components_admin/topbar.php"; ?>

        <div class="main-content">
            <div class="content-container">

                <div class="form-header">
                    <h3>Edit Perubahan Kelas</h3>
                    <p>
                        Gunakan form ini untuk memperbarui data perubahan kelas yang telah dibuat.
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
                        <i class="fa-solid fa-arrows-left-right"></i> Informasi Perubahan Kelas
                    </h4>

                    <div class="form-grid">

                        <div class="form-group full">
                            <label>Mata Kuliah</label>
                            <input type="text" name="mata_kuliah" value="<?= htmlspecialchars($row['mata_kuliah']); ?>"
                                required>
                        </div>

                        <div class="form-group">
                            <label>Tanggal Perubahan</label>
                            <input type="date" name="tanggal_perubahan" value="<?= $row['tanggal_perubahan']; ?>"
                                required>
                        </div>

                        <div class="form-group">
                            <label>Dosen</label>
                            <input type="text" name="dosen" value="<?= htmlspecialchars($row['dosen']); ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Kelas Asal</label>
                            <input type="text" name="kelas_asal" value="<?= htmlspecialchars($row['kelas_asal']); ?>"
                                required>
                        </div>

                        <div class="form-group">
                            <label>Kelas Baru</label>
                            <input type="text" name="kelas_baru" value="<?= htmlspecialchars($row['kelas_baru']); ?>"
                                required>
                        </div>

                    </div>

                    <div class="form-action">
                        <button type="submit" name="update" class="btn-primary">
                            <i class="fa-solid fa-save"></i> Update
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

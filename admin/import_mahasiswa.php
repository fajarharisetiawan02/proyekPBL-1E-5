<?php
session_start();
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";
require_once "../vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\IOFactory;

$success = 0;
$failed  = 0;

if (isset($_POST['import'])) {

    if (!isset($_FILES['file_excel']) || $_FILES['file_excel']['error'] !== 0) {
        die("File tidak valid");
    }

    $file_tmp = $_FILES['file_excel']['tmp_name'];
    $spreadsheet = IOFactory::load($file_tmp);
    $sheet = $spreadsheet->getActiveSheet();
    $rows = $sheet->toArray();

    mysqli_begin_transaction($koneksi);

    for ($i = 1; $i < count($rows); $i++) {

        // AMBIL DATA DARI EXCEL (WAJIB)

        $nim = trim($rows[$i][0]);
        $nama    = trim($rows[$i][1] ?? '');
        $prodi   = trim($rows[$i][2] ?? '-');
        $jurusan = trim($rows[$i][3] ?? '-');
        $kelas   = trim($rows[$i][4] ?? '-');
        $email   = trim($rows[$i][5] ?? '');

        // VALIDASI WAJIB
        if ($nim === '' || $nama === '') {
            $failed++;
            continue;
        }

        // AUTO EMAIL JIKA KOSONG
        if ($email === '') {
            $email = $nim . '@student.local';
        }

        // CEK DUPLIKAT NIM
        $cek = mysqli_query($koneksi, "SELECT id_mahasiswa FROM mahasiswa WHERE nim='$nim'");
        if (mysqli_num_rows($cek) > 0) {
            $failed++;
            continue;
        }

        // INSERT MAHASISWA

mysqli_query($koneksi, "
    INSERT INTO mahasiswa (nim, nama, prodi, jurusan, kelas, email)
    VALUES ('$nim', '$nama', '$prodi', '$jurusan', '$kelas', '$email')
");


        $id_mahasiswa = mysqli_insert_id($koneksi);

        // BUAT AKUN LOGIN

        $password = password_hash($nim, PASSWORD_DEFAULT);

mysqli_query($koneksi, "
    INSERT INTO login (username, password, nama, role, email, id_mahasiswa)
    VALUES ('$nim', '$password', '$nama', 'mahasiswa', '$email', '$id_mahasiswa')
");


        $success++;
    }

    mysqli_commit($koneksi);

    header("Location: import_mahasiswa.php?success=$success&failed=$failed");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Import Mahasiswa</title>
<<<<<<< HEAD
         <meta name="viewport" content="width=device-width, initial-scale=1.0">

         <link rel="icon" type="image/png" href="../assets/img/Logo Politeknik.png">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/mahasiswa.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
=======
    <link rel="stylesheet" href="../assets/css/mahasiswa.css">
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

                <h2>Import Data Mahasiswa</h2>
                <p class="page-desc">
                    Upload file Excel untuk menambahkan data mahasiswa sekaligus membuat akun login.
                </p>

                <?php if (isset($_GET['success'])) : ?>
                <div class="alert-success">
                    ✅ Berhasil diimport: <?= $_GET['success']; ?> data <br>
                    ❌ Duplikat NIM: <?= $_GET['failed']; ?> data
                </div>
                <?php endif; ?>

                <form method="POST" enctype="multipart/form-data" class="form-box">

                    <label>File Excel (.xlsx)</label>
                    <input type="file" name="file_excel" accept=".xlsx" required>

                    <small class="hint">
                        Format kolom: nim, nama, prodi, jurusan, kelas, email
                    </small>

                    <div class="form-action">
                        <button type="submit" name="import">Import Data</button>
                        <a href="mahasiswa.php" class="btn-cancel">Kembali</a>
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

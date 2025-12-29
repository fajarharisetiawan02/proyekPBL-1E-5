<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";

if (isset($_POST['simpan'])) {

    $judul    = trim($_POST['judul']);
    $isi      = trim($_POST['isi']);
    $kategori = $_POST['kategori'];
    $tanggal  = date('Y-m-d');
    $untuk_mahasiswa = NULL;

    // INSERT PENGUMUMAN

    $stmt = mysqli_prepare(
        $koneksi,
        "INSERT INTO pengumuman (judul, isi, kategori, dibuat_pada, untuk_mahasiswa)
         VALUES (?, ?, ?, ?, ?)"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "ssssi",
        $judul,
        $isi,
        $kategori,
        $tanggal,
        $untuk_mahasiswa
    );

    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // SIMPAN AKTIVITAS ADMIN

    $id_login  = $_SESSION['id_login'];
    $aktivitas = "Menambahkan pengumuman: $judul";

    mysqli_query($koneksi, "
        INSERT INTO aktivitas_admin (id_login, aktivitas)
        VALUES ('$id_login', '$aktivitas')
    ");

    // REDIRECT

    header("Location: dashboard.php?notif=pengumuman");
    exit;
}
?>

?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Pengumuman</title>
<<<<<<< HEAD
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="icon" type="image/png" href="../assets/img/Logo Politeknik.png">
<link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
<link rel="stylesheet" href="../assets/css/pengumuman.css">
<link rel="stylesheet" href="../assets/css/sidebar.css">
<link rel="stylesheet" href="../assets/css/notifikasi+profil.css">

=======
<link rel="stylesheet" href="../assets/css/pengumuman.css">
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

            <h2>Edit Pengumuman</h2>
            <p class="page-desc">
                Buat pengumuman akademik yang akan ditampilkan kepada mahasiswa.
            </p>

            <form method="POST" class="form-box">

                <label>Judul Pengumuman</label>
                <input type="text"
                       name="judul"
                       placeholder="Contoh: Jadwal UTS Semester Ganjil"
                       required>

                <label>Kategori</label>
                <select name="kategori" required>
                    <option value="">-- Pilih Kategori --</option>
                    <option value="Akademik">Akademik</option>
                    <option value="Perkuliahan">Perkuliahan</option>
                    <option value="Beasiswa">Beasiswa</option>
                    <option value="Umum">Umum</option>
                </select>

                <small class="hint">
                    Pilih kategori sesuai jenis informasi yang disampaikan.
                </small>

                <label>Isi Pengumuman</label>
                <textarea name="isi"
                          rows="6"
                          placeholder="Tulis detail pengumuman di sini..."
                          required></textarea>

                <small class="hint">
                    Pengumuman akan ditampilkan kepada seluruh mahasiswa.
                </small>

                <div class="form-action">
                    <button type="submit" name="simpan">
                        Simpan Pengumuman
                    </button>
                    <a href="dashboard.php" class="btn-cancel">
                        Kembali
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

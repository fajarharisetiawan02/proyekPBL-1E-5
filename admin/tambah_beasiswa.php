<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";
require_once "../config/email_helper.php";
require_once "../admin/kirim_notifikasi_beasiswa.php";
<<<<<<< HEAD
require_once "../admin/kirim_notifikasi_web.php";
require_once "../config/helper_aktivitas.php";
=======
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717

/* ===============================
   PROSES SIMPAN (POST)
================================ */
if (isset($_POST['simpan'])) {

<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
    $nama_beasiswa = mysqli_real_escape_string($koneksi, $_POST['nama_beasiswa']);
    $deskripsi     = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $syarat        = mysqli_real_escape_string($koneksi, $_POST['syarat']);
    $periode       = mysqli_real_escape_string($koneksi, $_POST['periode']);
    $tanggal_buka  = $_POST['tanggal_buka'];
    $tanggal_tutup = $_POST['tanggal_tutup'];
    $status        = $_POST['status'];
    $gambar        = null;

<<<<<<< HEAD
    // Validasi tanggal (LOGIKA SAJA, TAMPILAN TIDAK BERUBAH)
    if ($tanggal_buka > $tanggal_tutup) {
        header("Location: tambah_beasiswa.php?error=tanggal");
        exit;
    }

    mysqli_begin_transaction($koneksi);

    try {

        /* ===============================
           1. SIMPAN BEASISWA
        ================================ */
        mysqli_query($koneksi, "
            INSERT INTO beasiswa
            (nama_beasiswa, deskripsi, syarat, periode,
             tanggal_buka, tanggal_tutup, gambar, status)
            VALUES
            ('$nama_beasiswa','$deskripsi','$syarat','$periode',
             '$tanggal_buka','$tanggal_tutup','$gambar','$status')
        ");

        /* ===============================
           2. AKTIVITAS ADMIN
        ================================ */
        logAktivitasAdmin(
            $koneksi,
            "Menambahkan beasiswa: $nama_beasiswa"
        );

        /* ===============================
           3. NOTIFIKASI WEB
        ================================ */
        kirimNotifWebBeasiswa(
            $koneksi,
            $nama_beasiswa,
            $periode,
            $tanggal_buka,
            $tanggal_tutup
        );

        /* ===============================
           4. EMAIL MAHASISWA
        ================================ */
        $mahasiswa = mysqli_query($koneksi, "
            SELECT nama, email
            FROM mahasiswa
            WHERE email IS NOT NULL
              AND email != ''
              AND email LIKE '%@%'
        ");

        $subject = "🎓 Informasi Beasiswa – $nama_beasiswa";

        $emailData = [
            'nama_beasiswa' => $nama_beasiswa,
            'periode'       => $periode,
            'tanggal_buka'  => date('d M Y', strtotime($tanggal_buka)),
            'tanggal_tutup' => date('d M Y', strtotime($tanggal_tutup)),
            'syarat'        => nl2br($syarat),
            'prodi'         => 'Seluruh Program Studi',
            'link'          => 'http://localhost/proyekPBL-1E-5/mahasiswa/beasiswa.php'
        ];

        $body = emailBeasiswaCard($emailData);

        while ($m = mysqli_fetch_assoc($mahasiswa)) {
            kirimEmail(
                $m['email'],
                $m['nama'],
                $subject,
                $body
            );
        }

        mysqli_commit($koneksi);
        header("Location: beasiswa.php?status=berhasil");
        exit;

    } catch (Exception $e) {
        mysqli_rollback($koneksi);
        header("Location: tambah_beasiswa.php?error=gagal");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Beasiswa</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="icon" type="image/png" href="../assets/img/Logo Politeknik.png">
<link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
<link rel="stylesheet" href="../assets/css/style5.css">
<link rel="stylesheet" href="../assets/css/sidebar.css">
<link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
=======
    /* ===============================
       1. SIMPAN BEASISWA
    ================================ */
    mysqli_query($koneksi, "
        INSERT INTO beasiswa 
        (nama_beasiswa, deskripsi, syarat, periode,
         tanggal_buka, tanggal_tutup, gambar, status)
        VALUES 
        ('$nama_beasiswa','$deskripsi','$syarat','$periode',
         '$tanggal_buka','$tanggal_tutup','$gambar','$status')
    ");

    /* ===============================
       2. AMBIL MAHASISWA (EMAIL VALID)
    ================================ */
    $mahasiswa = mysqli_query($koneksi, "
        SELECT nama, email
        FROM mahasiswa
        WHERE email IS NOT NULL
          AND email != ''
          AND email LIKE '%@%'
<<<<<<< HEAD
=======
=======
    $nama_beasiswa = $_POST['nama_beasiswa'];
    $deskripsi     = $_POST['deskripsi'];
    $syarat        = $_POST['syarat'];
    $periode       = $_POST['periode'];
    $tanggal_buka  = $_POST['tanggal_buka'];
    $tanggal_tutup = $_POST['tanggal_tutup'];
    $status        = $_POST['status'];

    $gambar = null;

    mysqli_query($koneksi, "
        INSERT INTO beasiswa 
        (nama_beasiswa, deskripsi, syarat, periode, tanggal_buka, tanggal_tutup, gambar, status)
        VALUES 
        ('$nama_beasiswa','$deskripsi','$syarat','$periode',
         '$tanggal_buka','$tanggal_tutup','$gambar','$status')
>>>>>>> 9a567987dd90af1392f8d15dfcbd79423ecb4815
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
    ");

    /* ===============================
       3. SIAPKAN EMAIL (PAKAI TEMPLATE)
    ================================ */
    $subject = "🎓 Informasi Beasiswa – $nama_beasiswa";

    $emailData = [
        'nama_beasiswa' => $nama_beasiswa,
        'periode'       => $periode,
        'tanggal_buka'  => date('d M Y', strtotime($tanggal_buka)),
        'tanggal_tutup' => date('d M Y', strtotime($tanggal_tutup)),
        'syarat'        => nl2br($syarat),
        'prodi'         => 'Seluruh Program Studi',
        'link'          => 'http://localhost/proyekPBL-1E-5/mahasiswa/beasiswa.php'
    ];

    $body = emailBeasiswaCard($emailData);

    /* ===============================
       4. KIRIM EMAIL
    ================================ */
    while ($m = mysqli_fetch_assoc($mahasiswa)) {
        kirimEmail(
            $m['email'],
            $m['nama'],
            $subject,
            $body
        );
    }

    header("Location: beasiswa.php?status=berhasil");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Beasiswa</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">

<<<<<<< HEAD
         <link rel="icon" type="image/png" href="../assets/img/Logo Politeknik.png">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style5.css">
        <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
=======
<<<<<<< HEAD
    <link rel="stylesheet" href="../assets/css/style5.css">
=======
    <link rel="stylesheet" href="../assets/css/style4.css">
>>>>>>> 9a567987dd90af1392f8d15dfcbd79423ecb4815
        <link rel="stylesheet" href="../assets/css/sidebar.css">
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

<<<<<<< HEAD
<div class="form-header">
    <h3>Tambah Beasiswa</h3>
    <p>Gunakan form ini untuk menambahkan informasi beasiswa.</p>
</div>

<form method="POST" class="form-card">

<h4 class="form-section-title">
    <i class="fa-solid fa-graduation-cap"></i> Informasi Beasiswa
</h4>

<div class="form-group">
    <label>Nama Beasiswa</label>
    <input type="text" name="nama_beasiswa"
           placeholder="Contoh: Beasiswa Unggulan 2025" required>
</div>

<div class="form-group">
    <label>Deskripsi</label>
    <textarea name="deskripsi"
              rows="4"
              placeholder="Jelaskan secara singkat tujuan dan manfaat beasiswa"
              required></textarea>
</div>

<div class="form-group">
    <label>Syarat Beasiswa</label>
    <textarea name="syarat"
              rows="4"
              placeholder="Contoh: IPK minimal, mahasiswa aktif, dll"
              required></textarea>
</div>


<h4 class="form-section-title">
    <i class="fa-solid fa-calendar-days"></i> Periode & Status
</h4>

<div class="form-grid">
    <div class="form-group">
        <label>Periode</label>
        <input type="text" name="periode" required>
    </div>

    <div class="form-group">
        <label>Tanggal Buka</label>
        <input type="date" name="tanggal_buka" required>
    </div>

    <div class="form-group">
        <label>Tanggal Tutup</label>
        <input type="date" name="tanggal_tutup" required>
    </div>

    <div class="form-group">
        <label>Status</label>
        <select name="status" required>
            <option value="aktif">Aktif</option>
            <option value="nonaktif">Nonaktif</option>
        </select>
    </div>
</div>

<div class="form-action">
    <button type="submit" name="simpan" class="btn-primary">
        <i class="fa-solid fa-save"></i> Simpan
    </button>
    <a href="beasiswa.php" class="btn-danger">
        <i class="fa-solid fa-xmark"></i> Batal
    </a>
</div>

</form>
=======
    <div class="form-header">
        <h3>Tambah Beasiswa</h3>
        <p>Gunakan form ini untuk menambahkan informasi beasiswa yang akan ditampilkan kepada mahasiswa.</p>
    </div>

    <form method="POST" class="form-card">

        <h4 class="form-section-title">
            <i class="fa-solid fa-graduation-cap"></i> Informasi Beasiswa
        </h4>

        <div class="form-group">
            <label>Nama Beasiswa</label>
            <input type="text" name="nama_beasiswa"
                   placeholder="Contoh: Beasiswa Unggulan 2025" required>
        </div>

        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" rows="4"
                placeholder="Jelaskan tujuan dan gambaran singkat beasiswa" required></textarea>
        </div>

        <div class="form-group">
            <label>Syarat Beasiswa</label>
            <textarea name="syarat" rows="4"
                placeholder="Contoh: IPK minimal 3.00, aktif kuliah, tidak menerima beasiswa lain" required></textarea>
        </div>

        <h4 class="form-section-title">
            <i class="fa-solid fa-calendar-days"></i> Periode & Status
        </h4>

        <div class="form-grid">
            <div class="form-group">
                <label>Periode</label>
                <input type="text" name="periode"
                       placeholder="Contoh: 2025 / Ganjil 2025" required>
            </div>

            <div class="form-group">
                <label>Tanggal Buka</label>
                <input type="date" name="tanggal_buka" required>
            </div>

            <div class="form-group">
                <label>Tanggal Tutup</label>
                <input type="date" name="tanggal_tutup" required>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status" required>
                    <option value="aktif">Aktif</option>
                    <option value="nonaktif">Nonaktif</option>
                </select>
                <small class="text-muted">
                    Status aktif berarti beasiswa akan ditampilkan ke mahasiswa
                </small>
            </div>
        </div>

        <div class="form-action">
            <button type="submit" name="simpan" class="btn-primary">
                <i class="fa-solid fa-save"></i> Simpan
            </button>
            <a href="beasiswa.php" class="btn-danger">
                <i class="fa-solid fa-xmark"></i> Batal
            </a>
        </div>

    </form>
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717

</div>
</div>
</div>

<footer>
© 2025 Aplikasi Pengumuman Akademik Online | Politeknik Negeri Batam
</footer>

</body>
</html>

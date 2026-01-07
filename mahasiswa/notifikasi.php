<?php
require_once "../config/auth_mahasiswa.php";
require_once "../config/koneksi.php";

<<<<<<< HEAD
$jurusan  = $_SESSION['jurusan'];
$prodi    = $_SESSION['prodi'];
$kelas    = $_SESSION['kelas'];
$shift    = $_SESSION['shift'];
$semester = $_SESSION['semester'];

/* ===============================
   PAGINATION
================================ */
$limit = 6;
$page  = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$start = ($page - 1) * $limit;

/* ===============================
   TOTAL DATA
================================ */
$qTotal = mysqli_query($koneksi, "
SELECT COUNT(*) total
FROM notifikasi
WHERE role='mahasiswa'
AND status='aktif'
AND (jurusan IS NULL OR jurusan='$jurusan')
AND (prodi IS NULL OR prodi='$prodi')
AND (kelas IS NULL OR kelas='$kelas')
AND (shift IS NULL OR shift='$shift')
AND (semester IS NULL OR semester='$semester')
");
$totalData = mysqli_fetch_assoc($qTotal)['total'] ?? 0;
$totalPage = ceil($totalData / $limit);

/* ===============================
   DATA NOTIFIKASI
================================ */
$notifikasi = mysqli_query($koneksi, "
SELECT *
FROM notifikasi
WHERE role='mahasiswa'
AND status='aktif'
AND (jurusan IS NULL OR jurusan='$jurusan')
AND (prodi IS NULL OR prodi='$prodi')
AND (kelas IS NULL OR kelas='$kelas')
AND (shift IS NULL OR shift='$shift')
AND (semester IS NULL OR semester='$semester')
ORDER BY tanggal DESC
LIMIT $start, $limit
");

/* ===============================
   HELPER WAKTU
================================ */
function human_time_diff($t){
    $d = time() - strtotime($t);
    if ($d < 60) return "baru saja";
    if ($d < 3600) return floor($d/60)." menit lalu";
    if ($d < 86400) return floor($d/3600)." jam lalu";
    return floor($d/86400)." hari lalu";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Notifikasi Mahasiswa</title>
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
/* ===== DATA MAHASISWA DARI SESSION ===== */
$prodi = $_SESSION['prodi'];
$kelas = $_SESSION['kelas'];
$shift = $_SESSION['shift'];

/* ===== TANDAI SUDAH DIBACA ===== */
if (isset($_GET['read'])) {
    $id = (int) $_GET['read'];
    mysqli_query($koneksi, "
        UPDATE notifikasi 
        SET is_read = 1
        WHERE id_notifikasi = '$id'
    ");
    header("Location: notifikasi.php");
    exit;
}

/* ===== AMBIL NOTIFIKASI (FILTERED) ===== */
<<<<<<< HEAD
=======
=======
$id_login = $_SESSION['id_login'];

>>>>>>> 9a567987dd90af1392f8d15dfcbd79423ecb4815
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
$notifikasi = mysqli_query($koneksi, "
    SELECT *
    FROM notifikasi
    WHERE role = 'mahasiswa'
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
      AND status = 'aktif'
      AND prodi = '$prodi'
      AND kelas = '$kelas'
      AND shift = '$shift'
<<<<<<< HEAD
=======
=======
>>>>>>> 9a567987dd90af1392f8d15dfcbd79423ecb4815
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
    ORDER BY tanggal DESC
");

if (!$notifikasi) {
    die("Query error: " . mysqli_error($koneksi));
}

$jumlah = mysqli_num_rows($notifikasi);
?>

<!DOCTYPE html>
<html lang="id">
<<<<<<< HEAD
<head>
    <meta charset="UTF-8">
    <title>Semua Notifikasi</title>
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="icon" type="image/png" href="../assets/img/Logo Politeknik.png">
<link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
<<<<<<< HEAD
<link rel="stylesheet" href="../assets/css/sidebar.css">
<link rel="stylesheet" href="../assets/css/style3.css">
<link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
</head>

<body>
=======
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/style3.css">
    <link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
=======
<<<<<<< HEAD
=======

>>>>>>> 9a567987dd90af1392f8d15dfcbd79423ecb4815
<head>
    <meta charset="UTF-8">
    <title>Semua Notifikasi</title>

    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/style3.css">
    <link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
</head>

<body>

<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
<div class="main-wrapper">

<?php include "../components_mahasiswa/sidebar.php"; ?>
<?php include "../components_mahasiswa/topbar.php"; ?>

<div class="main-content">
<div class="content-container">

<<<<<<< HEAD
<div class="notif-hero">
    <div class="notif-hero-left">
        <div class="notif-hero-icon">
            <i class="fa-solid fa-bell"></i>
        </div>
        <div>
            <h2>Notifikasi</h2>
            <p>Informasi akademik untuk mahasiswa</p>
        </div>
    </div>

    <button class="btn-read-all" onclick="readAllMhs()">
        Tandai semua dibaca
    </button>
</div>

<h3 class="section-title">Notifikasi Terbaru</h3>

<div class="notif-list-page">

<?php if (mysqli_num_rows($notifikasi) == 0): ?>
    <div class="notif-empty">Tidak ada notifikasi</div>
<?php endif; ?>

<?php while ($n = mysqli_fetch_assoc($notifikasi)): ?>
<div class="notif-row <?= $n['is_read']==0 ? 'unread' : 'read' ?>"
     data-id="<?= $n['id_notifikasi'] ?>"
     onclick="readOneMhs(this)">

    <div class="notif-row-icon primary">
        <i class="fa-solid fa-circle-info"></i>
    </div>

    <div class="notif-row-content">
        <strong><?= htmlspecialchars($n['judul']) ?></strong>

        <?php if ($n['is_read'] == 0): ?>
            <span class="badge-new">BARU</span>
        <?php endif; ?>

        <div class="notif-html">
            <?= $n['isi'] ?>
        </div>
    </div>

    <div class="notif-row-time">
        <?= human_time_diff($n['tanggal']) ?>
    </div>
</div>
<?php endwhile; ?>

</div>

<?php if ($totalPage > 1): ?>
<div class="pagination">
    <?php if ($page > 1): ?>
        <a href="?page=<?= $page-1 ?>">&laquo;</a>
    <?php endif; ?>

    <?php for ($i=1; $i<=$totalPage; $i++): ?>
        <a href="?page=<?= $i ?>" class="<?= $i==$page ? 'active' : '' ?>">
            <?= $i ?>
        </a>
    <?php endfor; ?>

    <?php if ($page < $totalPage): ?>
        <a href="?page=<?= $page+1 ?>">&raquo;</a>
    <?php endif; ?>
</div>
<?php endif; ?>
=======
    <!-- HERO -->
    <div class="notif-hero">
        <div class="notif-hero-left">
            <div class="notif-hero-icon">
                <i class="fa-solid fa-bell"></i>
            </div>
            <div class="notif-hero-text">
                <h2>Notifikasi</h2>
                <p>
                    <?= htmlspecialchars($prodi); ?> ·
                    Kelas <?= htmlspecialchars($kelas); ?> ·
                    <?= htmlspecialchars($shift); ?>
                </p>
            </div>
        </div>

        <div class="notif-hero-right">
            <span class="notif-count">
                <?= $jumlah; ?> Notifikasi
            </span>
        </div>
    </div>

    <!-- LIST -->
    <div class="notif-list">

    <?php if ($jumlah > 0): ?>
        <?php while ($n = mysqli_fetch_assoc($notifikasi)): ?>
        <a href="?read=<?= $n['id_notifikasi']; ?>" class="notif-link">

        <div class="notif-card <?= $n['is_read'] == 0 ? 'unread' : 'read'; ?>">

            <div class="notif-icon">
                <i class="fa-solid fa-bell"></i>
            </div>

            <div class="notif-content">
                <h4>
                    <?= htmlspecialchars($n['judul']); ?>
                    <?php if ($n['is_read'] == 0): ?>
                        <span class="badge-new">BARU</span>
                    <?php endif; ?>
                </h4>

                <p><?= nl2br(htmlspecialchars($n['isi'])); ?></p>

                <div class="notif-meta">
                    <span>
                        <i class="fa-regular fa-clock"></i>
                        <?= date('d M Y · H:i', strtotime($n['tanggal'])); ?>
                    </span>
                </div>
            </div>

        </div>
        </a>
        <?php endwhile; ?>

    <?php else: ?>
        <div class="notif-empty">
            <i class="fa-regular fa-bell-slash"></i>
            <p>Tidak ada notifikasi</p>
        </div>
    <?php endif; ?>

    </div>
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717

</div>
</div>
</div>

<footer>
© 2025 Aplikasi Pengumuman Akademik Online | Politeknik Negeri Batam
</footer>

<<<<<<< HEAD
<script>
function readOneMhs(el) {
    if (!el.classList.contains('unread')) return;

    const id = el.dataset.id;

    fetch('notif_ajax.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'action=read_one&id=' + id
    })
    .then(r => r.text())
    .then(r => {
        if (r === 'ok') {
            el.classList.remove('unread');
            el.classList.add('read');
            const badge = el.querySelector('.badge-new');
            if (badge) badge.remove();
        }
    });
}

function readAllMhs() {
    fetch('notif_ajax.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'action=read_all'
    })
    .then(r => r.text())
    .then(r => {
        if (r === 'ok') {
            document.querySelectorAll('.notif-row.unread').forEach(el => {
                el.classList.remove('unread');
                el.classList.add('read');
                const badge = el.querySelector('.badge-new');
                if (badge) badge.remove();
            });
        }
    });
}
</script>
<script src="../assets/js/script3.js"></script>
</body>
=======
</body>
<<<<<<< HEAD
=======
=======
    <div class="main-wrapper">

        <?php include "../components_mahasiswa/sidebar.php"; ?>
        <?php include "../components_mahasiswa/topbar.php"; ?>

        <div class="main-content">
            <div class="content-container">

                <div class="notif-hero">
                    <div class="notif-hero-left">
                        <div class="notif-hero-icon">
                            <i class="fa-solid fa-bell"></i>
                        </div>
                        <div class="notif-hero-text">
                            <h2>Semua Notifikasi</h2>
                            <p>Riwayat aktivitas akademik terbaru</p>
                        </div>
                    </div>

                    <div class="notif-hero-right">
                        <span class="notif-count">
                            <?= mysqli_num_rows($notifikasi); ?> Notifikasi
                        </span>
                    </div>
                </div>

                <div class="notif-list">

                    <?php if (mysqli_num_rows($notifikasi) > 0): ?>
                    <?php while ($n = mysqli_fetch_assoc($notifikasi)): ?>
                    <div class="notif-card <?= $n['status'] === 'aktif' ? 'unread' : 'read'; ?>">

                        <div class="notif-icon">
                            <i class="fa-solid fa-bell"></i>
                        </div>

                        <div class="notif-content">
                            <h4><?= htmlspecialchars($n['judul']); ?></h4>
                            <p><?= htmlspecialchars($n['isi']); ?></p>

                            <div class="notif-meta">
                                <span>
                                    <i class="fa-regular fa-clock"></i>
                                    <?= date('d M Y · H:i', strtotime($n['tanggal'])); ?>
                                </span>

                                <?php if ($n['status'] === 'aktif'): ?>
                                <span class="badge-new">BARU</span>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                    <?php endwhile; ?>
                    <?php else: ?>
                    <div class="notif-empty">
                        <i class="fa-regular fa-bell-slash"></i>
                        <p>Tidak ada notifikasi</p>
                    </div>
                    <?php endif; ?>

                </div>

            </div>
        </div>

    </div>

    <footer>
        © 2025 Aplikasi Pengumuman Akademik Online | Politeknik Negeri Batam
    </footer>

</body>

>>>>>>> 9a567987dd90af1392f8d15dfcbd79423ecb4815
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
</html>

<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";

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
    WHERE role='admin'
      AND status='aktif'
");
$totalData = mysqli_fetch_assoc($qTotal)['total'] ?? 0;
$totalPage = ceil($totalData / $limit);

/* ===============================
   DATA NOTIFIKASI
================================ */
$notifikasi = mysqli_query($koneksi, "
    SELECT *
    FROM notifikasi
    WHERE role='admin'
      AND status='aktif'
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
<title>Semua Notifikasi</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="icon" type="image/png" href="../assets/img/Logo Politeknik.png">
<link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
<link rel="stylesheet" href="../assets/css/sidebar.css">
<link rel="stylesheet" href="../assets/css/style3.css">
<link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
</head>

<body>
<div class="main-wrapper">

<?php include "../components_admin/sidebar.php"; ?>
<?php include "../components_admin/topbar.php"; ?>

<div class="main-content">
<div class="content-container">

<div class="notif-hero">
    <div class="notif-hero-left">
        <div class="notif-hero-icon">
            <i class="fa-solid fa-bell"></i>
        </div>
        <div>
            <h2>Semua Notifikasi</h2>
            <p>Daftar notifikasi sistem admin</p>
        </div>
    </div>

    <button class="btn-read-all" onclick="readAll()">
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
     onclick="readOne(this)">

    <div class="notif-row-icon
        <?= stripos($n['judul'], 'beasiswa') !== false ? 'success' :
           (stripos($n['judul'], 'kelas') !== false ? 'primary' :
           (stripos($n['judul'], 'ujian') !== false ? 'danger' : 'warning')) ?>">
        <i class="fa-solid fa-circle-exclamation"></i>
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

</div>
</div>
</div>

<footer>
© 2025 Aplikasi Pengumuman Akademik Online | Politeknik Negeri Batam
</footer>

<script>
function readOne(el) {
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

function readAll() {
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
</html>

<?php
require_once "../config/auth_mahasiswa.php";
require_once "../config/koneksi.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Pengumuman - Mahasiswa</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="icon" type="image/png" href="../assets/img/Logo Politeknik.png">
<link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
<link rel="stylesheet" href="../assets/css/style5.css">
<link rel="stylesheet" href="../assets/css/sidebar.css">
<link rel="stylesheet" href="../assets/css/notifikasi+profil.css">

<style>
/* ===============================
   ALERT
================================ */
.alert-pengumuman{
    background:#d1fae5;
    border-left:6px solid #10b981;
    padding:14px 18px;
    border-radius:10px;
    margin:10px 0 20px;
}

/* ===============================
   GRID & CARD
================================ */
.pengumuman-grid{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(300px,1fr));
    gap:22px;
}

.pengumuman-card{
    background:#fff;
    border-radius:18px;
    padding:20px;
    box-shadow:0 8px 24px rgba(0,0,0,.06);
    transition:.3s;
}
.pengumuman-card:hover{
    transform:translateY(-4px);
    box-shadow:0 14px 32px rgba(0,0,0,.1);
}

/* BADGE */
.badge-bar{
    display:inline-block;
    padding:4px 14px;
    font-size:12px;
    font-weight:600;
    border-radius:20px;
    color:#fff;
    margin-bottom:10px;
}
.badge-ujian{background:#dc2626;}
.badge-akademik{background:#2563eb;}
.badge-beasiswa{background:#7c3aed;}
.badge-informasi{background:#16a34a;}

.pengumuman-card h4{
    font-size:18px;
    font-weight:700;
    margin-bottom:8px;
}
.pengumuman-card p{
    font-size:14px;
    color:#555;
}

.pengumuman-desc{
    font-size:14px;
    color:#555;
    line-height:1.6;
    margin-bottom:12px;

    display:-webkit-box;
    -webkit-line-clamp:3;
    -webkit-box-orient:vertical;
    overflow:hidden;
}

.tanggal{
    font-size:13px;
    color:#666;
    margin-bottom:14px;
}

/* BUTTON */
.btn-detail{
    background:#1e40af;
    color:#fff;
    border:none;
    width:100%;
    padding:10px;
    border-radius:10px;
    font-weight:600;
    cursor:pointer;
}
.btn-detail:hover{background:#1e3a8a;}

/* ===============================
   MODAL
================================ */
.modal-custom{
    position:fixed;
    inset:0;
    background:rgba(0,0,0,.45);
    display:none;
    align-items:center;
    justify-content:center;
    z-index:2000;
    backdrop-filter:blur(2px);
}
.modal-custom.active{display:flex;}

.modal-box{
    background:#fff;
    width:90%;
    max-width:900px;
    border-radius:14px;
    overflow:hidden;
    box-shadow:0 20px 60px rgba(0,0,0,.35);
    animation:modalFade .25s ease;
}
@keyframes modalFade{
    from{transform:translateY(-10px) scale(.97);opacity:0}
    to{transform:translateY(0) scale(1);opacity:1}
}

.modal-header{
    background:#1e3a8a;
    color:#fff;
    padding:16px 24px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}
.modal-header h5{
    margin:0;
    font-size:18px;
    font-weight:600;
}
.close-modal{
    background:none;
    border:none;
    font-size:22px;
    color:#fff;
    cursor:pointer;
}

.modal-body{
    padding:22px 24px;
    max-height:60vh;
    overflow-y:auto;     /* scroll KE BAWAH */
    overflow-x:hidden;  /* MATIKAN scroll ke samping */
    font-size:15px;
    line-height:1.7;

    word-wrap: break-word;
    word-break: break-word;
    white-space: normal;
}

.modal-body hr{
    border:none;
    border-top:1px solid #e5e7eb;
    margin:14px 0;
}

.modal-footer{
    padding:16px 24px;
    background:#f9fafb;
    text-align:right;
}
.btn-close-modal{
    background:#6b7280;
    color:#fff;
    border:none;
    padding:8px 18px;
    border-radius:8px;
    cursor:pointer;
    font-weight:500;
}
.btn-close-modal:hover{background:#4b5563;}
</style>
</head>

<body>
<div class="main-wrapper">

<?php include "../components_mahasiswa/sidebar.php"; ?>
<?php include "../components_mahasiswa/topbar.php"; ?>

<div class="main-content">
<div class="content-container">

<div class="alert-pengumuman">
    <strong>📢 Pengumuman Akademik</strong><br>
    Informasi akademik terbaru yang perlu kamu ketahui.
</div>

<div class="pengumuman-grid">

<?php
$id_mahasiswa = $_SESSION['id_mahasiswa'];

$q = mysqli_query($koneksi,"
    SELECT * FROM pengumuman
    WHERE untuk_mahasiswa IS NULL
       OR untuk_mahasiswa = '$id_mahasiswa'
    ORDER BY dibuat_pada DESC
");

if(mysqli_num_rows($q)==0){
    echo "<p style='grid-column:1/-1;text-align:center'>Belum ada pengumuman.</p>";
}

while($row = mysqli_fetch_assoc($q)){
    $kategori = strtolower($row['kategori']);
    $badge = match($kategori){
        'ujian'=>'badge-ujian',
        'akademik'=>'badge-akademik',
        'beasiswa'=>'badge-beasiswa',
        default=>'badge-informasi'
    };

    // DESKRIPSI RINGKAS (AMAN)
    $ringkas = mb_strimwidth(strip_tags($row['isi']), 0, 150, '...');
?>

<div class="pengumuman-card">
    <div class="badge-bar <?= $badge ?>">
        <?= ucfirst($row['kategori']) ?>
    </div>

    <h4><?= htmlspecialchars($row['judul']) ?></h4>

    <p class="pengumuman-desc">
        <?= htmlspecialchars($ringkas) ?>
    </p>

    <div class="tanggal">
        <i class="fa-regular fa-calendar"></i>
        <?= date('d M Y',strtotime($row['dibuat_pada'])) ?>
    </div>

    <button class="btn-detail"
        onclick="openModal('modal<?= $row['id_pengumuman'] ?>')">
        Lihat Detail
    </button>
</div>

<!-- MODAL DETAIL -->
<div class="modal-custom" id="modal<?= $row['id_pengumuman'] ?>">
    <div class="modal-box">

        <div class="modal-header">
            <h5><?= htmlspecialchars($row['judul']) ?></h5>
            <button class="close-modal"
                onclick="closeModal('modal<?= $row['id_pengumuman'] ?>')">&times;</button>
        </div>

        <div class="modal-body">
            <strong>Isi Pengumuman</strong>
            <p><?= nl2br(htmlspecialchars($row['isi'])) ?></p>

            <hr>
            <strong>Kategori</strong>
            <p><?= ucfirst($row['kategori']) ?></p>

            <hr>
            <strong>Tanggal</strong>
            <p><?= date('d M Y',strtotime($row['dibuat_pada'])) ?></p>
        </div>

        <div class="modal-footer">
            <button class="btn-close-modal"
                onclick="closeModal('modal<?= $row['id_pengumuman'] ?>')">
                Tutup
            </button>
        </div>

    </div>
</div>

<?php } ?>

</div>
</div>
</div>
</div>

<footer>
© 2025 Aplikasi Pengumuman Akademik Online | Politeknik Negeri Batam
</footer>

<script src="../assets/js/script3.js"></script>
<script>
function openModal(id){
    document.getElementById(id).classList.add('active');
    document.body.style.overflow='hidden';
}
function closeModal(id){
    document.getElementById(id).classList.remove('active');
    document.body.style.overflow='';
}
</script>
</body>
</html>

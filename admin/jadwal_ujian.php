<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";

$jurusan  = $_GET['jurusan']  ?? '';
$prodi    = $_GET['prodi']    ?? '';
$kelas    = $_GET['kelas']    ?? '';
$shift    = $_GET['shift']    ?? '';
$semester = $_GET['semester'] ?? '';

$isFiltered = ($jurusan || $prodi || $kelas || $shift || $semester);
$data = false;

if ($isFiltered) {
    $where = [];

    if ($jurusan)  $where[] = "jurusan='$jurusan'";
    if ($prodi)    $where[] = "prodi='$prodi'";
    if ($kelas)    $where[] = "kelas='$kelas'";
    if ($shift)    $where[] = "shift='$shift'";
    if ($semester) $where[] = "semester='$semester'";

    $sql = "SELECT * FROM jadwal_ujian";
    if ($where) {
        $sql .= " WHERE " . implode(" AND ", $where);
    }
    $sql .= " ORDER BY tanggal ASC, waktu_mulai ASC";
    $data = mysqli_query($koneksi, $sql);
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Jadwal Ujian - Admin</title>

    <link rel="stylesheet" href="../assets/css/style3.css">
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

                <div class="form-card" style="margin-bottom:20px;">
                    <h4 class="form-section-title">
                        <i class="fa-solid fa-filter"></i> Filter Jadwal Ujian
                    </h4>

                    <form method="GET" class="form-grid">
                        <select name="jurusan">
                            <option value="">Semua Jurusan</option>
                            <?php foreach (["Manajemen Bisnis","Teknik Elektro","Teknik Informatika","Teknik Mesin"] as $j): ?>
                            <option value="<?= $j ?>" <?= $jurusan==$j?'selected':'' ?>><?= $j ?></option>
                            <?php endforeach; ?>
                        </select>

                        <select name="prodi">
                            <option value="">Semua Prodi</option>
                            <?php
            $prodiList = [
                "D3 Akuntansi","D4 Akuntansi Manajerial","D4 Administrasi Bisnis Terapan",
                "D3 Teknik Informatika","D4 Rekayasa Perangkat Lunak","D4 Animasi",
                "D4 Teknologi Permainan","Magister Terapan (S2) / Teknik Komputer"
            ];
            foreach ($prodiList as $p):
            ?>
                            <option value="<?= $p ?>" <?= $prodi==$p?'selected':'' ?>><?= $p ?></option>
                            <?php endforeach; ?>
                        </select>

                        <select name="kelas">
                            <option value="">Semua Kelas</option>
                            <?php foreach (['A','B','C','D','E'] as $k): ?>
                            <option value="<?= $k ?>" <?= $kelas==$k?'selected':'' ?>><?= $k ?></option>
                            <?php endforeach; ?>
                        </select>

                        <select name="shift">
                            <option value="">Semua Shift</option>
                            <option value="Pagi" <?= $shift=='Pagi'?'selected':'' ?>>Pagi</option>
                            <option value="Malam" <?= $shift=='Malam'?'selected':'' ?>>Malam</option>
                        </select>

                        <select name="semester">
                            <option value="">Semua Semester</option>
                            <?php for($i=1;$i<=8;$i++): ?>
                            <option value="<?= $i ?>" <?= $semester==$i?'selected':'' ?>><?= $i ?></option>
                            <?php endfor; ?>
                        </select>

                        <button class="btn-primary">
                            <i class="fa fa-filter"></i> Terapkan
                        </button>
                    </form>
                </div>

                <div class="header-section">
                    <h3>Data Jadwal Ujian</h3>

                    <a href="tambah_jadwal.php?jurusan=<?= $jurusan ?>&prodi=<?= $prodi ?>&kelas=<?= $kelas ?>&shift=<?= $shift ?>&semester=<?= $semester ?>"
                        class="btn-add">
                        <i class="fa fa-plus"></i> Tambah Jadwal Ujian
                    </a>
                </div>

                <div class="table-wrapper">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Mata Kuliah</th>
                                <th>Tanggal & Waktu</th>
                                <th>Ruang</th>
                                <th>Dosen</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>



                        <tbody>
                            <?php
if (!$isFiltered) {
    echo "<tr>
            <td colspan='6' class='empty-table'>
                <i class='fa-solid fa-circle-info'></i><br>
                Silakan pilih filter untuk menampilkan jadwal ujian
            </td>
          </tr>";
}
elseif ($data && mysqli_num_rows($data) == 0) {
    echo "<tr>
            <td colspan='6' class='empty-table'>
                Data tidak ditemukan
            </td>
          </tr>";
}
else {
    $no = 1;
    while ($row = mysqli_fetch_assoc($data)) {
?>
                            <tr>
                                <td><?= $no++; ?></td>

                                <td>
                                    <strong><?= $row['mata_kuliah']; ?></strong>
                                    <div class="badge-wrap">
                                        <span class="badge badge-kelas">Kelas <?= $row['kelas']; ?></span>
                                        <span class="badge badge-shift"><?= $row['shift']; ?></span>
                                        <span class="badge badge-semester">Smt <?= $row['semester']; ?></span>
                                    </div>
                                </td>

                                <td>
                                    <?= date("d M Y", strtotime($row['tanggal'])); ?><br>
                                    <small class="text-muted">
                                        <?= date("H:i", strtotime($row['waktu_mulai'])); ?>
                                        –
                                        <?= date("H:i", strtotime($row['waktu_selesai'])); ?>
                                    </small>
                                </td>

                                <td><?= $row['ruang']; ?></td>
                                <td><?= $row['dosen']; ?></td>

                                <td>
                                    <a href="edit_jadwal.php?id=<?= $row['id_jadwal_ujian']; ?>"
                                        class="btn-icon btn-edit">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                    <a href="hapus_jadwal.php?id=<?= $row['id_jadwal_ujian']; ?>"
                                        class="btn-icon btn-delete" onclick="return confirm('Hapus data jadwal ini?')">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php } } ?>
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>

    <footer>
        © 2025 Aplikasi Pengumuman Akademik Online | Politeknik Negeri Batam
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../assets/js/script3.js"></script>

</body>

</html>

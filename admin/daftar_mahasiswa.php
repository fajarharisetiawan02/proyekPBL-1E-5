<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";

$q = mysqli_query($koneksi, "SELECT * FROM mahasiswa ORDER BY id_mahasiswa ASC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Daftar Mahasiswa - Admin</title>
    <link rel="stylesheet" href="../assets/css/style7.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
            background: white;
            border-radius: 8px;
            overflow: hidden;
        }

        th,
        td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #0d6efd;
            color: white;
        }

        a.btn {
            padding: 6px 10px;
            background: #0d6efd;
            color: white;
            border-radius: 4px;
            text-decoration: none;
        }

        a.hapus {
            background: red;
        }
    </style>
</head>

<body>

    <h2>Daftar Mahasiswa</h2>
    <a class="btn" href="tambah_mahasiswa.php">+ Tambah Mahasiswa</a>

    <table>
        <tr>
            <th>ID</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Prodi</th>
            <th>Email</th>
            <th>No HP</th>
            <th>Aksi</th>
        </tr>

        <?php while($m = mysqli_fetch_assoc($q)) { ?>
        <tr>
            <td><?= $m['id_mahasiswa']; ?></td>
            <td><?= $m['nim']; ?></td>
            <td><?= $m['nama']; ?></td>
            <td><?= $m['prodi']; ?></td>
            <td><?= $m['email']; ?></td>
            <td><?= $m['no_hp']; ?></td>
            <td>
                <a class="btn" href="edit_mahasiswa.php?id=<?= $m['id_mahasiswa']; ?>">Edit</a>
                <a class="btn hapus" href="hapus_mahasiswa.php?id=<?= $m['id_mahasiswa']; ?>"
                    onclick="return confirm('Hapus mahasiswa ini?');">
                    Hapus
                </a>
            </td>
        </tr>
        <?php } ?>
    </table>

</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Mahasiswa</title>
    <link rel="stylesheet" href="../assets/css/style7.css">
</head>

<body>

<h2>Tambah Mahasiswa Baru</h2>

<form action="proses_tambah_mahasiswa.php" method="POST" enctype="multipart/form-data">
    
    <label>NIM</label>
    <input type="text" name="nim" required>

    <label>Nama Lengkap</label>
    <input type="text" name="nama" required>

    <label>Program Studi</label>
    <input type="text" name="prodi" required>

    <label>Email</label>
    <input type="email" name="email" required>

    <label>No HP</label>
    <input type="text" name="no_hp">

    <label>Password</label>
    <input type="password" name="password" required>

    <label>Foto</label>
    <input type="file" name="foto">

    <button type="submit" class="btn-save">SIMPAN</button>
</form>

</body>
</html>

<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";

$id_login = $_SESSION['id_login'];
$pesan = "";

$q = mysqli_query($koneksi, "
    SELECT nama, username, email, role, foto
    FROM login
    WHERE id_login='$id_login'
");
$admin = mysqli_fetch_assoc($q);

if (!$admin) {
    echo "<h3>Data admin tidak ditemukan</h3>";
    exit;
}

if (isset($_POST['simpan'])) {

    $nama  = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);

    if (!empty($_FILES['foto']['name'])) {

        $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $namaFoto = "admin_" . time() . "." . $ext;
        $folder = "../uploads/foto_admin/";

        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        move_uploaded_file($_FILES['foto']['tmp_name'], $folder . $namaFoto);

        mysqli_query($koneksi, "
            UPDATE login SET
                nama='$nama',
                email='$email',
                foto='$namaFoto'
            WHERE id_login='$id_login'
        ");
    } else {
        mysqli_query($koneksi, "
            UPDATE login SET
                nama='$nama',
                email='$email'
            WHERE id_login='$id_login'
        ");
    }

    $pesan = "<div class='alert success'>Profil berhasil diperbarui</div>";
}

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Profil Admin</title>

    <link rel="stylesheet" href="../assets/css/style7.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/notifikasi+profil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
</head>

<body>

    <div class="main-wrapper">

        <?php include "../components_admin/sidebar.php"; ?>

        <div class="main-content">
            <div class="content-container">

                <?php include "../components_admin/topbar.php"; ?>

                <div class="profile-card admin-card" style="max-width:560px">

                    <h2><i class="fa-solid fa-user-pen"></i> Edit Profil Admin</h2>

                    <?= $pesan ?>

                    <form method="POST" enctype="multipart/form-data">

                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama" value="<?= $admin['nama'] ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" value="<?= htmlspecialchars($admin['email'] ?? '') ?>"
                                required>
                        </div>


                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" value="<?= $admin['username'] ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label>Role</label>
                            <input type="text" value="<?= strtoupper($admin['role']) ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label>Foto Profil</label>
                            <input type="file" name="foto" accept="image/*">
                            <small>* Kosongkan jika tidak ingin mengganti foto</small>
                        </div>

                        <div style="margin-top:20px">
                            <button type="submit" name="simpan" class="btn-edit">
                                <i class="fa-solid fa-save"></i> Simpan Perubahan
                            </button>

                            <a href="profil_admin.php" class="btn-secondary">
                                Kembali
                            </a>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>

</body>

</html>

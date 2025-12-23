<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";

$id = $_POST['id'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$no_hp = $_POST['no_hp'];

$fotoBaru = $_FILES['foto']['name'];

if ($fotoBaru != "") {

    $tmp = $_FILES['foto']['tmp_name'];
    $folder = "../uploads/";

    $newName = time() . "_" . $fotoBaru;

    move_uploaded_file($tmp, $folder . $newName);

    mysqli_query($koneksi, 
        "UPDATE mahasiswa SET 
            nama='$nama',
            email='$email',
            no_hp='$no_hp',
            foto='$newName'
        WHERE id_mahasiswa='$id'"
    );

} else {

    mysqli_query($koneksi, 
        "UPDATE mahasiswa SET 
            nama='$nama',
            email='$email',
            no_hp='$no_hp'
        WHERE id_mahasiswa='$id'"
    );
}

header("Location: profil_mahasiswa.php?id=$id");
exit;
?>

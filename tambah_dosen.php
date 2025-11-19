<?php
include 'koneksi.php';

$nidn    = $_POST['nidn'];
$nama    = $_POST['nama'];
$alamat  = $_POST['alamat'];
$jabatan = $_POST['jabatan'];

$input = mysqli_query($koneksi, "INSERT INTO dosen (nidn, nama, alamat, jabatan)
VALUES ('$nidn', '$nama', '$alamat', '$jabatan')") or die(mysqli_error($koneksi));

if ($input){
    echo "<script>
            alert('Data Berhasil Disimpan');
            window.location.href = 'dosen.php';
          </script>";
} else {
    echo "<script>
            alert('Gagal Menyimpan Data');
            window.location.href = 'dosen.php';
          </script>";
}
?>

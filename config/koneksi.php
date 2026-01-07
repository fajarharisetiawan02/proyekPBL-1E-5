<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "pengumuman_akademik"; //Nama Database
// melakukan koneksi ke pengumuman akademik
$koneksi = mysqli_connect($host, $user, $pass, $db); if(!$koneksi){
echo "Gagal konek: " . die(mysqli_error($koneksi));
}
// SET TIMEZONE MYSQL
mysqli_query($koneksi, "SET time_zone = '+07:00'");
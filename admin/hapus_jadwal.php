<?php
require_once "../config/koneksi.php";

if (!isset($_GET['id'])) {
    header("Location: jadwal_ujian.php");
    exit;
}

$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM jadwal_ujian WHERE id_jadwal_ujian='$id'");

header("Location: jadwal_ujian.php");
exit;

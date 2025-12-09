<?php
require_once "../config/koneksi.php";

if (!isset($_GET['id'])) {
    header("Location: perkuliahan.php");
    exit;
}

$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM perkuliahan WHERE id_perkuliahan='$id'");

header("Location: perkuliahan.php");
exit;
?>

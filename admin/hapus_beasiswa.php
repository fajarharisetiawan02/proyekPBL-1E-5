<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";


$id = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM beasiswa WHERE id_beasiswa = $id");

header("Location: beasiswa.php");
exit;

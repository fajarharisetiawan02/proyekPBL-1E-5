<?php
session_start();
include "../config/koneksi.php";

$id_login = $_SESSION['id_login'];

mysqli_query($koneksi, "
    UPDATE login
    SET last_notif_read = NOW()
    WHERE id_login = '$id_login'
");

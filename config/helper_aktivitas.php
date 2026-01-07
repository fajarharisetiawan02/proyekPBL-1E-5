<?php
function logAktivitasAdmin($koneksi, $aktivitas)
{
    if (!isset($_SESSION['id_login'])) return;

    $id_login = $_SESSION['id_login'];
    $aktivitas = mysqli_real_escape_string($koneksi, $aktivitas);

    mysqli_query($koneksi, "
        INSERT INTO aktivitas_admin (id_login, aktivitas)
        VALUES ('$id_login', '$aktivitas')
    ");
}

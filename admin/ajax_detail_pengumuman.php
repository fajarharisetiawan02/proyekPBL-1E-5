<?php
require_once "../config/auth_admin.php";
require_once "../config/koneksi.php";

$id = (int)($_GET['id'] ?? 0);

$q = mysqli_query($koneksi,"
SELECT * FROM pengumuman WHERE id_pengumuman = $id
");

$data = mysqli_fetch_assoc($q);

echo json_encode([
    'judul'   => $data['judul'],
    'kategori'=> $data['kategori'],
    'tanggal' => date("d M Y", strtotime($data['dibuat_pada'])),
    'isi'     => nl2br($data['isi'])
]);

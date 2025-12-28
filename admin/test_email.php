<?php
require_once "../config/kirim_email.php";

kirimEmail(
    "fajarharis2002@gmail.com",
    "Test User",
    "TES EMAIL",
    "<h3>Email berhasil terkirim</h3>"
);

echo "SELESAI";



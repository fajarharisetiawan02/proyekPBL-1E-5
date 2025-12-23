<?php
require "kirim_email.php";

if (kirimEmail("pblifmalame@gmail.com", "Tes Email", "Halo, ini email percobaan")) {
    echo "✅ Email terkirim";
} else {
    echo "❌ Gagal kirim email";
}

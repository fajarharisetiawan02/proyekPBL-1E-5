<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . "/../library/PHPMailer/src/Exception.php";
require_once __DIR__ . "/../library/PHPMailer/src/PHPMailer.php";
require_once __DIR__ . "/../library/PHPMailer/src/SMTP.php";

function kirimEmail($emailTujuan, $namaTujuan, $judul, $isi) {

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'pblifmalame@gmail.com';
        $mail->Password   = 'zyisqcigjyiflraf'; // APP PASSWORD
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // 🔴 INI YANG PENTING (FIX ERROR â€“)
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';

        // 🔥 HARUS SAMA DENGAN USERNAME
        $mail->setFrom('pblifmalame@gmail.com', 'Pengumuman Akademik (No-Reply)');

        $mail->addAddress($emailTujuan, $namaTujuan);

        $mail->isHTML(true);
        $mail->Subject = $judul;
        $mail->Body    = $isi;

        $mail->send();
        return true;

    } catch (Exception $e) {
        echo "EMAIL GAGAL: " . $mail->ErrorInfo;
        exit;
    }
}
?>
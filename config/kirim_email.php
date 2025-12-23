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
        $mail->Password   = 'zyisqcigjyiflraf';      
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('fajarharis2002@gmail.com', 'Sistem Akademik Kampus');
        $mail->addAddress($emailTujuan, $namaTujuan);

        $mail->isHTML(true);
        $mail->Subject = $judul;
        $mail->Body    = "
            <h3>$judul</h3>
            <p>$isi</p>
            <hr>
            <small>Email otomatis dari Sistem Akademik</small>
        ";

        $mail->send();
        return true;

    } catch (Exception $e) {
        return false;
    }
}
?>
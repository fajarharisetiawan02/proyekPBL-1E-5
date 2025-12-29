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

<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
        // 🔴 INI YANG PENTING (FIX ERROR â€“)
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';

        // 🔥 HARUS SAMA DENGAN USERNAME
        $mail->setFrom('pblifmalame@gmail.com', 'Pengumuman Akademik (No-Reply)');
<<<<<<< HEAD
=======
=======
        // 🔥 HARUS SAMA DENGAN USERNAME
        $mail->setFrom('pblifmalame@gmail.com', 'Sistem Akademik Kampus');
>>>>>>> 9a567987dd90af1392f8d15dfcbd79423ecb4815
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e

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
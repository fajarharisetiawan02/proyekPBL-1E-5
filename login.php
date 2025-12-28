<?php 
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-Aplikasi Pengumuman Akademik Online</title>

    <link href="https://cdn.lineicons.com/5.0/lineicons.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="stylesheet" href="assets/css/style1.css">

</head>

<body>

    <div class="bg-blur"></div>
    <div class="bg-overlay"></div>

    <div class="login-container">
        <div class="login-box animate-login">
            <img src="assets/img/Logo Politeknik.png" class="logo">

            <h2>PENGUMUMAN<br>AKADEMIK ONLINE</h2>

            <form action="process/proses_login.php" method="POST">

                <input type="text" name="username" placeholder="Masukkan nama" required class="input">

                <div class="password-container">
                    <input type="password" name="password" id="password" placeholder="Masukkan kata sandi" required class="input">
                    <i class="fa-solid fa-eye" id="togglePassword"></i>
                </div>

                <button type="submit" class="btn-login">Masuk</button>
            </form>

            <?php if (isset($_GET['error'])) : ?>
            <div class="error">Username atau Password salah!</div>
            <?php endif; ?>
        </div>
    </div>

    <script src="assets/js/script2.js"></script>
</body>

</html>

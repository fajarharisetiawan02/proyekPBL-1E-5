<?php
require_once "../config/auth.php";
require_once "../config/koneksi.php";
?>
<!doctype html>
<html lang="id">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Tentang — Aplikasi Pengumuman Akademik Online</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!--Koneksikan dengan CSS-->
<link rel="stylesheet" href="/PBL-1E-5_akademik/assets/css/tentang.css">
</head>

<body>

  <header>
    <h1 class="logo-container">
      <img src="/PBL-1E-5_akademik/assets/img/Logo Polibatam1.png" class="logo-header" alt="Logo Aplikasi">
      <span class="logo-text">polibatam</span>
    </h1>

    <nav>
      <a href="index.php">Beranda</a>
      <a href="tentang.php">Tentang</a>
      <a href="login.php" class="login-btn">Login</a>
    </nav>
  </header>

  <main class="container" role="main">

    <section class="hero" aria-labelledby="hero-title">
      <div class="hero-left">
        <div class="kicker">Sistem Informasi</div>

        <h1 id="hero-title">Tentang Aplikasi Pengumuman Akademik Online</h1>

        <p>
          Aplikasi Pengumuman Akademik Online menyediakan pusat informasi resmi kampus dalam satu platform.
          Mahasiswa, dosen, dan staf dapat menerima pengumuman jadwal, perubahan kelas, pengumuman ujian, dan
          informasi akademik lainnya secara cepat dan terpercaya.
        </p>

        <div class="hero-cta">
          <a class="btn btn-primary" href="tampilan_login.html">
            <i class="fa-solid fa-house-chimney"></i>&nbsp;Lihat Pengumuman
          </a>
          <a class="btn btn-outline" href="#fitur">Pelajari Fitur</a>
        </div>
      </div>

      <div class="hero-illus" aria-hidden="true">
        <div class="card-illus">
          <i class="fa-solid fa-bell fa-2x"></i>
          <div class="illus-title">Real-time announcements</div>
          <small class="illus-subtitle">Notifikasi langsung ke pengguna</small>
        </div>
      </div>
    </section>

    <section class="grid" id="fitur" aria-label="Informasi">
      <div class="card">
        <h3>Visi</h3>
        <p>
          Mewujudkan komunikasi akademik yang cepat, terstruktur, dan mudah diakses
          untuk seluruh sivitas akademika.
        </p>
      </div>

      <div class="card">
        <h3>Misi</h3>
        <ol>
          <li>Menyediakan kanal pengumuman terpusat dan real-time.</li>
          <li>Meningkatkan keteraturan jadwal dan transparansi informasi.</li>
          <li>Mendukung aksesibilitas informasi untuk mahasiswa dan staf akademik.</li>
        </ol>
      </div>

      <div class="card">
        <h3>Manfaat</h3>
        <ul>
          <li>Hemat waktu: tidak perlu ke papan pengumuman fisik.</li>
          <li>Informasi valid & resmi dari pihak kampus.</li>
          <li>Notifikasi dan filter untuk pengumuman relevan.</li>
        </ul>
      </div>
    </section>

    <section aria-labelledby="fitur-title" style="margin-top: 18px;">
      <h2 id="fitur-title" class="section-title">Fitur Unggulan</h2>

      <div class="card features">
        <div class="feature-item">
          <i class="fa-solid fa-bell"></i>
          <div>
            <strong>Notifikasi Real-time</strong>
            <p class="feature-desc">Pengumuman penting langsung tersampaikan ke pengguna.</p>
          </div>
        </div>

        <div class="feature-item">
          <i class="fa-solid fa-calendar-days"></i>
          <div>
            <strong>Kelola Jadwal & Ujian</strong>
            <p class="feature-desc">Jadwal kuliah dan ujian terpusat, mudah dipantau.</p>
          </div>
        </div>

        <div class="feature-item">
          <i class="fa-solid fa-user-check"></i>
          <div>
            <strong>Peran & Hak Akses</strong>
            <p class="feature-desc">Admin, dosen, dan mahasiswa memiliki hak akses berbeda.</p>
          </div>
        </div>

        <div class="feature-item">
          <i class="fa-solid fa-filter"></i>
          <div>
            <strong>Filter & Kategori</strong>
            <p class="feature-desc">Filter per jurusan, kelas, atau tanggal.</p>
          </div>
        </div>
      </div>
    </section>

    <section style="margin-top: 18px;">
      <div class="card">
        <h3>Kontak & Dukungan</h3>
        <p>
          Butuh bantuan? Hubungi admin:
          <strong>info@polibatam.ac.id</strong> atau telepon +62-778-469858.
        </p>
      </div>
    </section>
  </main>

  <footer>
    © 2025 Aplikasi Pengumuman Akademik Online | Politeknik Negeri Batam
  </footer>

  <script src="/PBL-1E-5_akademik/assets/js/tentang.js"></script>

</body>

</html>

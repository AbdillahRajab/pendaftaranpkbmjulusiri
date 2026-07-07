<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PKBM JULU SIRI - Portal Resmi</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        /* NAVBAR STYLE */
        .navbar-custom {
            background-color: #0b3c68 !important;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .navbar-custom .nav-link {
            color: #ffffff !important;
            font-weight: 500;
        }

        .navbar-custom .nav-link:hover {
            color: #ffc107 !important;
        }

        .navbar-custom .dropdown-menu {
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* BANNER HERO UTAMA */
        .hero-banner {
            background: linear-gradient(rgba(0, 0, 0, 0.85), rgba(8, 45, 78, 0)),
                url("{{ asset('images/julusiri fto.webp') }}") no-repeat center center/cover;
            color: white;
            padding: 140px 0;
            text-align: center;
        }

        .section-padding {
            padding: 80px 0;
        }

        .gallery-img-wrapper {
            height: 220px;
            object-fit: cover;
            width: 100%;
            border-radius: 8px;
        }

        .form-section-title {
            background-color: #f1f5f9;
            padding: 6px 12px;
            border-left: 4px solid #0b3c68;
            font-weight: bold;
            font-size: 0.9rem;
            color: #0b3c68;
            margin-bottom: 15px;
            margin-top: 10px;
        }

        #authTab .nav-link {
            transition: all 0.3s ease;
            opacity: 0.75;
        }

        #authTab .nav-link:hover {
            color: #ffc107 !important;
            background-color: rgba(255, 255, 255, 0.15) !important;
            opacity: 1;
        }

        #authTab .nav-link.active {
            color: #0b3c68 !important;
            background-color: #ffffff !important;
            opacity: 1;
            border-radius: 8px 8px 0 0;
    </style>
</head>

<body>

    <!-- NAVBAR UTAMA -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <div class="container">
            <!-- LOGO INSTANSI -->
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <img src="{{ asset('images/logo3.png') }}" alt="Logo PKBM" class="me-2"
                    style="height: 50px; width: auto; object-fit: contain;">
                <div>
                    <span class="mb-0 d-block lh-1 fw-bold" style="font-size: 1.5 rem; letter-spacing: 0.3 px;">PKBM
                        JULU SIRI</span>
                    <small style="font-size: 0.65rem; color: #b8c7ce; font-weight: normal;">Website Resmi Pusat Kegiatan
                        Belajar Masyarakat JULU SIRI</small>
                </div>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto text-center">
                    <!-- Dropdown Menu Tentang Kami -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropTentang" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-file-text me-1"></i> Tentang Kami
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropTentang">
                            <li><a class="dropdown-item" href="#seksi-profil">Profil</a></li>
                            <li><a class="dropdown-item" href="#seksi-visimisi">Visi & Misi</a></li>
                            <li><a class="dropdown-item" href="#seksi-struktur">Struktur Organisasi</a></li>
                        </ul>
                    </li>

                    <!-- Menu Fasilitas-->
                    <li class="nav-item">
                        <a class="nav-link" href="#seksi-fasilitas">
                            <i class="bi bi-images me-1"></i> Fasilitas
                        </a>
                    </li>

                    <!-- Dropdown Menu Hubungi -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropHubungi" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-telephone me-1"></i> Hubungi
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropHubungi">
                            <!-- 1. WhatsApp: Langsung Menuju Chat -->
                            <li>
                                <a class="dropdown-item" href="https://wa.me/6281234567890" target="_blank">
                                    <i class="bi bi-whatsapp me-2"></i> WhatsApp Admin
                                </a>
                            </li>

                            <!-- 2. Email: Otomatis Scroll ke Layanan & Hubungi -->
                            <li>
                                <a class="dropdown-item" href="#kontak-kantor"
                                    onclick="bootstrap.Dropdown.getInstance(document.getElementById('dropHubungi')).hide(); window.location.hash = 'kontak-kantor';">
                                    <i class="bi bi-envelope-fill me-2"></i> Email
                                </a>
                            </li>

                            <!-- 3. Lokasi Kantor: Otomatis Scroll ke Layanan & Hubungi -->
                            <li>
                                <a class="dropdown-item" href="#kontak-kantor"
                                    onclick="bootstrap.Dropdown.getInstance(document.getElementById('dropHubungi')).hide(); window.location.hash = 'kontak-kantor';">
                                    <i class="bi bi-geo-alt-fill me-2"></i> Lokasi
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- TOMBOL NAVIGASI KANAN -->
                    <div class="d-flex gap-2 justify-content-center">
                        <button type="button"
                            class="btn btn-warning btn-sm px-3 fw-bold rounded-pill text-dark d-flex align-items-center"
                            data-bs-toggle="modal" data-bs-target="#modalSiswaBaru">
                            <i class="bi bi-person-plus-fill me-1"></i> Form Pendaftaran
                        </button>
                        <button type="button"
                            class="btn btn-outline-light btn-sm px-3 rounded-pill d-flex align-items-center"
                            data-bs-toggle="modal" data-bs-target="#modalLoginRegister">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Login / Registrasi Akun
                        </button>
                    </div>
            </div>
        </div>
    </nav>

    @if (session('sukses_pendaftaran'))
        <div class="container my-4 alert alert-dismissible fade show p-0 border-0 shadow-lg" role="alert"
            style="position: relative; z-index: 9999; border-radius: 15px;">
            <div class="card border-0"
                style="border-radius: 15px; border-left: 6px solid #198754; background-color: #ffffff;">
                <div class="card-body p-4 d-flex align-items-center">
                    <!-- Icon Animasi Centang -->
                    <div class="bg-success bg-opacity-10 p-3 rounded-circle me-4 text-success">
                        <i class="bi bi-check-circle-fill fs-2"></i>
                    </div>
                    <!-- Teks Informasi -->
                    <div class="flex-grow-1">
                        <h4 class="fw-bold text-success mb-1" style="font-family: 'Segoe UI', sans-serif;">Pendaftaran
                            Berhasil!</h4>
                        <p class="text-muted mb-0 font-monospace small" style="font-size: 14px;">
                            <i class="bi bi-info-circle me-1 text-primary"></i> {{ session('sukses_pendaftaran') }}
                        </p>
                    </div>
                    <!-- Tombol Close yang Diperbaiki -->
                    <button type="button" class="btn-close position-relative shadow-none p-3 me-2"
                        data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif
    <!-- HERO BANNER -->
    <div class="position-relative w-100 vh-100 d-flex align-items-center justify-content-center text-center text-white"
        style="background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ asset('images/fto julusiri.jpeg') }}') no-repeat center center; background-size: cover;">

        <!-- Konten Teks Tepat di Tengah-Tengah Gambar -->
        <div class="container px-4 d-flex flex-column align-items-center justify-content-center">


            <h1 class="display-5 fw-bold mb-5 text-white tracking-wide text-shadow"
                style="text-shadow: 2px 2px 4px rgba(255, 153, 0, 0.7);">
                Selamat Datang Di Website
            </h1>

            <!-- Judul Utama PKBM (Style Center) -->
            <h1 class="display-3 fw-bold mb-3 text-white tracking-wide text-shadow"
                style="text-shadow: 2px 2px 3px rgba(0,0,0,0.7);">
                PKBM JULU SIRI
            </h1>

            <!-- Deskripsi Singkat (Style Center) -->
            <p class="lead mb-4 mx-auto text-light"
                style="max-width: 700px; font-size: 1.25rem; text-shadow: 1px 1px 4px rgba(0,0,0,0.6);">
                Membangun Masa Depan Melalui Pendidikan Kesetaraan yang Berkualitas, Kreatif, dan Mandiri.
            </p>

            <!-- Tombol Jelajahi Diperkecil Sedikit (Menggunakan btn-md, bukan btn-lg) & Style Center -->
            <div class="d-flex justify-content-center w-100">
                <a href="#fasilitas" class="btn btn-primary btn-md rounded-pill px-4 py-2 fw-bold shadow transition">
                    <i class="bi bi-info-circle me-1"></i> Jelajahi Selengkapnya
                </a>
            </div>

        </div>

        <!-- Ikon Panah Petunjuk Scroll (Style Center di bawah) -->
        <div
            class="position-absolute bottom-0 start-50 translate-middle-x mb-4 animate__animated animate__bounce animate__infinite">
            <a href="#fasilitas" class="text-white text-decoration-none opacity-75">
                <small class="d-block text-uppercase tracking-wider mb-1" style="font-size: 0.7rem;">Scroll
                    Kebawah</small>
                <i class="bi bi-chevron-double-down fs-5"></i>
            </a>
        </div>
    </div>
    </header>

    <!-- SEKSI FASILITAS KANTOR & GALERI -->
    <div id="fasilitas" class="py-5">
        <section id="seksi-fasilitas" class="section-padding bg-white">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="fw-bold text-dark">Fasilitas Kantor & Lingkungan Belajar</h2>
                    <div class="mx-auto bg-primary my-2" style="width: 60px; height: 3px;"></div>
                    <p class="text-muted">Daftar sarana prasarana yang tersedia untuk menunjang aktivitas warga
                        belajar.</p>
                </div>
            </div>
            <div class="row g-4 text-center mb-5">
                <div class="col-md-4">
                    <div class="p-4 border rounded shadow-sm bg-light h-100">
                        <i class="bi bi-laptop-fill text-primary display-5 mb-2"></i>
                        <h5 class="fw-bold">Smartboard</h5>
                        <p class="small text-muted mb-0">Tutor dapat memutar kuis interaktif (seperti Kahoot! atau
                            Quizizz) yang visualnya tampil besar dan menarik di papan.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 border rounded shadow-sm bg-light h-100">
                        <i class="bi bi-building-fill-check text-success display-5 mb-2"></i>
                        <h5 class="fw-bold">Ruang Kelas Kondusif</h5>
                        <p class="small text-muted mb-0">Ruangan representatif dan sejuk untuk menunjang kegiatan
                            pertemuan tatap muka berkala.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 border rounded shadow-sm bg-light h-100">
                        <i class="bi bi-journal-album text-warning display-5 mb-2"></i>
                        <h5 class="fw-bold">Sudut Baca Literasi</h5>
                        <p class="small text-muted mb-0">Menyediakan berbagai referensi modul cetak cetakan resmi
                            kurikulum kesetaraan.</p>
                    </div>
                </div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-4 col-sm-6">
                    <img src="{{ asset('images/ruangan julusiri.jpeg') }}" alt="Lingkungan Belajar PKBM Julu Siri"
                        class="img-fluid rounded shadow">
                </div>
                <div class="col-md-4 col-sm-6">
                    <img src="{{ asset('images/halaman julusiri.jpeg') }}" alt="Lingkungan Belajar PKBM Julu Siri"
                        class="img-fluid rounded shadow">
                </div>
                <div class="col-md-4 col-sm-6">
                    <img src="{{ asset('images/julusiri fto.webp') }}" alt="Lingkungan Belajar PKBM Julu Siri"
                        class="img-fluid rounded shadow">
                </div>
            </div>
    </div>
    </section>

    <!-- SEKSI PROFIL -->
    <section id="seksi-profil" class="section-padding bg-white">
        <div class="text-center mb-4 pb-3 border-bottom">
            <div class="bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center p-2 mb-2 mx-auto"
                style="width: 50px; height: 50px; background-color: #e3f2fd !important;">
                <i class="bi bi-building-check fs-4"></i>
            </div>
            <h4 class="fw-bold text-dark mb-0">PROFIL LEMBAGA/INSTANSI</h4>
        </div>

        <div class="d-flex flex-column gap-3">
            <div class="container px-4 my-5">
                <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-8 mx-auto">

                        <div class="card border-0 shadow-sm p-4 p-md-5"
                            style="border-radius: 15px; background: #ffffff;">
                            <div class="row align-items-center border-bottom pb-2">
                                <div class="col-sm-4 text-muted small fw-bold text-uppercase tracking-wider">
                                    <i class="bi bi-bookmark-star me-2 text-primary"></i>Nama Lembaga
                                </div>
                                <div class="col-sm-8 fw-bold text-dark fs-5">
                                    PKBM JULU SIRI
                                </div>
                            </div>

                            <div class="row align-items-center border-bottom pb-2">
                                <div class="col-sm-4 text-muted small fw-bold text-uppercase tracking-wider">
                                    <i class="bi bi-person-badge me-2 text-primary"></i>NAMA PIMPINAN :
                                </div>
                                <div class="col-sm-8 fw-semibold text-dark">
                                    [SAIFUL, S.Pd]
                                </div>
                            </div>

                            <div class="row align-items-center border-bottom pb-2">
                                <div class="col-sm-4 text-muted small fw-bold text-uppercase tracking-wider">
                                    <i class="bi bi-hash me-2 text-primary"></i>NPSN :
                                </div>
                                <div class="col-sm-8 fw-bold text-dark font-monospace" style="letter-spacing: 1px;">
                                    [P.9984290]
                                </div>
                            </div>

                            <div class="row align-items-center border-bottom pb-2">
                                <div class="col-sm-4 text-muted small fw-bold text-uppercase tracking-wider">
                                    <i class="bi bi-mortarboard me-2 text-primary"></i>JENIS LEMBAGA :
                                </div>
                                <div class="col-sm-8 text-dark">
                                    PENDIDIKAN NON FORMAL
                                </div>
                            </div>

                            <div class="row align-items-center pb-1">
                                <div class="col-sm-4 text-muted small fw-bold text-uppercase tracking-wider">
                                    <i class="bi bi-calendar-check me-2 text-primary"></i>TAHUN MULAI OPERASIONAL
                                </div>
                                <div class="col-sm-8 fw-semibold text-dark">
                                    [2019]
                                </div>
                            </div>

                        </div>
                    </div>
    </section>

    <!-- SEKSI VISI & MISI -->
    <section id="seksi-visimisi" class="section-padding bg-white">
        <div class="container">
            <div class="text-center mb-4">
                <h2 class="fw-bold text-dark">Visi & Misi</h2>
                <div class="mx-auto bg-primary my-2" style="width: 60px; height: 3px;"></div>
            </div>
            <div class="row g-4">
                <div class="col-md-6 border-end">
                    <h4 class="fw-bold text-primary text-center">Visi</h4>
                    <p class="text-muted text-center">Mewujudkan masyarakat yang berakhlak mulia, qur'ani, cerdas,
                        terampil, berdaya saing dan mengembangkan potensi lokal menuju masyarakat yang mandiri dan
                        berkarya.</p>
                </div>
                <div class="col-md-6">
                    <h4 class="fw-bold text-primary text-center">Misi</h4>
                    <ul class="text-muted">
                        <li>Pendidikan bagi semua kalangan masyarakat.</li>
                        <li>Mewujudkan warga belajar memiliki keterampilan sesuai dengan potensi yang dimiliki.</li>
                        <li>Memberantas kebuta aksaraan dikalangan masyarakat dan membekali masyarakat dengan ilmu dan
                            pengetahuan agar
                            menjadi masyarakat yang cerdas dan terampil.</li>
                        <li>Memberdayakan bakat, minat dan potensi masyarakat agar mampu menciptakan lapangan kerja
                            untuk kehidupan dimasa yang
                            akan datang.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>


    <!-- SEKSI STRUKTUR ORGANISASI -->
    <section id="seksi-struktur" class="section-padding bg-light">
        <div class="container">
            <!-- Judul Seksi -->
            <div class="text-center mb-5">
                <h2 class="fw-bold text-dark">Struktur Organisasi</h2>
                <div class="mx-auto bg-primary my-2" style="width: 60px; height: 3px;"></div>
                <p class="text-muted">Susunan pengelola dan manajemen inti PKBM JULU SIRI.</p>
            </div>

            <!-- Baris Struktur Sejajar Sebaris ke Kanan (Sekretaris -> Ketua -> Bendahara) -->
            <div class="row g-4 justify-content-center">

                <!-- 1. JABATAN SEKRETARIS (KIRI) -->
                <div class="col-md-4 text-center">
                    <div class="p-4 border rounded bg-white shadow-sm h-100">
                        <i class="bi bi-person-vcard-fill display-4 text-success mb-3 d-block"></i>
                        <h5 class="fw-bold mb-1 text-dark">Sekretaris</h5>
                        <p class="small text-muted mb-0">[RAYUS, S.Pd]</p>
                    </div>
                </div>

                <!-- 2. JABATAN KETUA (TENGAH) -->
                <div class="col-md-4 text-center">
                    <div class="p-4 border rounded bg-white shadow-sm h-100"
                        style="border-top: 4px solid #0b3c68 !important;">
                        <i class="bi bi-person-workspace display-4 text-primary mb-3 d-block"></i>
                        <h5 class="fw-bold mb-1 text-dark">Ketua PKBM</h5>
                        <p class="small text-muted mb-0">[SAIFUL, S.Pd]</p>
                    </div>
                </div>

                <!-- 3. JABATAN BENDAHARA (KANAN) -->
                <div class="col-md-4 text-center">
                    <div class="p-4 border rounded bg-white shadow-sm h-100">
                        <i class="bi bi-wallet2 display-4 text-warning mb-3 d-block"></i>
                        <h5 class="fw-bold mb-1 text-dark">Bendahara</h5>
                        <p class="small text-muted mb-0">[ANDI RISYDAH RESTU.P]</p>
                    </div>
                </div>
                <div class="container px-4 mt-5">

                    <div class="row g-4 justify-content-center">
                        <div class="col-md-5 col-lg-4">
                            <div class="d-flex flex-column gap-4">

                                <div class="card h-100 border-0 shadow-sm text-center p-4 animate__animated animate__fadeInUp"
                                    style="border-radius: 15px; background: #ffffff;">
                                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3 text-primary shadow-sm"
                                        style="width: 70px; height: 70px; background-color: #e3f2fd !important;">
                                        <i class="bi bi-book-half fs-2"></i>
                                    </div>
                                    <h5 class="fw-bold text-dark mb-1">MUH. WARIS, S.Pd</h5>
                                    <span
                                        class="badge bg-primary rounded-pill px-3 py-1.5 fw-bold mb-2 align-self-center"
                                        style="font-size: 0.75rem;">
                                        KEAKSARAAN
                                    </span>
                                </div>

                                <div class="card h-100 border-0 shadow-sm text-center p-4 animate__animated animate__fadeInUp"
                                    style="border-radius: 15px; background: #ffffff;">
                                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3 text-success shadow-sm"
                                        style="width: 70px; height: 70px; background-color: #e8f5e9 !important;">
                                        <i class="bi bi-mortarboard-fill fs-2"></i>
                                    </div>
                                    <h5 class="fw-bold text-dark mb-1">MUH. ZAKARIA</h5>
                                    <span
                                        class="badge bg-success rounded-pill px-3 py-1.5 fw-bold mb-2 align-self-center"
                                        style="font-size: 0.75rem;">
                                        KESETARAAN
                                    </span>
                                </div>

                                <div class="card h-100 border-0 shadow-sm text-center p-4 animate__animated animate__fadeInUp"
                                    style="border-radius: 15px; background: #ffffff;">
                                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3 text-warning shadow-sm"
                                        style="width: 70px; height: 70px; background-color: #fffde7 !important;">
                                        <i class="bi bi-collection-fill fs-2" style="color: #f57f17;"></i>
                                    </div>
                                    <h5 class="fw-bold text-dark mb-1">NURHAYATI, S.H</h5>
                                    <span
                                        class="badge bg-warning text-dark rounded-pill px-3 py-1.5 fw-bold mb-2 align-self-center"
                                        style="font-size: 0.75rem; background-color: #ffeb3b !important;">
                                        TBM
                                    </span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Section Peta & Kontak Kantor -->
                <div class="bg-light py-5 border-top">
                    <div class="container px-4">

                        <!-- Judul Seksi (Style Center) -->
                        <div class="text-center mb-5">
                            <span
                                class="badge bg-secondary text-uppercase px-3 py-2 rounded-pill mb-2 fw-bold text-xs">Informasi
                                Akses</span>
                            <h2 class="fw-bold text-dark mb-2">Hubungi & Kunjungi Kami</h2>
                            <p class="text-muted mx-auto" style="max-width: 600px;">Punya pertanyaan seputar
                                pendaftaran kesetaraan? Silakan hubungi admin atau kunjungi kantor operasional kami pada
                                jam kerja.</p>
                        </div>

                        <div id="kontak-kantor" class="bg-light py-5 border-top" style="scroll-margin-top: 70px;">
                            <div class="container px-4">
                                <div class="row g-4 align-items-stretch">
                                    <div class="col-lg-7">
                                        <div class="card h-100 border-0 shadow-sm overflow-hidden"
                                            style="border-radius: 15px;">
                                            <iframe <iframe
                                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3975.606334410731!2d119.53661977400687!3d-4.8374607498173745!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbe4f0079b3fa11%3A0x4a0bc6e6f5ae89e1!2sRaisyahVehicleWash!5e0!3m2!1sid!2sid!4v1782567102737!5m2!1sid!2sid"
                                                width="600" height="450" style="border:0;" allowfullscreen=""
                                                loading="lazy"
                                                referrerpolicy="strict-origin-when-cross-origin"></iframe>
                                            </iframe>
                                        </div>
                                    </div>
                                    <!-- KOLOM KANAN: Detail Kontak Kantor -->
                                    <div class="col-lg-5">
                                        <div class="card h-100 border-0 shadow-sm p-4 p-md-5 d-flex flex-column justify-content-center"
                                            style="border-radius: 15px; background: #ffffff;">

                                            <h4 class="fw-bold text-dark mb-4 border-bottom pb-2">
                                                <i class="bi bi-headset text-primary me-2"></i>Layanan Informasi
                                            </h4>

                                            <!-- Kontak 1: WhatsApp -->
                                            <div class="d-flex align-items-start mb-4">
                                                <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center p-3 me-3 shadow-sm"
                                                    style="width: 50px; height: 50px;">
                                                    <i class="bi bi-whatsapp fs-4"></i>
                                                </div>
                                                <div>
                                                    <span
                                                        class="text-muted small d-block fw-bold text-uppercase tracking-wider">WhatsApp
                                                        Admin</span>
                                                    <a href="https://wa.me/6288704491032" target="_blank"
                                                        class="text-decoration-none text-dark fw-bold fs-5 hover-link">
                                                        +62 887-0449-1032
                                                    </a>
                                                    <small class="text-muted d-block mt-1">Respons cepat pada hari &
                                                        jam kerja operasional.</small>
                                                </div>
                                            </div>

                                            <!-- Kontak 2: Email Kantor -->
                                            <div class="d-flex align-items-start mb-4">
                                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center p-3 me-3 shadow-sm"
                                                    style="width: 50px; height: 50px;">
                                                    <i class="bi bi-envelope-fill fs-4"></i>
                                                </div>
                                                <div>
                                                    <span
                                                        class="text-muted small d-block fw-bold text-uppercase tracking-wider">Email
                                                        Resmi Lembaga</span>
                                                    <a href="mailto:pkbm.julusiri@gmail.com"
                                                        class="text-decoration-none text-dark fw-bold fs-5 hover-link">
                                                        pkbm.julusiri@gmail.com
                                                    </a>
                                                    <small class="text-muted d-block mt-1">Kirimkan berkas kemitraan
                                                        atau surat resmi ke email kami.</small>
                                                </div>
                                            </div>

                                            <hr class="text-muted opacity-25 my-3">

                                            <!-- Info Tambahan Operasional -->
                                            <div class="p-3 bg-light rounded-3 border-start border-primary border-3">
                                                <span class="fw-bold d-block text-dark small"><i
                                                        class="bi bi-clock-fill me-1 text-primary"></i> Jam Operasional
                                                    Kantor</span>
                                                <small class="text-muted d-block mt-1"> Buka : Sabtu & Minggu, 08.00 -
                                                    16.00 WITA</small>
                                                <small class="text-muted d-block">Tutup : Senin - Jumat</small>
                                            </div>

                                        </div>
                                    </div>

                                </div> <!-- /row -->
                            </div> <!-- /container -->
                        </div>

    </section>
    <!-- ========================================================= -->
    <!-- 1. MODAL GABUNGAN: LOGIN & REGISTRASI AKTOR (TABS SYSTEM) -->
    <!-- ========================================================= -->
    <div class="modal fade" id="modalLoginRegister" tabindex="-1" aria-labelledby="modalLoginRegisterLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-primary text-white p-2">
                    <!-- Nav Tabs Bootstrap di dalam Header Modal -->
                    <ul class="nav nav-tabs border-0 w-100" id="authTab" role="tablist">
                        <li class="nav-item flex-fill text-center" role="presentation">
                            <button class="nav-link active text-white fw-bold border-0 bg-transparent w-100"
                                id="login-tab" data-bs-toggle="tab" data-bs-target="#login-panel" type="button"
                                role="tab" aria-controls="login-panel" aria-selected="true">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Login Masuk
                            </button>
                        </li>
                        
                    </ul>
                    <button type="button" class="btn-close btn-close-white me-2" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body p-4">
                    <div class="tab-content" id="authTabContent">

                        <!-- PANEL FORM LOGIN -->
                        <div class="tab-pane fade show active" id="login-panel" role="tabpanel"
                            aria-labelledby="login-tab">
                            <form
                                action="{{ method_exists(Route::class, 'has') && Route::has('login') ? route('login') : url('/login') }}"
                                method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-secondary">Alamat Email</label>
                                    <input type="email" name="email" class="form-control"
                                        placeholder="Masukkan email terdaftar" required autocomplete="email">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-secondary">Password</label>
                                    <input type="password" name="password" class="form-control"
                                        placeholder="Masukkan password" required autocomplete="current-password">
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                    <label class="form-check-label small text-muted" Taylor for="remember">Ingat
                                        Saya</label>
                                </div>
                                <button type="submit"
                                    class="btn btn-warning w-100 fw-bold text-dark py-2 shadow-sm">Masuk
                                    Aplikasi</button>
                            </form>
                        </div>

                        <!-- PANEL FORM REGISTRASI AKUN (ADMIN, TUTOR, SISWA) -->
                        <div class="tab-pane fade" id="register-panel" role="tabpanel"
                            aria-labelledby="register-tab">
                            <form
                                action="{{ method_exists(Route::class, 'has') && Route::has('register') ? route('register') : url('/register') }}"
                                method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-secondary">Daftar Sebagai (Aktor) <span
                                            class="text-danger">*</span></label>
                                    <select name="role" class="form-select border-primary fw-bold" required>
                                        <option value="siswa" selected>SISWA (Calon Warga Belajar)</option>
                                        <option value="tutor">TUTOR (Tenaga Pendidik)</option>
                                        <option value="admin">ADMIN (Pengelola Sistem)</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-secondary">Nama Pengguna Baru <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control"
                                        placeholder="Nama Akun" required autocomplete="name">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-secondary">Alamat Email Aktif <span
                                            class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control"
                                        placeholder="contoh@gmail.com" required autocomplete="email">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-secondary">Password Baru <span
                                            class="text-danger">*</span></label>
                                    <input type="password" name="password" class="form-control"
                                        placeholder="Minimal 8 Karakter" required autocomplete="new-password">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-secondary">Konfirmasi Password <span
                                            class="text-danger">*</span></label>
                                    <input type="password" name="password_confirmation" class="form-control"
                                        placeholder="Ulangi Password" required autocomplete="new-password">
                                </div>
                                <button type="submit" class="btn btn-primary w-100 fw-bold py-2 shadow-sm">Registrasi
                                    Akun Baru</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- ======================================================== -->
    <!-- 2. MODAL FORM PENDAFTARAN LENGKAP SISWA (TANPA FORM AKUN)-->
    <!-- ======================================================== -->
    <div class="modal fade" id="modalSiswaBaru" tabindex="-1" aria-labelledby="modalSiswaBaruLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-bold" id="modalSiswaBaruLabel"><i
                            class="bi bi-pencil-square me-2"></i>Formulir Biodata Pendaftaran Siswa Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    @if (session('error_data') || $errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            {{ session('error_data') ?? 'Gagal mengirim pendaftaran. Periksa kembali kelengkapan data Anda!' }}
                            <ul class="mb-0 mt-1 small">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Form Pengiriman berkas pendaftaran ke Route database Anda -->
                    <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- BAGIAN A: DATA DIRI CALON SISWA -->
                        <div class="form-section-title">A. Data Diri Calon Warga Belajar</div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary">Nama Lengkap (Sesuai Ijazah)
                                    <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control form-control-sm"
                                    placeholder="Nama Lengkap" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small fw-bold text-secondary">NIK (No. KTP/KK) <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="nik" class="form-control form-control-sm"
                                    placeholder="16 Digit NIK" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small fw-bold text-secondary">Pilihan Program Paket <span
                                        class="text-danger">*</span></label>
                                <select name="program_paket" class="form-select form-select-sm" required>
                                    <option value="">-- Pilih Paket --</option>
                                    <option value="Paket A">Paket A (Setara SD)</option>
                                    <option value="Paket B">Paket B (Setara SMP)</option>
                                    <option value="Paket C">Paket C (Setara SMA)</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small fw-bold text-secondary">Tempat Lahir <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="tempat_lahir" class="form-control form-control-sm"
                                    placeholder="Kota/Kabupaten" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small fw-bold text-secondary">Tanggal Lahir <span
                                        class="text-danger">*</span></label>
                                <input type="date" name="tanggal_lahir" class="form-control form-control-sm"
                                    required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small fw-bold text-secondary">Jenis Kelamin <span
                                        class="text-danger">*</span></label>
                                <select name="jenis_kelamin" class="form-select form-select-sm" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small fw-bold text-secondary">No. HP / WhatsApp <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="no_hp" class="form-control form-control-sm"
                                    placeholder="08xxxxxx" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold text-secondary">Alamat Rumah Lengkap <span
                                        class="text-danger">*</span></label>
                                <textarea name="alamat" class="form-control form-control-sm" rows="2"
                                    placeholder="Nama Jalan, RT/RW, Desa/Kelurahan, Kecamatan" required></textarea>
                            </div>
                        </div>

                        <!-- BAGIAN B: DATA ORANG TUA / WALI -->
                        <div class="form-section-title">B. Data Orang Tua / Wali</div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary">Nama Ayah Kandung <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="nama_ayah" class="form-control form-control-sm"
                                    placeholder="Nama Ayah" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary">Nama Ibu Kandung <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="nama_ibu" class="form-control form-control-sm"
                                    placeholder="Nama Ibu" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary">Pekerjaan Orang Tua</label>
                                <input type="text" name="pekerjaan_ortu" class="form-control form-control-sm"
                                    placeholder="Contoh: Buruh, Tani, PNS, Wiraswasta">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary">No. HP Orang Tua / Wali</label>
                                <input type="text" name="no_hp_ortu" class="form-control form-control-sm"
                                    placeholder="Nomor kontak aktif">
                            </div>
                        </div>

                        <!-- BAGIAN C: ASAL SEKOLAH SEBELUMNYA -->
                        <div class="form-section-title mt-3 fw-bold text-dark">C. Asal Sekolah & Berkas Pendidikan
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary">Nama Sekolah Sebelumnya /
                                    Terakhir</label>
                                <input type="text" name="sekolah_asal" class="form-control form-control-sm"
                                    placeholder="Contoh: SMK 2 BUNGORO">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary">Tahun Lulus / Tahun
                                    Keluar</label>
                                <input type="text" name="tahun_keluar" class="form-control form-control-sm"
                                    placeholder="Contoh: 2025">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary">Upload Scan/Foto KTP <span
                                        class="text-danger">*</span></label>
                                <input type="file" name="file_ktp" class="form-control form-control-sm"
                                    accept="image/*" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary">Upload Scan/Foto Kartu Keluarga
                                    (KK) <span class="text-danger">*</span></label>
                                <input type="file" name="file_kk" class="form-control form-control-sm"
                                    accept="image/*" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary">Upload Scan/Foto Ijazah Terakhir
                                    <span class="text-danger">*</span></label>
                                <input type="file" name="file_ijazah" class="form-control form-control-sm"
                                    accept="image/*" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary">Upload Scan/Foto Akta Kelahiran
                                    <span class="text-danger">*</span></label>
                                <input type="file" name="file_akta" class="form-control form-control-sm"
                                    accept="image/*" required>
                            </div>
                        </div>
                        <div class="col-12 text-end mt-4">
                            <button type="button" class="btn btn-secondary btn-sm"
                                data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary btn-sm px-4 fw-bold shadow-sm">Kirim Berkas
                                Pendaftaran</button>
                        </div>
                </div>

                </form>
            </div>
        </div>
    </div>
    </div>


    <footer class="bg-dark text-white text-center py-4">
        <div class="container">
            <small class="text-white-50">&copy; 2026 PKBM JULU SIRI</small>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle dengan Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

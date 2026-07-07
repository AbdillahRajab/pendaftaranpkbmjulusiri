<?php
    if (!isset($total_pendaftar)) {
        $total_pendaftar = 0;
    }
    if (!isset($total_siswa)) {
        $total_siswa = 0;
    }
    if (!isset($total_tutor)) {
        $total_tutor = 0;
    }
    if (!isset($total_admin)) {
        $total_admin = 0;
    }
    if (!isset($data_siswa)) {
        $data_siswa = collect();
    }
    if (!isset($daftar_kelas)) {
        $daftar_kelas = collect();
    }
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Portal E-Learning - PKBM JULU SIRI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            width: 260px;
            background-color: #001f3f;
        }

        .sidebar .nav-link {
            font-weight: bold;
            color: #b8c7ce;
            padding: 12px 20px;
            border-radius: 4px;
            margin: 2px 10px;
            display: flex;
            align-items: center;
            text-decoration: none;
            cursor: pointer;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        .sidebar .nav-link.active {
            background-color: #003366;
        }

        .sidebar-heading {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: .1rem;
            font-weight: bold;
            color: #6c757d;
            padding: 15px 20px 5px;
        }

        .main-content {
            margin-left: 260px;
            padding-top: 100px;
        }

        .navbar-top {
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
            left: 260px;
            width: calc(100% - 260px);
        }

        .nav-pills .nav-link,
        .sidebar .nav-link,
        .nav-item .nav-link {
            transition: all 0.3s ease;
            color: #495057;
        }

        .nav-pills .nav-link:hover,
        .sidebar .nav-link:hover,
        .nav-item .nav-link:hover {
            background-color: #f8f9fa !important;
            /* Warna latar belakang jadi terang/abu-abu halus */
            color: #0d6efd !important;
            /* Warna teks/ikon berubah jadi biru cerah */
            padding-left: 20px !important;
            /* Efek geser sedikit ke kanan biar estetik */
            font-weight: bold;
        }

        .bg-dark .nav-link:hover,
        .sidebar-dark .nav-link:hover {
            background-color: #212529 !important;
            /* Latar belakang abu-abu gelap */
            color: #ffffff !important;
            /* Teks jadi putih bersih */
            padding-left: 20px !important;
        }

        .nav-pills .nav-link.active,
        .sidebar .nav-link.active {
            background-color: #0d6efd !important;
            /* Warna biru saat aktif */
            color: white !important;
        }
    </style>
</head>

<body>

    <!-- SIDEBAR KIRI -->
    <div class="sidebar">
        <div class="text-center py-4 border-bottom border-secondary">
            <img src="<?php echo e(asset('images/logo3.png')); ?>" alt="Logo PKBM" width="40" height="40"
                class="d-inline-block align-top img-fluid">
            <h5 class="text-white fw-bold mb-0">PKBM JULU SIRI</h5>
            <small class="text-warning font-monospace" style="font-size: 0.75rem;">PANEL
                <?php echo e(strtoupper(Auth::user()->role)); ?></small>
        </div>

        <div class="nav pt-3 gap-1" id="v-pills-tab" role="tablist" aria-orientation="vertical"
            style="max-height: calc(100vh - 140px); overflow-y: auto !important; overflow-x: hidden !important; display: block !important; width: 100% !important; padding-bottom: 50px;">

            <p class="sidebar-heading mb-1 px-3 small text-uppercase fw-bold text-white opacity-75"
                style="font-size: 11px; letter-spacing: 0.5px;">Menu Utama</p>
            <button class="nav-link border-0 text-start bg-transparent text-white w-100 d-block mb-2 active"
                id="tab-dashboard" data-bs-toggle="pill" data-bs-target="#panel-dash" type="button" role="tab">
                <i class="bi bi-speedometer2 me-3"></i> Dashboard
            </button>

            <?php if(Auth::user()->role == 'admin'): ?>
                <p class="sidebar-heading mb-1 mt-3 px-3 small text-uppercase fw-bold text-white opacity-75"
                    style="font-size: 11px; letter-spacing: 0.5px;">Kelola Pendaftar</p>
                <button class="nav-link border-0 text-start bg-transparent text-info w-100 d-block mb-2"
                    id="tab-pendaftar" data-bs-toggle="pill" data-bs-target="#panel-pendaftar" type="button"
                    role="tab">
                    <i class="bi bi-clipboard2-check-fill me-3"></i> Data Pendaftar
                </button>

                <p class="sidebar-heading mb-1 mt-3 px-3 small text-uppercase fw-bold text-white opacity-75"
                    style="font-size: 11px; letter-spacing: 0.5px;">Manajemen Pengguna</p>
                <button class="nav-link border-0 text-start bg-transparent text-warning w-100 d-block mb-1"
                    id="tab-admin" data-bs-toggle="pill" data-bs-target="#panel-user" type="button" role="tab">
                    <i class="bi bi-shield-lock-fill me-3"></i> Data User
                </button>
                <button class="nav-link border-0 text-start bg-transparent text-success w-100 d-block mb-1"
                    id="tab-tutor" data-bs-toggle="pill" data-bs-target="#panel-tutor" type="button" role="tab">
                    <i class="bi bi-person-badge-fill me-3"></i> Data Tutor
                </button>
                <button class="nav-link border-0 text-start bg-transparent text-white w-100 d-block mb-2" id="tab-siswa"
                    data-bs-toggle="pill" data-bs-target="#panel-siswa" type="button" role="tab">
                    <i class="bi bi-people-fill me-3"></i> Data Warga Belajar
                </button>

                <p class="sidebar-heading mb-1 mt-3 px-3 small text-uppercase fw-bold text-white opacity-75"
                    style="font-size: 11px; letter-spacing: 0.5px;">Kelola Akademik</p>
                <button class="nav-link border-0 text-start bg-transparent text-white w-100 d-block mb-1" id="tab-kelas"
                    data-bs-toggle="pill" data-bs-target="#panel-kelas" type="button" role="tab">
                    <i class="bi bi-houses-fill me-3 text-warning"></i> Ruang Kelas
                </button>
                <button class="nav-link border-0 text-start bg-transparent text-white w-100 d-block mb-1" id="tab-mapel"
                    data-bs-toggle="pill" data-bs-target="#panel-mapel" type="button" role="tab">
                    <i class="bi bi-book-half me-3 text-warning"></i> Mata Pelajaran
                </button>
                <button class="nav-link border-0 text-start bg-transparent text-white w-100 d-block mb-1"
                    id="tab-materi" data-bs-toggle="pill" data-bs-target="#panel-materi" type="button" role="tab">
                    <i class="bi bi-file-earmark-text-fill me-3 text-warning"></i> Materi
                </button>
                <button class="nav-link border-0 text-start bg-transparent text-white w-100 d-block mb-1" id="tab-tugas"
                    data-bs-toggle="pill" data-bs-target="#panel-tugas" type="button" role="tab">
                    <i class="bi bi-pencil-square me-3 text-warning"></i> Tugas
                </button>
                <button class="nav-link border-0 text-start bg-transparent text-white w-100 d-block mb-1"
                    id="tab-berita" data-bs-toggle="pill" data-bs-target="#panel-berita" type="button" role="tab">
                    <i class="bi bi-newspaper me-3 text-warning"></i> Berita & Info
                </button>
        </div>


        
    <?php elseif(Auth::user()->role == 'tutor'): ?>
        <p class="sidebar-heading mb-1">Akademik Tutor</p>
        <button class="nav-link border-0 text-start bg-transparent text-white" id="tab-jadwal-tutor"
            data-bs-toggle="pill" data-bs-target="#panel-jadwal-tutor" type="button" role="tab"><i
                class="bi bi-calendar-event me-3"></i> Profil Tutor</button>
        <button class="nav-link border-0 text-start bg-transparent text-success" id="tab-materi"
            data-bs-toggle="pill" data-bs-target="#panel-materi" type="button" role="tab"><i
                class="bi bi-cloud-arrow-up-fill me-3"></i> Kelas Pembelajaran</button>

        
    <?php elseif(Auth::user()->role == 'siswa'): ?>
        <p class="sidebar-heading mb-1">Ruang Belajar</p>
        <button class="nav-link border-0 text-start bg-transparent text-white" id="tab-kelas-siswa"
            data-bs-toggle="pill" data-bs-target="#panel-kelas-siswa" type="button" role="tab"><i
                class="bi bi-house-door-fill me-3"></i> Kelas Pembelajaran</button>
        <button class="nav-link border-0 text-start bg-transparent text-warning" data-bs-toggle="pill"
            data-bs-target="#panel-kelas-saya">
            <i class="bi bi-journal-bookmark-fill me-3"></i>Kelas Saya</button>
        <?php endif; ?>
    </div>
    </div>

    <!-- NAVBAR ATAS -->
    <nav class="navbar navbar-expand-md navbar-top fixed-top p-0">
        <div class="container-fluid px-4 py-2 d-flex justify-content-between align-items-center">
            <span class="navbar-text fw-semibold text-dark"><i class="bi bi-calendar3 me-2"></i> Portal Pembelajaran
                PKBM JULU SIRI</span>
            <div class="dropdown">
                <button class="btn btn-light btn-sm dropdown-toggle fw-bold" type="button"
                    data-bs-toggle="dropdown">
                    <i class="bi bi-person-circle text-primary"></i> <?php echo e(Auth::user()->name); ?>

                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                    <li>
                        <form action="<?php echo e(route('logout')); ?>" method="POST" class="px-2">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-danger btn-sm w-100 text-start rounded"><i
                                    class="bi bi-box-arrow-right me-2"></i> Keluar Sistem</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- AREA KONTEN UTAMA -->
    <div class="main-content px-4 py-3">

        <!-- Notifikasi Sukses / Gagal Verifikasi -->
        <?php if(session('sukses_data')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> <?php echo e(session('sukses_data')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="tab-content" id="v-pills-tabContent">

            <!-- PANEL DASHBOARD COMNAL -->
            <div class="tab-pane fade show active pt-3" id="panel-dash" role="tabpanel">
                <div class="card border-0 p-4 rounded-3 shadow-sm bg-white mb-4 mt-2">
                    <h3 class="fw-bold text-dark mb-1">Selamat Datang di Portal Utama, <?php echo e(Auth::user()->name); ?>!</h3>
                    <p class="text-muted mb-0">Otoritas Akses Anda: <span
                            class="badge bg-dark"><?php echo e(strtoupper(Auth::user()->role)); ?></span></p>
                    <div class="row mb-4"></div>
                </div>


                <?php if(Auth::user()->role !== 'admin'): ?>
                    <div class="card border-0 shadow-sm rounded-3 bg-white p-4">
                        <h5 class="fw-bold text-primary"><i class="bi bi-megaphone-fill me-2"></i> Pengumuman Akademik
                            Terbaru</h5>
                        <hr class="text-muted">
                        <p class="text-secondary small mb-1"><strong>Diposting Oleh:</strong> Admin Sistem</p>
                        <p class="mb-0 text-dark">Selamat bergabung di Aplikasi E-Learning PKBM JULU SIRI. Silakan
                            periksa menu navigasi di sebelah kiri Anda untuk mengakses sistem pembelajaran.</p>
                    </div>
                <?php endif; ?>

                <?php if(Auth::user()->role == 'admin'): ?>
                    <div class="row g-3 mt-3">
                        <div class="col-md-3">
                            <div
                                class="card border-0 bg-white p-3 rounded-3 shadow-sm d-flex flex-row align-items-center justify-content-between">
                                <div><small class="text-muted fw-bold">CALON PENDAFTAR</small>
                                    <h3 class="fw-bold mb-0 text-danger"><?php echo e($total_pendaftar); ?> Orang</h3>
                                </div>
                                <div class="bg-danger bg-opacity-10 text-danger p-3 rounded-3"><i
                                        class="bi bi-clipboard2-data fs-3"></i></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div
                                class="card border-0 bg-white p-3 rounded-3 shadow-sm d-flex flex-row align-items-center justify-content-between">
                                <div><small class="text-muted fw-bold">WARGA BELAJAR</small>
                                    <h3 class="fw-bold mb-0 text-primary"><?php echo e($total_siswa); ?> Siswa</h3>
                                </div>
                                <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-3"><i
                                        class="bi bi-people fs-3"></i></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div
                                class="card border-0 bg-white p-3 rounded-3 shadow-sm d-flex flex-row align-items-center justify-content-between">
                                <div><small class="text-muted fw-bold">TOTAL TUTOR</small>
                                    <h3 class="fw-bold mb-0 text-success"><?php echo e($total_tutor); ?> Pengajar</h3>
                                </div>
                                <div class="bg-success bg-opacity-10 text-success p-3 rounded-3"><i
                                        class="bi bi-person-workspace fs-3"></i></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div
                                class="card border-0 bg-white p-3 rounded-3 shadow-sm d-flex flex-row align-items-center justify-content-between">
                                <div><small class="text-muted fw-bold">TOTAL ADMIN</small>
                                    <h3 class="fw-bold mb-0 text-warning"><?php echo e($total_admin); ?> User</h3>
                                </div>
                                <div class="bg-warning bg-opacity-10 text-warning p-3 rounded-3"><i
                                        class="bi bi-shield-lock fs-3"></i></div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <?php if(Auth::user()->role == 'admin'): ?>
                <!-- TABEL DATA SISWA -->
                <div class="tab-pane fade" id="panel-siswa" role="tabpanel">
                    <div class="card border-0 p-4 rounded-3 shadow-sm bg-white mt-4">
                        <h5 class="fw-bold mb-3 text-dark"><i class="bi bi-people-fill text-primary me-2"></i>Tabel
                            Data Warga Belajar / Siswa</h5>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        <th>Alamat Email</th>
                                        <th>Role</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $data_siswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td><?php echo e($key + 1); ?></td>
                                            <td class="fw-bold text-dark"><?php echo e($s->name); ?></td>
                                            <td><?php echo e($s->email); ?></td>
                                            <td><span class="badge bg-primary">Siswa</span></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-3">Belum ada akun
                                                siswa.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                
                <div class="tab-pane fade" id="panel-kelas" role="tabpanel">
                    <div class="card border-0 p-4 rounded-3 shadow-sm bg-white mt-4">
                        <h5 class="fw-bold mb-3 text-dark">
                            <i class="bi bi-houses-fill text-warning me-2"></i>Manajemen Ruang Kelas
                        </h5>
                        <p class="text-muted small">
                            Konten manajemen ruang kelas hasil request tutor diletakkan di sini. Anda dapat membuat
                            kelas baru dan menunjuk Tutor yang bertanggung jawab.
                        </p>

                        <button class="btn btn-primary btn-sm rounded-2 mt-2" data-bs-toggle="modal"
                            data-bs-target="#modalTambahKelas" style="width: fit-content;">
                            <i class="bi bi-plus-lg me-1"></i> Buat Kelas Baru (Request Tutor)
                        </button>
                    </div>

                    <hr class="my-4">

                    <h6 class="fw-bold mb-3">Daftar Kelas</h6>

                    <?php $__empty_1 = true; $__currentLoopData = $data_kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kelas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="card mb-2 border-0 shadow-sm">
                            <div class="card-body">
                                <h6 class="mb-1"><?php echo e($kelas->nama_kelas); ?></h6>
                                <small class="text-muted">
                                    Nama Tutor : <?php echo e($kelas->nama_tutor); ?>

                                </small>
                                <p class="mb-0 mt-2 text-secondary">
                                    <?php echo e($kelas->deskripsi); ?>

                                </p>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="alert alert-warning">
                            Belum ada kelas dibuat.
                        </div>
                    <?php endif; ?>

                    <div class="modal fade" id="modalTambahKelas" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="<?php echo e(route('admin.simpanKelas')); ?>" method="POST"
                                class="modal-content border-0 shadow-lg rounded-4">
                                <?php echo csrf_field(); ?>
                                <div class="modal-header bg-dark text-white">
                                    <h5 class="modal-title fw-bold">
                                        <i class="bi bi-plus-circle me-2"></i>Buat Kelas Baru
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold text-secondary">Nama Kelas
                                            Pembelajaran</label>
                                        <input type="text" name="nama_kelas" class="form-control"
                                            placeholder="Contoh: Matematika Paket C (Kelas XI)" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold text-secondary">Pilih Tutor /
                                            Pengajar</label>
                                        <select name="tutor_id" class="form-select" required>
                                            <option value="">-- Pilih Tutor Penanggung Jawab --</option>
                                            <?php
                                                // Mengambil data user yang memiliki role tutor secara langsung
                                                $listTutor = \DB::select(
                                                    "SELECT id, name FROM users WHERE role = 'tutor'",
                                                );
                                            ?>
                                            <?php $__currentLoopData = $listTutor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tutor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($tutor->id); ?>"><?php echo e($tutor->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold text-secondary">Deskripsi atau
                                            Instruksi</label>
                                        <textarea name="deskripsi" class="form-control" rows="3"
                                            placeholder="Tulis deskripsi ringkas atau aturan kelas..."></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer bg-light">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Konfirmasi & Buat Kelas</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="panel-mapel" role="tabpanel">
                    <div class="card border-0 p-4 rounded-3 shadow-sm bg-white mt-4">
                        <h5 class="fw-bold mb-3 text-dark"><i class="bi bi-book-half text-warning me-2"></i>Manajemen
                            Mata Pelajaran</h5>
                        <p class="text-muted">Konten manajemen data mata pelajaran akan diletakkan di sini.</p>
                    </div>
                </div>


                <div class="tab-pane fade" id="panel-berita" role="tabpanel">
                    <div class="card border-0 p-4 rounded-3 shadow-sm bg-white mt-4">
                        <h5 class="fw-bold mb-3 text-dark"><i class="bi bi-newspaper text-warning me-2"></i>Berita &
                            Informasi</h5>
                        <p class="text-muted">Konten pengumuman dan berita PKBM akan diletakkan di sini.</p>
                    </div>
                </div>

                <!-- TABEL DATA TUTOR (YANG TADI KOSONG DI SCREENSHOT 39) -->
                <div class="tab-pane fade" id="panel-tutor" role="tabpanel">
                    <div class="card border-0 p-4 rounded-3 shadow-sm bg-white mt-4">
                        <h5 class="fw-bold mb-3 text-dark"><i
                                class="bi bi-person-badge-fill text-success me-2"></i>Tabel Data Tenaga Pengajar /
                            Tutor</h5>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Tutor</th>
                                        <th>Alamat Email</th>
                                        <th>Role</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $data_tutor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td><?php echo e($key + 1); ?></td>
                                            <td class="fw-bold text-success"><?php echo e($t->name); ?></td>
                                            <td><?php echo e($t->email); ?></td>
                                            <td><span class="badge bg-success">Tutor</span></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-3">Belum ada akun
                                                tutor yang terdaftar.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                

                <div class="tab-pane fade" id="panel-user" role="tabpanel">
                    <div class="card border-0 p-4 rounded-3 shadow-sm bg-white mt-4">
                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div><?php echo e($error); ?></div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>
                        <h5 class="fw-bold mb-3 text-dark"><i
                                class="bi bi-shield-lock-fill text-warning me-2"></i>Tabel Data USER</h5>
                        <?php if(session('success')): ?>
                            <div class="alert alert-success alert-dismissible fade show mb-3" role="alert"
                                style="color: #155724; background-color: #d4edda; border-color: #c3e6cb; padding: 12px; border-radius: 6px;">
                                <strong>Sukses!</strong> <?php echo e(session('success')); ?>

                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"
                                    style="float: right; background: none; border: none; font-size: 20px; font-weight: bold; opacity: .5; cursor: pointer;">×</button>
                            </div>
                        <?php endif; ?>
                        <button class="btn btn-warning mb-3" data-bs-toggle="modal"
                            data-bs-target="#modalTambahUser">
                            <i class="bi bi-plus-circle"></i> Tambah User
                        </button>
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle">
                                <thead class="table-warning">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama user</th>
                                        <th>Alamat Email</th>
                                        <th>Role</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $data_user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $usr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td><?php echo e($key + 1); ?></td>
                                            <td class="fw-bold text-dark"><?php echo e($usr->name); ?></td>
                                            <td><?php echo e($usr->email); ?></td>
                                            <td><?php echo e($usr->role); ?></td>
                                            <td class="text-center">
                                                <button class="btn btn-secondary btn-xs py-1 px-2 text-xs fw-bold me-1"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalEditUser<?php echo e($usr->id); ?>">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </button>

                                                <form action="<?php echo e(route('admin.user.destroy', $usr->id)); ?>"
                                                    method="POST" class="d-inline m-0"
                                                    onsubmit="return confirm('Yakin ingin menghapus pengguna <?php echo e($usr->name); ?>?')">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit"
                                                        class="btn btn-danger btn-xs py-1 px-2 text-xs fw-bold">
                                                        <i class="bi bi-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="3" class="text-center text-muted py-3">Belum ada admin.
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php $__currentLoopData = $data_user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="modal fade" id="modalEditUser<?php echo e($usr->id); ?>" data-bs-backdrop="static"
                        tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold"><i
                                            class="bi bi-pencil-square text-warning me-2"></i>Edit Data User</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="<?php echo e(route('admin.user.update', $usr->id)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <div class="modal-body">
                                        <div class="form-group mb-3">
                                            <label class="fw-bold text-dark mb-1">Nama User</label>
                                            <input type="text" name="name" class="form-control"
                                                value="<?php echo e($usr->name); ?>" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="fw-bold text-dark mb-1">Alamat Email</label>
                                            <input type="email" name="email" class="form-control"
                                                value="<?php echo e($usr->email); ?>" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="fw-bold text-dark mb-1">Password Baru <small
                                                    class="text-muted">(Kosongkan jika tidak diganti)</small></label>
                                            <input type="password" id="password" name="password"
                                                class="form-control">
                                            <div class="invalid-feedback" id="passwordError"></div>
                                            
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="fw-bold text-dark mb-1">Role / Hak Akses</label>
                                            <select name="role" class="form-control" required>
                                                <option value="admin" <?php echo e($usr->role == 'admin' ? 'selected' : ''); ?>>
                                                    Admin</option>
                                                <option value="tutor" <?php echo e($usr->role == 'tutor' ? 'selected' : ''); ?>>
                                                    Tutor</option>
                                                <option value="siswa" <?php echo e($usr->role == 'siswa' ? 'selected' : ''); ?>>
                                                    Siswa</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-warning text-white fw-bold">Simpan
                                            Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
                <div class="modal fade" id="modalTambahUser" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <form
                                action="<?php echo e(method_exists(Route::class, 'has') && Route::has('register') ? route('register') : url('/register')); ?>"
                                method="POST">
                                <?php echo csrf_field(); ?>

                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah User</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">

                                    <div class="mb-3">
                                        <label>Nama</label>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Konfirmasi Password</label>
                                        <input type="password" name="password_confirmation"class="form-control"
                                            required>
                                    </div>


                                    <div class="mb-3">
                                        <label>Role</label>
                                        <select name="role" class="form-select">
                                            <option value="admin">Admin</option>
                                            <option value="tutor">Tutor</option>
                                            <option value="siswa">Siswa</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-warning">Simpan</button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
                <!-- TABEL DATA PENDAFTAR (YANG TADI TANPA NAMA DI SCREENSHOT 40) -->
                <div class="tab-pane fade" id="panel-pendaftar" role="tabpanel">
                    <div class="card border-0 p-4 rounded-3 shadow-sm bg-white mt-4">
                        <h5 class="fw-bold mb-3 text-dark"><i
                                class="bi bi-clipboard2-check-fill text-info me-2"></i>Manajemen Calon Siswa Baru</h5>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover align-middle">
                                <?php if(session()->has('status_update')): ?>
                                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm my-3"
                                        role="alert"
                                        style="border-radius: 10px; background-color: #d1e7dd; color: #0f5132;">
                                        <i class="bi bi-check-circle-fill me-2"></i>
                                        <strong>Berhasil!</strong> <?php echo e(session('status_update')); ?>

                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                <?php endif; ?>
                                <?php if(session('success_pendaftar')): ?>
                                    <div class="alert alert-success alert-dismissible fade show mb-3" role="alert"
                                        style="color: #155724; background-color: #d4edda; border-color: #c3e6cb; padding: 12px; border-radius: 6px;">
                                        <strong>Sukses!</strong> <?php echo e(session('success_pendaftar')); ?>

                                        <a href="<?php echo e(url()->current()); ?>" class="btn-close"
                                            style="float: right; text-decoration: none; font-size: 20px; font-weight: bold; opacity: .5; color: #000; line-height: 0.8;">×</a>
                                    </div>
                                <?php endif; ?>
                                <thead class="table-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Lengkap</th>
                                        <th>Pilihan Paket</th>
                                        <th>Status Berkas</th>
                                        <th>Aksi Verifikasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $data_pendaftar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td><?php echo e($key + 1); ?></td>
                                            <td class="fw-bold text-dark"><?php echo e($p->nama); ?></td>
                                            <td><span
                                                    class="badge bg-secondary"><?php echo e(strtoupper($p->paket ?? 'Paket C')); ?></span>
                                            </td>

                                            <td>
                                                <?php if(($p->status ?? 'Pending') == 'Diterima' || ($p->status ?? 'Pending') == 'Disetujui'): ?>
                                                    <span class="badge bg-success">Disetujui</span>
                                                <?php elseif(($p->status ?? 'Pending') == 'Ditolak'): ?>
                                                    <span class="badge bg-danger">Ditolak</span>
                                                <?php else: ?>
                                                    <span class="badge bg-warning text-dark">Pending / Perlu
                                                        Diperiksa</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <?php if(($p->status ?? 'Pending') == 'Pending'): ?>
                                                        <form
                                                            action="<?php echo e(route('admin.pendaftaran.status', ['id' => $p->id, 'status' => 'Diterima'])); ?>"
                                                            method="POST" class="d-inline m-0">
                                                            <?php echo csrf_field(); ?>
                                                            <button type="submit"
                                                                class="btn btn-success btn-xs py-1 px-2 text-xs fw-bold"><i
                                                                    class="bi bi-check-lg"></i> Setuju</button>
                                                        </form>

                                                        <form
                                                            action="<?php echo e(route('admin.pendaftaran.status', ['id' => $p->id, 'status' => 'Ditolak'])); ?>"
                                                            method="POST" class="d-inline m-0">
                                                            <?php echo csrf_field(); ?>
                                                            <button type="submit"
                                                                class="btn btn-danger btn-xs py-1 px-2 text-xs fw-bold"><i
                                                                    class="bi bi-x-lg"></i> Tolak</button>
                                                        </form>
                                                    <?php endif; ?>

                                                    <a href="<?php echo e(route('admin.pendaftaran.show', $p->id)); ?>"
                                                        class="btn btn-info btn-xs py-1 px-2 text-xs fw-bold text-white">
                                                        <i class="bi bi-eye-fill"></i> Lihat
                                                    </a>

                                                    <form action="<?php echo e(route('admin.pendaftaran.destroy', $p->id)); ?>"
                                                        method="POST" class="d-inline m-0"
                                                        onsubmit="return confirm('Yakin ingin menghapus pendaftar <?php echo e($p->nama); ?>?')">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit"
                                                            class="btn btn-secondary btn-xs py-1 px-2 text-xs fw-bold">
                                                            <i class="bi bi-trash"></i> Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="5" class="text-center text-muted py-3">Belum ada data
                                                formulir pendaftar masuk.</td>
                                        </tr>
                                    <?php endif; ?>
                                    <script>
                                        document.addEventListener("DOMContentLoaded", function() {
                                            // 1. Cek apakah ada tab aktif yang disimpan di memori browser (localStorage)
                                            var activeTab = localStorage.getItem('activeAdminTab');
                                            if (activeTab) {
                                                var tabElement = document.querySelector('button[data-bs-target="' + activeTab + '"]') ||
                                                    document.querySelector('a[href="' + activeTab + '"]');
                                                if (tabElement) {
                                                    var tab = new bootstrap.Tab(tabElement);
                                                    tab.show();
                                                }
                                            }

                                            // 2. Simpan tab baru ke memori browser setiap kali Admin mengklik sidebar / tab lain
                                            var tabTriggerList = [].slice.call(document.querySelectorAll(
                                                '[data-bs-toggle="tab"], [data-bs-toggle="pill"]'));
                                            tabTriggerList.forEach(function(tabTriggerEl) {
                                                tabTriggerEl.addEventListener('shown.bs.tab', function(event) {
                                                    var targetId = event.target.getAttribute('data-bs-target') || event.target
                                                        .getAttribute('href');
                                                    localStorage.setItem('activeAdminTab', targetId);
                                                });
                                            });
                                        });
                                    </script>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            
            <div class="tab-pane fade" id="panel-jadwal-tutor" role="tabpanel" aria-labelledby="tab-jadwal-tutor">
                <div class="card border-0 shadow-sm p-4 mt-4 bg-white rounded">
                    <h5 class="fw-bold text-dark mb-4 pb-2 border-bottom">
                        <i class="bi bi-person-circle me-2 text-primary"></i>Profil Resmi Tutor
                    </h5>

                    <div class="table-responsive">
                        <table class="table table-borderless align-middle">
                            <tbody>
                                <tr class="border-bottom">
                                    <td width="200" class="text-muted fw-semibold py-3">Nama Tutor:</td>
                                    <td class="fw-bold text-dark py-3"><?php echo e(Auth::user()->name); ?></td>
                                </tr>
                                <tr class="border-bottom">
                                    <td class="text-muted fw-semibold py-3">Email Akun:</td>
                                    <td class="text-secondary py-3"><?php echo e(Auth::user()->email); ?></td>
                                </tr>
                                <tr class="border-bottom">
                                    <td class="text-muted fw-semibold py-3">Bidang Keahlian:</td>
                                    <td class="py-3">
                                        <?php if(Auth::user()->keahlian): ?>
                                            <span
                                                class="badge bg-info-subtle text-info px-2 py-1 fw-semibold"><?php echo e(Auth::user()->keahlian); ?></span>
                                        <?php else: ?>
                                            <span
                                                class="badge bg-secondary-subtle text-secondary px-2 py-1 fw-semibold">Belum
                                                Diatur Admin</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted fw-semibold py-3">No. HP / WhatsApp:</td>
                                    <td class="text-secondary py-3">
                                        <?php echo e(Auth::user()->no_hp ?? 'Belum diisi oleh Admin'); ?>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            
            <div class="tab-pane fade" id="panel-materi" role="tabpanel" aria-labelledby="tab-materi">
                <div class="card border-0 shadow-sm p-4 mt-4 bg-white rounded">
                    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                        <div>
                            <h4 class="fw-bold text-dark mb-1">Ruang Kelas Pembelajaran</h4>
                            <p class="text-muted small mb-0">Kelola ruang belajar virtual dan distribusikan materi
                                bimbingan Anda di sini.</p>
                        </div>
                    </div>

                    <h6 class="fw-bold text-secondary mb-3"><i
                            class="bi bi-grid-3x3-gap-fill me-2 text-primary"></i>Daftar Kelas Aktif Anda</h6>
                    <div id="konten-kelas-tutor" class="row g-3 mt-3">
                    </div>

                </div>


                <div class="modal fade" id="modalBuatKelasTutor" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="<?php echo e(route('tutor.prosesSimpanKelas')); ?>" method="POST"
                            class="modal-content border-0 shadow-lg rounded-4">
                            <?php echo csrf_field(); ?>
                            <div class="modal-header bg-dark text-white">
                                <h5 class="modal-title fw-bold"><i class="bi bi-plus-circle me-2"></i>Buat Kelas Baru
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold text-secondary">Nama Kelas
                                        Pembelajaran</label>
                                    <input type="text" name="nama_kelas" class="form-control"
                                        placeholder="Contoh: Bahasa Indonesia Kelas X (Paket C)" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold text-secondary">Deskripsi Singkat
                                        Kelas</label>
                                    <textarea name="deskripsi_kelas" class="form-control" rows="3"
                                        placeholder="Tulis deskripsi kelas atau aturan belajar..."></textarea>
                                </div>
                            </div>
                            <div class="modal-footer bg-light">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-dark">Simpan Kelas</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="modal fade" id="modalUploadModulTutor" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="#" method="POST" enctype="multipart/form-data"
                            class="modal-content border-0 shadow">
                            <?php echo csrf_field(); ?>
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title fw-bold"><i class="bi bi-file-earmark-pdf me-2"></i>Upload
                                    Modul Pembelajaran</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold text-secondary">Judul Modul</label>
                                    <input type="text" name="judul_modul" class="form-control"
                                        placeholder="Contoh: Modul 2 - Teks Deskripsi" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold text-secondary">Pilih File Dokumen (Wajib
                                        PDF)</label>
                                    <input type="file" name="file_modul" class="form-control" accept=".pdf"
                                        required>
                                </div>
                            </div>
                            <div class="modal-footer bg-light">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Mulai Upload</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="modal fade" id="modalBuatTugasTutor" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="#" method="POST" enctype="multipart/form-data"
                            class="modal-content border-0 shadow">
                            <?php echo csrf_field(); ?>
                            <div class="modal-header bg-success text-white">
                                <h5 class="modal-title fw-bold"><i class="bi bi-pencil-square me-2"></i>Buat Tugas
                                    Mandiri</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold text-secondary">Judul / Nama Tugas</label>
                                    <input type="text" name="judul_tugas" class="form-control"
                                        placeholder="Contoh: Lembar Kerja Siswa 1" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold text-secondary">Batas Pengumpulan
                                        (Deadline)</label>
                                    <input type="datetime-local" name="deadline" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold text-secondary">Upload Berkas Soal (Format
                                        Bebas / Opsional)</label>
                                    <input type="file" name="file_tugas" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer bg-light">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-success">Bagikan Tugas</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- WORKSPACE INTERFACE SISWA -->
            <?php if(Auth::user()->role == 'siswa'): ?>

                <div class="tab-pane fade" id="panel-kelas-siswa" role="tabpanel">
                    <div class="card border-0 p-4 rounded-3 shadow-sm bg-white mt-4">

                        <h5 class="fw-bold mb-4">
                            Kelas Pembelajaran
                        </h5>
                        <p>Total kelas: <?php echo e(count($data_kelas)); ?></p>

                        <?php $__empty_1 = true; $__currentLoopData = $data_kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kelas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="card shadow-sm border-0 rounded-4 mb-4">
                                <div class="card-body">

                                    <h4 class="fw-bold">
                                        <?php echo e($kelas->nama_kelas); ?>

                                    </h4>

                                    <p class="text-muted mb-2">
                                        <i class="bi bi-person-badge-fill"></i>
                                        Tutor : <?php echo e($kelas->nama_tutor); ?>

                                    </p>

                                    <div class="mb-3">
                                        <span class="badge bg-info">
                                            <i class="bi bi-people-fill"></i>
                                            <?php echo e($kelas->jumlah_peserta); ?> Peserta
                                        </span>
                                    </div>

                                    <p class="text-secondary">
                                        <?php echo e($kelas->deskripsi); ?>

                                    </p>

                                    <?php
                                        $sudahGabung = DB::table('peserta_kelas')
                                            ->where('kelas_id', $kelas->id)
                                            ->where('user_id', Auth::id())
                                            ->exists();
                                    ?>

                                    <?php if($sudahGabung): ?>
                                        <a href="<?php echo e(url('/ruang-kelas/' . $kelas->id)); ?>" class="btn btn-success">
                                            Masuk Kelas
                                        </a>
                                    <?php else: ?>
                                        <button class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#modalGabung<?php echo e($kelas->id); ?>">
                                            Gabung Kelas
                                        </button>
                                    <?php endif; ?>

                                </div>
                            </div>

                            <!-- MODAL GABUNG KELAS -->
                            <div class="modal fade" id="modalGabung<?php echo e($kelas->id); ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <form action="<?php echo e(url('/ruang-kelas/' . $kelas->id . '/verifikasi')); ?>"
                                        method="POST">

                                        <?php echo csrf_field(); ?>

                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title">
                                                    Gabung Kelas
                                                </h5>
                                            </div>

                                            <div class="modal-body">

                                                <h5><?php echo e($kelas->nama_kelas); ?></h5>

                                                <p class="text-muted">
                                                    Tutor : <?php echo e($kelas->nama_tutor); ?>

                                                </p>

                                                <div class="mb-3">
                                                    <label>Password Kelas</label>

                                                    <input type="password" name="password_masuk" class="form-control"
                                                        placeholder="Masukkan Password Kelas" required>
                                                </div>

                                            </div>

                                            <div class="modal-footer">

                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">
                                                    Batal
                                                </button>

                                                <button type="submit" class="btn btn-primary">
                                                    Gabung
                                                </button>

                                            </div>

                                        </div>

                                    </form>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="alert alert-warning">
                                Belum ada kelas tersedia.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                
                <div class="tab-pane fade" id="panel-kelas-saya" role="tabpanel">
                    <div class="card border-0 p-4 rounded-3 shadow-sm bg-white mt-4">
                        <h3 class="fw-bold mb-4"> Kelas Saya </h3>
                        <p>Total kelas saya : <?php echo e(count($data_kelas_saya)); ?></p>
                        <?php $__empty_1 = true; $__currentLoopData = $data_kelas_saya; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kelas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="card shadow-sm border-0 rounded-4 mb-4">
                                <div class="card-body">
                                    <h4 class="fw-bold">
                                        <?php echo e($kelas->nama_kelas); ?>

                                    </h4>

                                    <p class="text-muted mb-2">
                                        <i class="bi bi-person-badge-fill"></i>
                                        Tutor : <?php echo e($kelas->nama_tutor); ?>

                                    </p>

                                    <span class="badge bg-info mb-3">
                                        <i class="bi bi-people-fill"></i>
                                        <?php echo e($kelas->jumlah_peserta); ?> Peserta
                                    </span>

                                    <p class="text-secondary">
                                        <?php echo e($kelas->deskripsi); ?>

                                    </p>

                                    <a href="<?php echo e(url('/ruang-kelas/' . $kelas->id)); ?>" class="btn btn-success">

                                        <i class="bi bi-box-arrow-in-right"></i>
                                        Masuk Kelas

                                    </a>

                                </div>

                            </div>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                            <div class="alert alert-warning">

                                Anda belum mengikuti kelas apapun.

                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    function muatKelasTutor() {
                        fetch('/api/ambil-kelas-tutor')
                            .then(response => response.json())
                            .then(data => {
                                const wadah = document.getElementById('konten-kelas-tutor');
                                wadah.innerHTML = ''; // Bersihkan kontainer

                                if (data.length === 0) {
                                    wadah.innerHTML = `
                                            <div class="col-12 text-center py-5">
                                                <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" alt="Kosong" style="width: 100px; opacity: 0.5;" class="mb-3">
                                                <h5 class="fw-bold text-dark mb-1">Belum Ada Kelas Aktif</h5>
                                                <p class="text-muted small">Mulai perjalanan mengajar Anda dengan menekan tombol "Buat Kelas Baru" di atas.</p>
                                            </div>`;
                                    return;
                                }

                                data.forEach(kelas => {
                                    wadah.innerHTML += `
                                            <div class="col-md-4">
                                                <div class="card border-0 shadow-sm rounded-4 h-100">
                                                    <div class="card-body p-4 d-flex flex-column justify-content-between">
                                                        <div>
                                                            <span class="badge bg-primary bg-opacity-10 text-primary mb-3 px-3 py-2 rounded-3">Kelas Aktif</span>
                                                            <h5 class="fw-bold text-dark mb-2">${kelas.nama_kelas}</h5>
                                                            <p class="text-muted small mb-4">${kelas.deskripsi ? kelas.deskripsi : ''}</p>
                                                        </div>
                                                        <a href="/ruang-kelas/${kelas.id}" class="btn btn-primary w-100 rounded-3 py-2 fw-semibold">
                                                            Buka Ruang Kelas <i class="bi bi-arrow-right ms-1"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>`;
                                });
                            });
                    }

                    // Jalankan fungsi saat halaman pertama kali dibuka
                    muatKelasTutor();
                });
            </script>
            <script>
                const password = document.getElementById('password');
                const error = document.getElementById('passwordError');

                password.addEventListener('input', function() {
                    if (this.value.length > 0 && this.value.length < 4) {
                        this.classList.add('is-invalid');
                        error.textContent = 'Password minimal 4 karakter.';
                    } else {
                        this.classList.remove('is-invalid');
                        error.textContent = '';
                    }
                });
            </script>
</body>

</html>
<?php /**PATH D:\Abdi\Laravel\pendaftaranpkbmjulusiri\resources\views/admin/elearning.blade.php ENDPATH**/ ?>
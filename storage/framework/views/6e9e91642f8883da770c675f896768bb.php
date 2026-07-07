<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ruang Kelas: <?php echo e($kelas->nama_kelas); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">

    <!-- Navbar Atas -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container py-2">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="/elearning">
                <i class="bi bi-arrow-left-circle me-2 fs-4"></i> Kembali ke Dashboard
            </a>
            <span class="navbar-text text-white fw-semibold">
                Portal E-Learning PKBM JULU SIRI
            </span>
        </div>
    </nav>

    <div class="container my-5">
        <!-- Header Kelas -->
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-4">
            <div class="d-flex justify-content-between align-items-start flex-wrap g-3">
                <div>
                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-3 mb-2">Ruang Kelas
                        Aktif</span>
                    <h2 class="fw-bold text-dark mb-1"><?php echo e($kelas->nama_kelas); ?></h2>
                    <p class="text-muted mb-0"><?php echo e($kelas->deskripsi ?: 'Tidak ada deskripsi kelas.'); ?></p>
                </div>

                <?php if(Auth::user() && Auth::user()->role == 'tutor'): ?>
                    <div class="d-flex gap-2 mt-2 flex-wrap">
                        <button class="btn btn-outline-dark rounded-3" data-bs-toggle="modal"
                            data-bs-target="#modalPasswordKelas">
                            <i class="bi bi-key-fill me-2"></i> Kunci Kelas:
                            <?php echo e($kelas->password_kelas ? 'Aktif' : 'Terbuka'); ?>

                        </button>
                        <button class="btn btn-primary rounded-3" data-bs-toggle="modal"
                            data-bs-target="#modalUploadMateri">
                            <i class="bi bi-cloud-arrow-up-fill me-2"></i> Upload Materi / Tugas
                        </button>

                        <form action="/ruang-kelas/<?php echo e($kelas->id); ?>/hapus" method="POST"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus kelas ini beserta semua materi di dalamnya? Tindakan ini tidak bisa dibatalkan.');"
                            class="d-inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger rounded-3">
                                <i class="bi bi-trash3-fill me-2"></i> Hapus Kelas
                            </button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        
        <?php
            $bolehMasuk = true;

            if (Auth::user()->role == 'siswa') {
                $bolehMasuk = DB::table('peserta_kelas')
                    ->where('kelas_id', $kelas->id)
                    ->where('user_id', Auth::id())
                    ->exists();
            }
        ?>

        <?php if(Auth::user()->role == 'siswa' && !$bolehMasuk): ?>
            <div class="row justify-content-center my-5">
                <div class="col-md-6">
                    <div class="card border-0 shadow rounded-4 p-4 text-center bg-white">
                        <i class="bi bi-shield-lock-fill text-danger display-3 mb-3"></i>
                        <h4 class="fw-bold">Kelas Ini Terkunci</h4>
                        <p class="text-muted small">Silakan masukkan password pendaftaran (Enrollment Key) yang
                            diberikan oleh tutor Anda untuk mengakses materi.</p>

                        <form action="/ruang-kelas/<?php echo e($kelas->id); ?>/verifikasi" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="mb-3">
                                <input type="password" name="password_masuk"
                                    class="form-content form-control form-control-lg rounded-3 text-center"
                                    placeholder="Masukkan Password Kelas" required>
                            </div>
                            <button type="submit" class="btn btn-danger w-100 py-2 rounded-3 fw-semibold">Buka Akses
                                Kelas</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <!-- ISI UTAMA KELAS (Materi & Tugas) -->
            <div class="row">
                <div class="col-lg-8">
                    <h5 class="fw-bold text-dark mb-3"><i class="bi bi-collection-play-fill me-2 text-primary"></i>
                        Daftar Modul Pembelajaran</h5>

                
                            <h5 class="fw-bold text-primary mb-3">
                                <i class="bi bi-book-half"></i>
                                Materi Pembelajaran
                            </h5>

                            <?php $__empty_1 = true; $__currentLoopData = $materi->where('tipe','materi'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                            <div class="card border-0 shadow-sm rounded-4 mb-3">
                                <div class="card-body">

                                    <span class="badge bg-primary mb-2">
                                        Materi
                                    </span>

                                    <h5 class="fw-bold">
                                        <?php echo e($item->judul); ?>

                                    </h5>

                                    <p class="text-muted">
                                        <?php echo e($item->deskripsi); ?>

                                    </p>

                                    <small class="text-secondary">
                                        <i class="bi bi-calendar-event"></i>
                                        Upload :
                                        <?php echo e(\Carbon\Carbon::parse($item->created_at)->format('d M Y H:i')); ?>

                                    </small>

                                    <hr>

                                    <?php if($item->file_path): ?>

                                    <a href="<?php echo e(asset($item->file_path)); ?>"
                                        class="btn btn-primary btn-sm"
                                        target="_blank">

                                        <i class="bi bi-download"></i>
                                        Download Materi
                                    </a>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="alert alert-info">
                                Belum ada materi.
                            </div>

                            <?php endif; ?>
                            <hr class="my-5">


                        
                                    <h5 class="fw-bold text-warning mb-3">
                                        <i class="bi bi-file-earmark-text-fill"></i>
                                        Daftar Tugas
                                    </h5>

                                    <?php $__empty_1 = true; $__currentLoopData = $materi->where('tipe','tugas'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                                    <div class="card border-0 shadow-sm rounded-4 mb-3">
                                        <div class="card-body">
                                            <span class="badge bg-warning text-dark mb-2">
                                                Tugas
                                            </span>

                                            <h5 class="fw-bold">
                                                <?php echo e($item->judul); ?>

                                            </h5>
                                            <p class="text-muted">
                                                <?php echo e($item->deskripsi); ?>

                                            </p>
                                            <small class="d-block text-secondary">
                                                <i class="bi bi-calendar-event"></i>
                                                Upload :
                                                <?php echo e(\Carbon\Carbon::parse($item->created_at)->format('d M Y H:i')); ?>

                                            </small>
                                            <small class="d-block text-danger mt-1">
                                                <i class="bi bi-alarm"></i>
                                                Deadline :
                                                <?php echo e($item->deadline ? \Carbon\Carbon::parse($item->deadline)->format('d M Y H:i') : '-'); ?>

                                            </small>
                                            <hr>
                                            <div class="d-flex gap-2 flex-wrap">

                                            
                                                <?php if(Auth::user()->role == 'tutor'): ?>

                                                    <?php if($item->file_soal): ?>
                                                        <a href="<?php echo e(asset($item->file_soal)); ?>"
                                                            class="btn btn-warning btn-sm"
                                                            target="_blank">

                                                            <i class="bi bi-download"></i>
                                                            Download Soal

                                                        </a>
                                                    <?php endif; ?>

                                                    <button
                                                        class="btn btn-dark btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalPengumpulan<?php echo e($item->id); ?>">

                                                        <i class="bi bi-people-fill"></i>
                                                        Lihat Pengumpulan

                                                    </button>

                                                <?php endif; ?>

                                                
                                                <?php if(Auth::user()->role == 'siswa'): ?>

                                                    <?php
                                                        $sudahUpload = DB::table('pengumpulan_tugas')
                                                            ->where('materi_id', $item->id)
                                                            ->where('user_id', Auth::id())
                                                            ->first();
                                                    ?>

                                                    <?php if($item->file_soal): ?>
                                                        <a href="<?php echo e(asset($item->file_soal)); ?>"
                                                            class="btn btn-warning btn-sm"
                                                            target="_blank">

                                                            <i class="bi bi-download"></i>
                                                            Download Soal

                                                        </a>
                                                    <?php endif; ?>

                                                    <?php if($sudahUpload): ?>

                                                        <span class="badge bg-success align-self-center">
                                                            <i class="bi bi-check-circle-fill"></i>
                                                            Sudah Dikumpulkan
                                                        </span>

                                                        <small class="text-success align-self-center">
                                                            <?php echo e(\Carbon\Carbon::parse($sudahUpload->created_at)->format('d M Y H:i')); ?>

                                                        </small>

                                                    <?php else: ?>

                                                        <span class="badge bg-warning text-dark align-self-center">
                                                            <i class="bi bi-clock-fill"></i>
                                                            Belum Dikumpulkan
                                                        </span>

                                                        <button
                                                            class="btn btn-success btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#uploadJawaban<?php echo e($item->id); ?>">

                                                            <i class="bi bi-upload"></i>
                                                            Upload Jawaban

                                                        </button>

                                                    <?php endif; ?>

                                                <?php endif; ?>

                                            </div>
                                        </div>
                                    </div>

                        
                                    <div class="modal fade" id="modalPengumpulan<?php echo e($item->id); ?>" tabindex="-1">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">
                                                        Pengumpulan Tugas
                                                    </h5>
                                                    <button
                                                        class="btn-close"
                                                        data-bs-dismiss="modal">
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                    $pengumpulan = DB::table('pengumpulan_tugas')
                                                        ->join('users','pengumpulan_tugas.user_id','=','users.id')
                                                        ->where('materi_id',$item->id)
                                                        ->select(
                                                            'pengumpulan_tugas.*',
                                                            'users.name'
                                                        )
                                                        ->get();
                                                    ?>
                                                    <?php $__empty_2 = true; $__currentLoopData = $pengumpulan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jawaban): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h6 class="fw-bold">
                                                <i class="bi bi-person-circle"></i>
                                                <?php echo e($jawaban->name); ?>

                                            </h6>
                                            <small class="text-muted">
                                                <?php echo e(\Carbon\Carbon::parse($jawaban->created_at)->format('d M Y H:i')); ?>

                                            </small>
                                            <br><br>
                                            <a
                                                href="<?php echo e(asset($jawaban->file_jawaban)); ?>"
                                                target="_blank"
                                                class="btn btn-success btn-sm">
                                                <i class="bi bi-download"></i>
                                                Download Jawaban
                                            </a>
                                        </div>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                                    <div class="alert alert-warning">
                                    Belum ada siswa yang mengumpulkan tugas.
                                    </div>
                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="uploadJawaban<?php echo e($item->id); ?>" tabindex="-1">
                                    <div class="modal-dialog">
                                        <form
                                            action="<?php echo e(url('/tugas/'.$item->id.'/upload-jawaban')); ?>"
                                            method="POST"
                                            enctype="multipart/form-data">
                                            <?php echo csrf_field(); ?>
                                            <input
                                                type="hidden"
                                                name="kelas_id"
                                                value="<?php echo e($kelas->id); ?>">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5>Upload Jawaban</h5>
                                                    <button
                                                        type="button"
                                                        class="btn-close"
                                                        data-bs-dismiss="modal">
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label>File Jawaban</label>
                                                        <input
                                                            type="file"
                                                            name="file_jawaban"
                                                            class="form-control"
                                                            required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Keterangan</label>
                                                        <textarea
                                                            name="keterangan"
                                                            class="form-control"
                                                            rows="3"></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button
                                                        class="btn btn-success">
                                                        Kirim Jawaban
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <div class="alert alert-warning">
                                        Belum ada tugas.
                                    </div>
                                    <?php endif; ?>
                                                    </div>

                <!-- Info Samping -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-4">
                        <h6 class="fw-bold text-dark mb-3"><i class="bi bi-info-circle-fill me-2 text-info"></i>
                            Informasi Ruangan</h6>
                        <hr class="text-muted opacity-25">
                        <div class="d-flex justify-content-between small mb-2">
                            <span class="text-muted">Status Proteksi:</span>
                            <span
                                class="fw-semibold text-<?php echo e($kelas->password_kelas ? 'danger' : 'success'); ?>"><?php echo e($kelas->password_kelas ? 'Terkunci Password' : 'Sifat Umum'); ?></span>
                        </div>
                        <div class="d-flex justify-content-between small mb-2">
                            <span class="text-muted">Total Modul:</span>
                            <span class="fw-semibold text-dark"><?php echo e(count($materi)); ?> File</span>
                        </div>
                    </div>
                </div>
            </div>

        <?php endif; ?>
    </div>

    <!-- MODAL 1: PENGATURAN PASSWORD KELAS (KHUSUS TUTOR) -->
    <div class="modal fade" id="modalPasswordKelas" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form action="/ruang-kelas/<?php echo e($kelas->id); ?>/update-password" method="POST"
                class="modal-content border-0 shadow rounded-4">
                <?php echo csrf_field(); ?>
                <div class="modal-header border-0 p-4 pb-0">
                    <h5 class="modal-title fw-bold">Set Password Kunci Kelas</h5>
                    <button type="button" class="btn-close" data-bs-shadow="none" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-muted">Password / Enrollment Key</label>
                        <input type="text" name="password_kelas" class="form-control rounded-3"
                            value="<?php echo e($kelas->password_kelas); ?>"
                            placeholder="Kosongkan jika kelas ingin diakses bebas tanpa password">
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="submit" class="btn btn-dark w-100 rounded-3">Simpan Kunci</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL 2: UPLOAD MATERI / TUGAS (KHUSUS TUTOR) -->
    <div class="modal fade" id="modalUploadMateri" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form action="/ruang-kelas/<?php echo e($kelas->id); ?>/upload" method="POST" enctype="multipart/form-data"
                class="modal-content border-0 shadow rounded-4">
                <?php echo csrf_field(); ?>
                <div class="modal-header border-0 p-4 pb-0">
                    <h5 class="modal-title fw-bold">Bagikan Materi atau Tugas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-muted">Tipe Dokumen</label>
                        <select name="tipe" class="form-select rounded-3">
                            <option value="materi">Bahan/Modul Materi</option>
                            <option value="tugas">Lembar Tugas Mandiri</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-muted">Judul Modul</label>
                        <input type="text" name="judul" class="form-control rounded-3"
                            placeholder="Contoh: Bab 1 Matematika Aljabar" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-muted">Petunjuk Singkat (Deskripsi)</label>
                        <textarea name="deskripsi" class="form-control rounded-3" rows="3"
                            placeholder="Tulis instruksi tambahan jika ada..."></textarea>
                    </div>
                    <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">
                        Deadline (Khusus Tugas)
                    </label>

                    <input
                        type="datetime-local"
                        name="deadline"
                        class="form-control rounded-3">
                </div>
                    <div class="mb-3">

                <label class="form-label small fw-semibold text-muted">
                    Upload File Materi / Soal
                </label>

                <input
                    type="file"
                    name="file_materi"
                    class="form-control rounded-3">

                <small class="text-muted">
                    Untuk materi: upload modul pembelajaran.
                    <br>
                    Untuk tugas: upload lembar soal tugas.
                </small>

            </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="submit" class="btn btn-primary w-100 rounded-3">Publikasikan Sekarang</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn-images.npmcdn.com/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php /**PATH D:\Abdi\Laravel\pendaftaranpkbmjulusiri\resources\views/admin/detail_kelas.blade.php ENDPATH**/ ?>
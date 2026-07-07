<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran - PKBM JULU SIRI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background: linear-gradient(135deg, #001f3f 0%, #003366 100%); min-height: 100vh; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .card-registration { border-radius: 15px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25); }
        .form-control:focus, .form-select:focus { border-color: #003366; box-shadow: 0 0 0 0.25rem rgba(0, 51, 102, 0.25); }
    </style>
</head>
<body class="d-flex align-items-center py-5">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            
            <div class="mb-3 text-start">
                <a href="{{ route('profil') }}" class="btn btn-link text-white text-decoration-none p-0 small">
                    <i class="bi bi-arrow-left-circle-fill me-1"></i> Kembali ke Beranda
                </a>
            </div>

            <div class="card card-registration bg-white p-4 p-md-5">
                <div class="text-center mb-4">
                    <h3 class="fw-bold text-dark mb-1">Formulir Pendaftaran</h3>
                    <p class="text-muted small">Sistem Informasi Penerimaan Warga Belajar Baru <br><strong class="text-primary">PKBM Julu' Siri'</strong></p>
                    <hr class="mx-auto bg-secondary" style="width: 60px; height: 3px;">
                </div>

                @if(session('sukses_pendaftaran'))
                    <div class="alert alert-success border-0 shadow-sm d-flex align-items-center" role="alert">
                        <i class="bi bi-check-circle-fill fs-4 me-3 text-success"></i>
                        <div>
                            <strong class="d-block mb-1">Pendaftaran Sukses!</strong>
                            <span class="small">{{ session('sukses_pendaftaran') }}</span>
                        </div>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger border-0 shadow-sm small" role="alert">
                        <div class="fw-bold mb-1"><i class="bi bi-exclamation-triangle-fill me-2"></i> Mohon periksa kembali isian Anda:</div>
                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data" class="{{ session('sukses_pendaftaran') ? 'd-none' : '' }}">
                    @csrf

                    <!-- 1. Input Nama Lengkap -->
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">Nama Lengkap Sesuai Dokumen</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-person-fill text-muted"></i></span>
                            <input type="text" class="form-control" name="nama" value="{{ old('nama') }}" placeholder="Contoh: Abdillah" required>
                        </div>
                    </div>

                    <!-- 2. Pilihan Program Paket -->
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">Pilih Program Paket Kesetaraan</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-mortarboard-fill text-muted"></i></span>
                            <select class="form-select" name="paket" required>
                                <option value="" disabled selected>-- Pilih Program Paket --</option>
                                <option value="Paket A (Setara SD)" {{ old('paket') == 'Paket A (Setara SD)' ? 'selected' : '' }}>Paket A (Setara SD)</option>
                                <option value="Paket B (Setara SMP)" {{ old('paket') == 'Paket B (Setara SMP)' ? 'selected' : '' }}>Paket B (Setara SMP)</option>
                                <option value="Paket C (Setara SMA)" {{ old('paket') == 'Paket C (Setara SMA)' ? 'selected' : '' }}>Paket C (Setara SMA)</option>
                            </select>
                        </div>
                    </div>

                    <!-- 3. Input Nomor WhatsApp -->
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">Nomor WhatsApp Aktif</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-whatsapp text-success"></i></span>
                            <input type="text" class="form-control" name="nohp" value="{{ old('nohp') }}" placeholder="Contoh: 081234567xxx" required>
                        </div>
                    </div>

                    <!-- 4. Upload File KTP -->
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">Upload Scan/Foto KTP (Format: JPG/PNG, Maks 2MB)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-card-heading text-primary"></i></span>
                            <input type="file" class="form-control" name="file_ktp" accept="image/*" required>
                        </div>
                    </div>

                    <!-- 5. Upload File Kartu Keluarga (KK) -->
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">Upload Scan/Foto Kartu Keluarga (Format: JPG/PNG, Maks 2MB)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-file-earmark-person-fill text-info"></i></span>
                            <input type="file" class="form-control" name="file_kk" accept="image/*" required>
                        </div>
                    </div>

                    <!-- 6. Upload File Ijazah Terakhir (KEMBALI DITAMBAHKAN) -->
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">Upload Scan/Foto Ijazah Terakhir (Format: JPG/PNG, Maks 2MB)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-journal-bookmark-fill text-warning"></i></span>
                            <input type="file" class="form-control" name="file_ijazah" accept="image/*" required>
                        </div>
                    </div>

                    <!-- 7. Upload File Akta Kelahiran (BARU) -->
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">Upload Scan/Foto Akta Kelahiran (Format: JPG/PNG, Maks 2MB)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-file-earmark-medical-fill text-danger"></i></span>
                            <input type="file" class="form-control" name="file_akta" accept="image/*" required>
                        </div>
                    </div>

                    <div class="d-grid gap-2 pt-3">
                        <button type="submit" class="btn btn-primary fw-bold rounded-pill py-2 text-uppercase shadow-sm" style="background-color: #003366; border: none;">
                            <i class="bi bi-send-fill me-2"></i> Kirim Data Pendaftaran
                        </button>
                    </div>

                </form>

                @if(session('sukses_pendaftaran'))
                    <div class="d-grid gap-2 pt-3 text-center">
                        <a href="{{ route('pendaftaran.form') }}" class="btn btn-outline-secondary rounded-pill btn-sm py-2">
                            <i class="bi bi-arrow-clockwise me-1"></i> Isi Formulir Baru Lagi
                        </a>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@section('content')
<style>
    .form-box {
        border-radius: 16px;
        background: #ffffff;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        border: none;
    }
    .form-section-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #2c3e50;
        border-left: 4px solid #0d6efd;
        padding-left: 10px;
        margin-bottom: 20px;
    }
    .form-label-custom {
        font-size: 0.85rem;
        font-weight: 600;
        color: #5c6b73;
        margin-bottom: 6px;
    }
    .form-control-custom {
        border-radius: 10px;
        border: 1px solid #ced4da;
        padding: 10px 15px;
        font-size: 0.95rem;
        transition: all 0.2s ease;
    }
    .form-control-custom:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.15);
    }
    .card-berkas {
        border-radius: 12px;
        background: #f8f9fa;
        border: 1px solid #e9ecef;
    }
</style>

<div class="container-fluid px-4 py-4">
    <!-- Header Halaman -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4 pb-3 border-bottom">
        <div>
            <span class="badge bg-light text-primary fw-bold mb-2 px-3 py-2 rounded-pill shadow-sm">ADMIN PANEL</span>
            <h2 class="fw-bold text-dark mb-1">Detail Form Pendaftaran</h2>
            <p class="text-muted mb-0 small"><i class="bi bi-person-fill text-secondary me-1"></i> Memeriksa & Mengelola data calon siswa atas nama: <strong>{{ $pendaftar->nama }}</strong></p>
        </div>
        <div>
            <!-- Tombol Kembali Tetap Mengarah ke URL Utama Admin -->
            <a href="{{ url('/elearning') }}" class="btn btn-light border rounded-pill px-4 shadow-sm fw-bold text-secondary">
                <i class="bi bi-arrow-left-short fs-5 align-middle me-1"></i> Kembali ke Tabel
            </a>
        </div>
    </div>

    <!-- Layout Grid Utama -->
    <div class="row g-4">
        
        <!-- BAGIAN KIRI: Form Hasil Biodata Pendaftar -->
        <div class="col-lg-8">
            <div class="card form-box p-4 p-md-5">
                
                <!-- JALUR FORM UTAMA (TIDAK BERUBAH) -->
                <form action="{{ route('admin.pendaftaran.update', $pendaftar->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- SEKSI 1: DATA PROFIL UTAMA -->
                    <h5 class="fw-bold mb-3 text-primary border-bottom pb-2">
    <i class="bi bi-person-vcard me-2"></i>Informasi Profil & Pilihan Program
            </h5>

            <div class="row g-3 mb-4">
                <!-- 1. Nama Lengkap (Sekarang pakai Input Group + Ikon) -->
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-secondary">Nama Lengkap</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light text-muted" style="border-radius: 8px 0 0 8px;"><i class="bi bi-person-fill"></i></span>
                        <input type="text" name="nama" class="form-control fw-bold text-dark" value="{{ $pendaftar->nama }}" required style="border-radius: 0 8px 8px 0; padding: 10px;">
                    </div>
                </div>

                <!-- 2. Pilihan Program Paket (Sekarang pakai Input Group + Ikon) -->
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-secondary">Pilihan Program Paket</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light text-muted" style="border-radius: 8px 0 0 8px;"><i class="bi bi-journal-bookmark-fill"></i></span>
                        <select name="paket" class="form-select fw-bold" required style="border-radius: 0 8px 8px 0; padding: 10px;">
                            <option value="Paket A" {{ $pendaftar->paket == 'Paket A' ? 'selected' : '' }}>Paket A (Setara SD)</option>
                            <option value="Paket B" {{ $pendaftar->paket == 'Paket B' ? 'selected' : '' }}>Paket B (Setara SMP)</option>
                            <option value="Paket C" {{ $pendaftar->paket == 'Paket C' ? 'selected' : '' }}>Paket C (Setara SMA)</option>
                        </select>
                    </div>
                </div>

                <!-- 3. No. WhatsApp / HP (Sudah konsisten pakai Input Group) -->
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-secondary">No. WhatsApp / HP</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light text-muted" style="border-radius: 8px 0 0 8px;"><i class="bi bi-whatsapp"></i></span>
                        <input type="text" name="nohp" class="form-control fw-bold" value="{{ $pendaftar->nohp }}" required style="border-radius: 0 8px 8px 0; padding: 10px;">
                    </div>
                </div>

                <!-- 4. Status Berkas (Menggantikan Status Akun, pakai Input Group + Ikon) -->
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-secondary">Status Berkas</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light text-muted" style="border-radius: 8px 0 0 8px;"><i class="bi bi-info-circle-fill"></i></span>
                        <input type="text" class="form-control bg-light fw-bold text-uppercase @if($pendaftar->status == 'Diterima') text-success @elseif($pendaftar->status == 'Ditolak') text-danger @else text-warning @endif" value="{{ $pendaftar->status }}" readonly style="border-radius: 0 8px 8px 0; padding: 10px;">
                    </div>
                </div>
            </div>

                    <hr class="text-muted opacity-25 my-4">

                    <!-- SEKSI 2: BUTTON AKSI UTAMA (Logika & Fungsi Tetap Terjaga 100%) -->
                    <div class="d-flex flex-column flex-sm-row gap-2 justify-content-end align-items-stretch">
                        <!-- Button Reset -->
                        <button type="reset" class="btn btn-light border text-dark px-4 py-2 rounded-pill fw-bold shadow-sm transition">
                            <i class="bi bi-arrow-counterclockwise me-1"></i> Reset Data Asli
                        </button>
                        
                        <!-- Button Simpan Perubahan -->
                        <button type="submit" class="btn btn-success px-5 py-2 rounded-pill fw-bold shadow">
                            <i class="bi bi-cloud-check-fill me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>

            </div>
        </div>

        <!-- BAGIAN KANAN: Berkas Lampiran Dokumen -->
        <div class="col-lg-4">
            <div class="card form-box p-4">
                <div class="form-section-title mb-3"><i class="bi bi-folder-fill text-warning me-2"></i>Berkas Upload (Validasi)</div>
                <p class="text-muted small mb-4">Klik tombol buka di bawah untuk mengecek berkas asli dokumen digital calon siswa di tab baru.</p>

                <div class="d-flex flex-column gap-3">
                    @foreach([
                        'file_ktp' => ['label' => 'KTP Pendaftar / Orang Tua', 'icon' => 'bi-card-image', 'color' => 'btn-primary'],
                        'file_kk' => ['label' => 'Kartu Keluarga (KK)', 'icon' => 'bi-file-earmark-person', 'color' => 'btn-info text-white'],
                        'file_ijazah' => ['label' => 'Ijazah Terakhir', 'icon' => 'bi-file-earmark-medical', 'color' => 'btn-success'],
                        'file_akta' => ['label' => 'Akta Kelahiran', 'icon' => 'bi-file-earmark-text', 'color' => 'btn-violet text-white']
                    ] as $field => $info)
                        <div class="card-berkas p-3 d-flex justify-content-between align-items-center shadow-sm">
                            <div class="d-flex align-items-center gap-2">
                                <div class="fs-3 text-secondary"><i class="{{ $info['icon'] }}"></i></div>
                                <div>
                                    <span class="fw-bold d-block text-dark small" style="line-height: 1.2;">{{ $info['label'] }}</span>
                                    <small class="text-muted" style="font-size: 0.75rem;">{{ $pendaftar->$field ? 'File Terunggah' : 'Belum Ada File' }}</small>
                                </div>
                            </div>
                            
                            @if($pendaftar->$field)
                                <a href="{{ asset('storage/' . $pendaftar->$field) }}" target="_blank" class="btn btn-sm {{ $info['color'] }} rounded-pill px-3 shadow-sm fw-bold text-xs">
                                    <i class="bi bi-box-arrow-up-right me-1"></i> Buka
                                </a>
                            @else
                                <span class="badge bg-light text-muted border rounded-pill px-3 py-2 text-xs">Kosong</span>
                            @endif
                        </div>
                    @endforeach
                </div>
                
                <div class="mt-4 p-3 border border-warning border-dashed text-center rounded-3" style="background-color: #fffbeb;">
                </div>

            </div>
        </div>

    </div>
</div>
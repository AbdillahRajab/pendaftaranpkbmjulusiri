<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Berkas - PKBM JULU SIRI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body class="bg-light py-5">

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark"><i class="bi bi-patch-check text-primary me-2"></i>Verifikasi Berkas Pendaftaran</h3>
            <p class="text-muted mb-0">Kelola dokumen masuk calon warga belajar baru</p>
        </div>
        <a href="{{ route('elearning.index') }}" class="btn btn-secondary rounded-pill px-4 btn-sm fw-bold">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
        </a>
    </div>

    @if(session('status_update'))
        <div class="alert alert-success alert-dismissible fade show small py-2" role="alert">
            <i class="bi bi-check-circle-fill me-1"></i> {{ session('status_update') }}
            <button type="button" class="btn-close py-2" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="px-4 py-3">Nama Calon Siswa</th>
                            <th>Program Paket</th>
                            <th>No. WhatsApp</th>
                            <th>4 Berkas Dokumen</th>
                            <th>Status Verifikasi</th>
                            <th class="text-center">Aksi Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pendaftar as $row)
                        <tr>
                            <td class="px-4 fw-semibold text-dark">{{ $row->nama }}</td>
                            <td><span class="badge bg-primary rounded-pill">{{ $row->paket }}</span></td>
                            <td>
                                <a href="https://wa.me/{{ $row->nohp }}" target="_blank" class="text-decoration-none text-success fw-medium">
                                    <i class="bi bi-whatsapp me-1"></i> {{ $row->nohp }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ asset('storage/' . $row->file_ktp) }}" target="_blank" class="btn btn-outline-primary py-0 px-2 small me-1 mb-1 btn-sm"><i class="bi bi-file-image"></i> KTP</a>
                                <a href="{{ asset('storage/' . $row->file_kk) }}" target="_blank" class="btn btn-outline-success py-0 px-2 small me-1 mb-1 btn-sm"><i class="bi bi-file-image"></i> KK</a>
                                <a href="{{ asset('storage/' . $row->file_ijazah) }}" target="_blank" class="btn btn-outline-warning text-dark py-0 px-2 small me-1 mb-1 btn-sm"><i class="bi bi-file-image"></i> Ijazah</a>
                                <a href="{{ asset('storage/' . $row->file_akta) }}" target="_blank" class="btn btn-outline-danger py-0 px-2 small mb-1 btn-sm"><i class="bi bi-file-image"></i> Akta</a>
                            </td>
                            <td>
                                @if($row->status == 'Pending')
                                    <span class="badge bg-warning text-dark"><i class="bi bi-hourglass-split me-1"></i> Pending</span>
                                @elseif($row->status == 'Diterima')
                                    <span class="badge bg-success"><i class="bi bi-check-circle-fill me-1"></i> Diterima</span>
                                @else
                                    <span class="badge bg-danger"><i class="bi bi-x-circle-fill me-1"></i> Ditolak</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($row->status == 'Pending')
                                    <a href="{{ route('admin.verifikasi.status', ['id' => $row->id, 'status' => 'Diterima']) }}" class="btn btn-success btn-sm rounded-pill py-1 px-3 me-1 fw-bold">
                                        Terima
                                    </a>
                                    <a href="{{ route('admin.verifikasi.status', ['id' => $row->id, 'status' => 'Ditolak']) }}" class="btn btn-danger btn-sm rounded-pill py-1 px-3 fw-bold">
                                        Tolak
                                    </a>
                                @else
                                    <span class="text-muted small">Selesai diproses</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-5">
                                <i class="bi bi-folder-x fs-1 d-block mb-2"></i> Belum ada data pendaftaran yang masuk.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Satu Pintu - PKBM Julu' Siri'</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { 
            background: linear-gradient(135deg, #002244 0%, #001122 100%); 
            min-height: 100vh; 
            display: flex; 
            align-items: center; 
        }
        .card-login { 
            border: 1px solid rgba(0, 0, 0, 0.08); 
            border-radius: 12px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.4); 
        }
        .btn-custom { background-color: #003366; color: white; }
        .btn-custom:hover { background-color: #002244; color: white; }
    </style>
</head>
<body>

<div class="container d-flex align-items-center justify-content-center">
    <div class="row w-100 justify-content-center m-0">
        <div class="col-12 col-md-5">
            <div class="card card-login p-4 bg-white">
                
                <div class="text-center mb-4">
                    <i class="bi bi-shield-lock-fill text-warning" style="font-size: 3rem;"></i>
                    <h4 class="fw-bold mt-2 text-dark">LOGIN SATU PINTU</h4>
                    <small class="text-muted">Sistem Informasi Akademik PKBM Julu' Siri'</small>
                </div>

                @if(session('sukses_registrasi'))
                    <div class="alert alert-success alert-dismissible fade show py-2 small" role="alert">
                        <i class="bi bi-check-circle-fill me-1"></i> {{ session('sukses_registrasi') }}
                        <button type="button" class="btn-close py-1" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger py-2 small">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                @csrf 
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Alamat Email</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-envelope"></i></span>
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="nama@julusiri.com" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-bold">Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-lock"></i></span>
                            <input type="password" class="form-control" name="password" placeholder="******" required>
                        </div>
                    </div>

                    <div class="d-grid mb-2">
                        <button type="submit" class="btn btn-custom fw-bold py-2 rounded-pill shadow-sm">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Masuk ke Sistem
                        </button>
                    </div>

                    <div class="text-center mt-3 border-top pt-3">
                        <p class="small text-muted mb-1">Aktor baru (Admin / Tutor)?</p>
                        <a href="{{ route('register') }}" class="text-decoration-none small fw-bold text-primary">
                            <i class="bi bi-person-plus-fill me-1"></i> Registrasi Akun Di Sini
                        </a>
                    </div>
                </form>

                <div class="text-center mt-3 pt-2 border-top border-light-subtle">
                    <a href="{{ url('/) }}" class="text-decoration-none small text-warning fw-semibold">
                        <i class="bi bi-house-door-fill me-1"></i> Kembali ke Beranda Utama
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
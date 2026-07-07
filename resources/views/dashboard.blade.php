<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Internal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5">
    <div class="container text-center">
        <h1 class="fw-bold">Selamat Datang di Halaman Dashboard Internal</h1>
        <p class="lead">Anda berhasil login sebagai: <strong>{{ Auth::user()->role ?? 'Staf' }}</strong> ({{ Auth::user()->email ?? '' }})</p>
        
        <form action="{{ route('logout') }}" method="POST" class="mt-4">
            @csrf
            <button type="submit" class="btn btn-danger">Keluar (Logout)</button>
        </form>
    </div>
</body>
</html>
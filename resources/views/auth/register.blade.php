<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Akun - PKBM Julu' Siri'</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">

    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
        
        <div class="text-center mb-5">
            <h2 class="text-xl font-bold text-gray-800">PKBM JULU' SIRI'</h2>
            <p class="text-sm text-gray-500">Silakan isi formulir untuk mendaftar akun baru</p>
        </div>

        <!-- Tampilkan Pesan Eror Jika Kuota Admin Penuh -->
        @if($errors->has('admin_full'))
            <div class="bg-red-100 text-red-700 p-2 rounded text-xs mb-4 text-center fw-bold">
                {{ $errors->first('admin_full') }}
            </div>
        @endif

        <form action="{{ url('/register') }}" method="POST">
            @csrf

            <!-- Input Nama Lengkap -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                    placeholder="Masukkan nama lengkap Anda">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Input Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Alamat Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                    placeholder="contoh@gmail.com">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- PILIHAN ROLE SUDAH LENGKAP: SISWA, TUTOR, ADMIN -->
            <div class="mb-4">
                <label for="role" class="block text-sm font-semibold text-gray-700 mb-1">Mendaftar Sebagai (Jabatan)</label>
                <select name="role" id="role" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm bg-white">
                    <option value="siswa" {{ old('role') == 'siswa' ? 'selected' : '' }}>Warga Belajar / Siswa</option>
                    <option value="tutor" {{ old('role') == 'tutor' ? 'selected' : '' }}>Tenaga Pengajar / Tutor</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrator System</option>
                </select>
            </div>

            <!-- Input Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                    placeholder="Minimal 8 karakter">
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Input Konfirmasi Password -->
            <div class="mb-5">
                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                    placeholder="Ulangi password Anda">
            </div>

            <button type="submit" 
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-200 text-sm cursor-pointer shadow">
                Daftar Sekarang
            </button>
        </form>

        <div class="text-center mt-4">
            <p class="text-xs text-gray-600">
                Sudah punya akun? 
                <a href="{{ url('/login') }}" class="text-blue-600 hover:underline font-medium">Log in di sini</a>
            </p>
        </div>

    </div>

</body>
</html>
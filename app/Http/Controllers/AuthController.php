<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
{
    return redirect('/');
}
    public function processLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/elearning');
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
    //     dd($request->all());
    // $request->validate([
    //     // ...
    // ]);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4|confirmed',
            'role' => 'required|in:siswa,tutor,admin', 
        ]);

        if ($request->role === 'admin') {
            $checkAdmin = User::where('role', 'admin')->count();
            if ($checkAdmin >= 5) {
                return redirect()->back()->withInput()->withErrors([
                    'admin_full' => 'Registrasi Gagal! Slot Akun Administrator sudah penuh (Maksimal 5 Orang).'
                ]);
            }
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role, 
        ]);

        return redirect()->back()->with('success', 'User berhasil ditambahkan.');
    }

    public function logout(Request $request)
{
    // 1. Keluarkan sesi login user/admin
    Auth::logout();

    // 2. Hancurkan data session lama agar aman
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // 3. KUNCI UTAMA: Wajib diarahkan ke '/' (Halaman Web Publik Utama)
    return redirect('/');
}
}
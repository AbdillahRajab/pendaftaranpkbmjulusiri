<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;

class PendaftaranController extends Controller
{
    // Menyimpan kiriman data formulir dari welcome blade
   public function store(Request $request)
    {
        // 1. Validasi mengikuti name input di welcome blade Anda
        $request->validate([
            'name'           => 'required|string|max:255',
            'program_paket'  => 'required|string',
            'no_hp'          => 'required|string',
            'sekolah_asal'   => 'nullable|string',
            'tahun_keluar'   => 'nullable|string',
            'file_ktp'       => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'file_kk'        => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'file_ijazah'    => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'file_akta'      => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 2. Upload file gambar ke folder public storage
        $ktpPath    = $request->file('file_ktp')->store('berkas', 'public');
        $kkPath     = $request->file('file_kk')->store('berkas', 'public');
        $ijazahPath = $request->file('file_ijazah')->store('berkas', 'public');
        $aktaPath   = $request->file('file_akta')->store('berkas', 'public');

        // 3. Simpan ke Database lewat Model Pendaftaran (yang dibaca Admin)
        Pendaftaran::create([
            'nama'        => $request->name,          // Input name="name"
            'paket'       => $request->program_paket, // Input name="program_paket"
            'nohp'        => $request->no_hp,         // Input name="no_hp"
            'file_ktp'    => $ktpPath,
            'file_kk'     => $kkPath,
            'file_ijazah' => $ijazahPath,
            'file_akta'   => $aktaPath,
            'status'      => 'Pending', // Langsung masuk antrean Admin
        ]);

        return redirect('/')->with('sukses_pendaftaran', 'Silakan tunggu verifikasi/konfirmasi dari Admin PKBM JULU\ SIRI\. Data Anda sedang dalam antrean.');
    }
    // 1. Fungsi Mengubah Status Verifikasi (Setuju / Tolak)
public function ubahStatus($id, $status)
{
    $data = Pendaftaran::findOrFail($id);
    $data->update(['status' => $status]);

    // return back() memaksa Laravel mengembalikan Admin ke halaman terakhir tempat dia mengklik tombol
    return back()->with('status_update', 'Status pendaftaran ' . $data->nama . ' berhasil diubah!');
}

// 2. Menampilkan Halaman Detail/Lihat Lengkap beserta Form Edit
public function edit($id)
{
    $pendaftar = Pendaftaran::findOrFail($id);
    // Mengarahkan ke file view show_pendaftar.blade.php
    return view('admin.show_pendaftar', compact('pendaftar'));
}

// FUNGSI UTAMA: Menampilkan Hasil Formulir Lengkap Pendaftar saat tombol LIHAT diklik
public function show($id)
{
    // Mencari data pendaftar berdasarkan ID, jika tidak ada otomatis error 404
    $pendaftar = Pendaftaran::findOrFail($id);
    
    // Melempar data ke file view show_pendaftar.blade.php
    return view('admin.show_pendaftar', compact('pendaftar'));
}
// FUNGSI UPDATE: Memproses perubahan jika admin mengedit data di dalam halaman LIHAT
public function update(Request $request, $id)
{
    $pendaftar = Pendaftaran::findOrFail($id);

    $request->validate([
        'nama'  => 'required|string|max:255',
        'paket' => 'required|string',
        'nohp'  => 'required|string',
    ]);

    $pendaftar->update([
        'nama'  => $request->nama,
        'paket' => $request->paket,
        'nohp'  => $request->nohp,
    ]);

    // Mengunci pengalihan langsung ke halaman tabel admin utama
    return redirect('/elearning')->with('status_update', 'Perubahan data formulir ' . $pendaftar->nama . ' telah berhasil disimpan!');
}
public function destroy($id)
{
    // Menggunakan Model Pendaftaran dan findOrFail seperti pada fungsi edit() Anda
    $pendaftar = Pendaftaran::findOrFail($id);

    // Simpan nama warga belajar untuk keperluan notifikasi pesan sukses
    $namaPendaftar = $pendaftar->nama;

    // Eksekusi penghapusan data secara Eloquent
    $pendaftar->delete();

    // Kembali ke halaman sebelumnya dengan membawa session flash message sukses
    return redirect()->back()->with('success', 'Warga belajar atas nama ' . $namaPendaftar . ' berhasil dihapus dari sistem!');
}

// Fungsi Memproses Perubahan Data User (Update)
public function userUpdate(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'role' => 'required',
        'password' => 'nullable|string|min:4',
        
    ]);

    $user = \App\Models\User::findOrFail($id);

    $dataUpdate = [
        'name' => $request->name,
        'email' => $request->email,
        'role' => $request->role,
    ];

    if ($request->filled('password')) {
        $dataUpdate['password'] = bcrypt($request->password);
    }

    $user->update($dataUpdate);

    return redirect()->back()->with('success', 'Data user atas nama ' . $request->name . ' berhasil diperbarui!');
}

// Fungsi Menghapus Akun User (Destroy)
public function userDestroy($id)
{
    $user = \App\Models\User::findOrFail($id);
    $namaUser = $user->name;

    // Eksekusi hapus akun
    $user->delete();

    return redirect()->back()->with('success', 'User ' . $namaUser . ' berhasil dihapus dari sistem!');
}
}
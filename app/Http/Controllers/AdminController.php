<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        // 1. AUTO-UPGRADE AKUN UTAMA ABDILLAH
        if (auth()->check() && auth()->user()->email === 'abdipkp26@gmail.com' && auth()->user()->role !== 'admin') {
            $userUtama = User::find(auth()->id());
            if ($userUtama) {
                $userUtama->role = 'admin';
                $userUtama->save();
                auth()->user()->refresh(); 
            }
        }

        // 2. PEMISAHAN DATA DARI TABEL USERS
        // $data_siswa = User::where('role', 'siswa')->orderBy('id', 'desc')->get();
        // $data_tutor = User::where('role', 'tutor')->orderBy('id', 'desc')->get();
        // $data_admin = User::where('role', 'admin')->orderBy('id', 'desc')->get();
        // $data_user = User::orderBy('id', 'desc')->get();
        // return view('admin.elearning', compact('data_user'));
        $data_user = User::orderBy('id', 'desc')->get();

$data_siswa = User::where('role', 'siswa')
    ->orderBy('id', 'desc')
    ->get();

$data_tutor = User::where('role', 'tutor')
    ->orderBy('id', 'desc')
    ->get();

$data_admin = User::where('role', 'admin')
    ->orderBy('id', 'desc')
    ->get();


        // 3. DATA FORMULIR PENDAFTARAN
        try {
            $data_pendaftar = DB::table('pendaftarans')->orderBy('id', 'desc')->get();
        } catch (\Exception $e) {
            $data_pendaftar = collect([]);
        }

// Data kelas berdasarkan role
if (Auth::user()->role == 'admin') {

    // Admin melihat semua kelas beserta nama tutor
    $data_kelas = DB::table('kelas')
        ->join('users', 'kelas.tutor_id', '=', 'users.id')
        ->select(
            'kelas.*',
            'users.name as nama_tutor'
        )
        ->orderBy('kelas.id', 'desc')
        ->get();
           $data_kelas_saya = collect();

} elseif (Auth::user()->role == 'tutor') {

    // Tutor hanya melihat kelas miliknya
    $data_kelas = DB::table('kelas')
        ->join('users', 'kelas.tutor_id', '=', 'users.id')
        ->select(
            'kelas.*',
            'users.name as nama_tutor'
        )
        ->where('kelas.tutor_id', Auth::id())
        ->orderBy('kelas.id', 'desc')
        ->get();
   $data_kelas_saya = collect();

} else {

    // Siswa melihat semua kelas yang telah dibuat admin
$data_kelas = DB::table('kelas')
    ->leftJoin('users', 'kelas.tutor_id', '=', 'users.id')
    ->leftJoin('peserta_kelas', function ($join) {
        $join->on('kelas.id', '=', 'peserta_kelas.kelas_id')
             ->where('peserta_kelas.user_id', Auth::id());
    })
    ->select(
        'kelas.*',
        'users.name as nama_tutor',
        DB::raw('(SELECT COUNT(*) FROM peserta_kelas WHERE peserta_kelas.kelas_id = kelas.id) as jumlah_peserta')
    )
    ->whereNull('peserta_kelas.id') // hanya kelas yang BELUM diikuti
    ->orderBy('kelas.id', 'desc')
    ->get();

    // Kelas saya
    $data_kelas_saya = DB::table('peserta_kelas')
    ->join('kelas', 'peserta_kelas.kelas_id', '=', 'kelas.id')
    ->leftJoin('users', 'kelas.tutor_id', '=', 'users.id')
    ->select(
        'kelas.*',
        'users.name as nama_tutor',
        DB::raw('(SELECT COUNT(*) FROM peserta_kelas WHERE peserta_kelas.kelas_id = kelas.id) as jumlah_peserta')
    )
    ->where('peserta_kelas.user_id', Auth::id())
    ->get();
}

$data_mapel = collect();

        // 4. HITUNG STATISTIK REAL-TIME
        $total_siswa     = $data_siswa->count();
        $total_tutor     = $data_tutor->count();
        $total_admin     = $data_admin->count();
        $total_pendaftar = $data_pendaftar->count();
        $total_kelas     = 0;

        return view('admin.elearning', compact(
            'data_kelas', 'data_kelas_saya', 'data_mapel', 'data_tutor', 'data_siswa', 'data_admin', 'data_pendaftar',
            'total_siswa', 'total_tutor', 'total_kelas', 'total_pendaftar', 'total_admin','data_user'
        ));
    }

   public function storePendaftaran(Request $request)
{
    // 1. Longgarkan validasi sementara untuk testing
    $request->validate([
        'nama_lengkap' => 'nullable', // ubah dulu ke nullable agar tidak mencegat data
        'nik'          => 'nullable',
    ]);

    try {
        // 2. Proses Insert ke DB
        DB::table('pendaftarans')->insert([
            // Sesuaikan kolom kiri dengan nama kolom asli di phpMyAdmin Anda!
            'nama_lengkap'       => $request->input('nama_lengkap') ?? $request->input('name'), 
            'nik'                => $request->input('nik'),
            'status_verifikasi'  => 'pending', // Status awal agar terbaca di Dashboard Admin
            'created_at'         => now(),
            'updated_at'         => now()
        ]);

        // Mengembalikan dengan session 'sukses_data' yang kita tangkap di Langkah 1
        return redirect('/')->with('sukses_data', 'Pendaftaran Anda berhasil dikirim! Silakan tunggu verifikasi dari Admin.');

    } catch (\Exception $e) {
        // Jika ada eror database (misal nama kolom salah), dia akan memunculkan pesan eror aslinya
        return redirect('/')->with('error_data', 'Gagal menyimpan ke database: ' . $e->getMessage());
    }
}
public function simpanKelas(Request $request)
{
    $request->validate([
        'nama_kelas' => 'required|string|max:255',
        'tutor_id'   => 'required|integer',
        'deskripsi'  => 'nullable|string',
    ]);

    DB::table('kelas')->insert([
        'nama_kelas' => $request->nama_kelas,
        'tutor_id'   => $request->tutor_id,
        'deskripsi'  => $request->deskripsi,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()->back()->with('success', 'Kelas berhasil ditambahkan.');
}
}
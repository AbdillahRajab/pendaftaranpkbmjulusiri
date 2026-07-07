<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;



/*
|--------------------------------------------------------------------------
| A. RUTE PUBLIK (Bebas Diakses Siapa Saja - TIDAK BOLEH MASUK MIDDLEWARE)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

// Tampilan Halaman Formulir Pendaftaran Publik
Route::get('/pendaftaran', function () {
    return view('pendaftaran.form');
})->name('pendaftaran.form');

// Proses Pengiriman Data Form Pendaftaran (POST)
Route::post('/pendaftaran/kirim', [PendaftaranController::class, 'store'])->name('pendaftaran.store');

// Tampilan Halaman Login Satu Pintu
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

// Proses Validasi Autentikasi Login Akun
Route::post('/login', [AuthController::class, 'processLogin'])->name('login.process');

// Form Registrasi Akun Baru (Triple Aktor)
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');


/*
|--------------------------------------------------------------------------
| B. RUTE INTERNAL (Wajib Login - DILINDUNGI PENUH OLEH AUTH MIDDLEWARE)
|--------------------------------------------------------------------------
*/
    Route::middleware(['auth'])->group(function () {
    
    // GANTI BARIS INI: Alihkan rute utama elearning ke AdminController
    Route::get('/elearning', [AdminController::class, 'index'])->name('elearning.index');

    // Tambahkan Rute untuk memproses pengisian form kelola data admin
    Route::post('/elearning/tambah-kelas', [AdminController::class, 'storeKelas'])->name('admin.storeKelas');
    Route::post('/elearning/tambah-mapel', [AdminController::class, 'storeMapel'])->name('admin.storeMapel');
    Route::post('/elearning/tambah-tutor', [AdminController::class, 'storeTutor'])->name('admin.storeTutor');

    Route::get('/admin/promosi/{id}', [AdminController::class, 'jadikanAdmin']);
    Route::get('/admin/demosi/{id}', [AdminController::class, 'turunkanJabatan']);


    // Rute Verifikasi Berkas kemarin tetap biarkan ada
    Route::get('/verifikasi-berkas', [PendaftaranController::class, 'indexAdmin'])->name('admin.verifikasi');
    Route::get('/verifikasi-berkas/{id}/{status}', [PendaftaranController::class, 'ubahStatus'])->name('admin.verifikasi.status');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Rute untuk memproses pengiriman formulir pendaftaran siswa baru
    Route::post('/pendaftaran-siswa', [PendaftaranController::class, 'store'])->name('pendaftaran.store');

    Route::post('/admin/pendaftaran/{id}/status/{status}', [PendaftaranController::class, 'ubahStatus'])->name('admin.pendaftaran.status');
    Route::get('/admin/pendaftaran/{id}/edit', [PendaftaranController::class, 'edit'])->name('admin.pendaftaran.edit');
    Route::delete('/admin/pendaftaran/{id}', [PendaftaranController::class, 'destroy'])->name('admin.pendaftaran.destroy');


    // Pastikan baris rute ini ada di dalam group admin Anda
    Route::get('/admin/pendaftaran/{id}/lihat', [PendaftaranController::class, 'show'])->name('admin.pendaftaran.show');
    Route::put('/admin/pendaftaran/{id}', [PendaftaranController::class, 'update'])->name('admin.pendaftaran.update');
    Route::delete('/admin/pendaftaran/{id}', [PendaftaranController::class, 'destroy'])->name('admin.pendaftaran.destroy');

    // Rute untuk memproses Update data User
    Route::put('/admin/user/{id}/update', [App\Http\Controllers\PendaftaranController::class, 'userUpdate'])->name('admin.user.update');

    // Rute untuk memproses Hapus data User
    Route::delete('/admin/user/{id}/delete', [App\Http\Controllers\PendaftaranController::class, 'userDestroy'])->name('admin.user.destroy');

    // 1. Jalur POST: Mengupdate password kelas (Aksi dari modal tutor)
Route::post('/ruang-kelas/{id}/verifikasi', function (Request $request, $id) {

    $passwordMasuk = $request->password_masuk;

    $kelas = DB::table('kelas')
        ->where('id', $id)
        ->first();

    if (!$kelas) {
        return back()->with('error', 'Kelas tidak ditemukan.');
    }

    if ($kelas->password_kelas != $passwordMasuk) {
        return back()->with('error', 'Password salah.');
    }

    // Cek apakah siswa sudah menjadi peserta
    $cek = DB::table('peserta_kelas')
        ->where('kelas_id', $id)
        ->where('user_id', Auth::id())
        ->exists();

    if (!$cek) {

        DB::table('peserta_kelas')->insert([

            'kelas_id' => $id,
            'user_id' => Auth::id(),
            'created_at' => now(),
            'updated_at' => now(),

        ]);

    }
     return redirect('/ruang-kelas/'.$id);
});
    });

    // Pastikan nama route ini terdaftar persis seperti ini
    Route::post('/admin/kelas/simpan', [AdminController::class, 'simpanKelas'])->name('admin.simpanKelas');

Route::middleware('auth')->get('/api/ambil-kelas-tutor', function () {
    return DB::table('kelas')
        ->where('tutor_id', Auth::id())
        ->orderBy('id', 'desc')
        ->get();
});

// 2. Jalur POST Khusus: Mengurus simpan kelas baru dari modal tutor
Route::post('/tutor/proses-tambah-kelas', function (Request $request) {
    $namaKelas = $request->input('nama_kelas');
    $deskripsiKelas = $request->input('deskripsi_kelas');
    $userId = Auth::id() ?: 1; 
    $waktu = now();

    DB::insert("INSERT INTO kelas (user_id, nama_kelas, deskripsi, created_at, updated_at) VALUES (?, ?, ?, ?, ?)", [
        $userId, $namaKelas, $deskripsiKelas, $waktu, $waktu
    ]);

    return redirect()->back(); // Otomatis refresh halaman setelah simpan
})->name('tutor.prosesSimpanKelas');


Route::get('/ruang-kelas/{id}', function ($id) {

    $kelas = DB::table('kelas')
        ->where('id', $id)
        ->first();

    if (!$kelas) {
        return back();
    }

    // Jika Tutor
    if (Auth::user()->role == 'tutor') {

        if ($kelas->tutor_id != Auth::id()) {
            abort(403);
        }

    }

    // Jika Siswa
    if (Auth::user()->role == 'siswa') {

        $ikut = DB::table('peserta_kelas')
            ->where('kelas_id', $id)
            ->where('user_id', Auth::id())
            ->exists();

        if (!$ikut) {
            return redirect('/elearning')
                ->with('error', 'Anda belum bergabung pada kelas ini.');
        }

    }

    $materi = DB::table('materi_kelas')
        ->where('kelas_id', $id)
        ->get();

    return view('admin.detail_kelas', compact('kelas', 'materi'));
})->name('tutor.detailKelas');



// Jalur POST: Mengupload materi/tugas baru (Aksi dari modal tutor)
Route::post('/ruang-kelas/{id}/upload', function (Request $request, $id) {

    $judul      = $request->judul;
    $deskripsi  = $request->deskripsi;
    $tipe       = $request->tipe;
    $deadline   = $request->deadline;

    $file_path = null;
    $file_soal = null;

    // Jika ada file yang diupload
    if ($request->hasFile('file_materi')) {

        $file = $request->file('file_materi');

        $namaFile = time().'_'.$file->getClientOriginalName();

        $file->move(public_path('uploads/materi'), $namaFile);

        if ($tipe == 'materi') {
            $file_path = 'uploads/materi/'.$namaFile;
        } else {
            $file_soal = 'uploads/materi/'.$namaFile;
        }

    }

    DB::table('materi_kelas')->insert([

        'kelas_id'   => $id,
        'judul'      => $judul,
        'deskripsi'  => $deskripsi,
        'tipe'       => $tipe,
        'file_path'  => $file_path,
        'file_soal'  => $file_soal,
        'deadline'   => $deadline,
        'created_at' => now(),
        'updated_at' => now(),

    ]);

    return redirect()->back()->with('success','Materi berhasil diupload.');

});

Route::post('/tugas/{id}/upload-jawaban', function (Request $request, $id) {

    $fileJawaban = null;

    if ($request->hasFile('file_jawaban')) {

        $file = $request->file('file_jawaban');

        $namaFile = time().'_'.$file->getClientOriginalName();

        $file->move(public_path('uploads/jawaban'), $namaFile);

        $fileJawaban = 'uploads/jawaban/'.$namaFile;

    }

    DB::table('pengumpulan_tugas')->insert([

        'materi_id'     => $id,
        'kelas_id'      => $request->kelas_id,
        'user_id'       => Auth::id(),
        'file_jawaban'  => $fileJawaban,
        'keterangan'    => $request->keterangan,
        'created_at'    => now(),
        'updated_at'    => now(),

    ]);

    return back()->with('success','Jawaban berhasil dikumpulkan.');

});
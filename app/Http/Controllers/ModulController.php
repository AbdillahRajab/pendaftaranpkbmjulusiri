<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Modul; // Pastikan Anda sudah memiliki Model Modul
use Illuminate\Support\Facades\Storage;

class ModulController extends Controller
{
    /**
     * Menampilkan daftar semua modul (Untuk Siswa & Tutor)
     */
    public function index()
    {
        $all_modul = Modul::all();
        return view('elearning.index', compact('all_modul'));
    }

    /**
     * Memproses upload modul baru ke storage dan database
     */
    public function store(Request $request)
    {
        // 1. Validasi Input dan File Modul
        $validatedData = $request->validate([
            'judul_modul'   => 'required|string|max:255',
            'program_paket' => 'required|in:Paket A,Paket B,Paket C',
            'mata_pelajaran'=> 'required|string|max:100',
            'file_modul'    => 'required|file|mimes:pdf,doc,docx,ppt,pptx|max:5120', // Maksimal 5MB
        ], [
            'file_modul.mimes' => 'Format file harus berupa PDF, Word, atau PowerPoint.',
            'file_modul.max'   => 'Ukuran file modul tidak boleh lebih dari 5MB.',
        ]);

        // 2. Handle Upload File Fisik ke folder: storage/app/public/berkas_modul
        if ($request->hasFile('file_modul')) {
            $filePath = $request->file('file_modul')->store('berkas_modul', 'public');
            $validatedData['file_modul'] = $filePath;
        }

        // 3. Simpan informasi ke database di tabel 'modul'
        Modul::create($validatedData);

        return redirect()->back()->with('sukses', 'Modul pembelajaran berhasil diunggah!');
    }

    /**
     * Mengunduh file modul secara aman
     */
    public function download($id)
    {
        $modul = Modul::findOrFail($id);

        // Periksa apakah file fisik benar-benar ada di storage
        if (Storage::disk('public')->exists($modul->file_modul)) {
            return Storage::disk('public')->download($modul->file_modul);
        }

        return redirect()->back()->with('gagal', 'File fisik modul tidak ditemukan di server.');
    }
    // Tambahkan Request $request di dalam kurung fungsi index Anda
public function index(Request $request)
{
    // Ini penting agar Laravel mengizinkan parameter ?page= dibaca di file blade
    return view('elearning'); 
}
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftar extends Model
{
    use HasFactory;

    // Menentukan nama tabel (opsional karena default laravel mendeteksi jamak, kita paksa ke tunggal)
    protected $table = 'pendaftar';

    // Kolom yang diizinkan untuk diisi massal
    protected $fillable = [
        'nama_lengkap',
        'nik',
        'email',
        'no_hp',
        'program_paket',
        'file_ktp',
        'file_ijazah_terakhir',
        'status_pendaftaran'
    ];
}
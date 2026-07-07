<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
   protected $fillable = [
    'nama', 'paket', 'nohp', 'file_ktp', 'file_kk', 'file_ijazah', 'file_akta', 'status',
    'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'alamat', 
    'nama_ayah', 'nama_ibu', 'pekerjaan_ortu', 'no_hp_ortu', 'sekolah_asal', 'tahun_keluar'
];
}
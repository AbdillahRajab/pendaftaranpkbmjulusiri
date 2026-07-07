<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    use HasFactory;

    protected $table = 'modul';

    protected $fillable = [
        'judul_modul',
        'program_paket',
        'mata_pelajaran',
        'file_modul'
    ];
}
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftar', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('nik', 16)->unique();
            $table->string('email')->unique();
            $table->string('no_hp');
            $table->enum('program_paket', ['Paket A', ['Paket B'], 'Paket C']);
            $table->string('file_ktp')->nullable(); // Menampung berkas administrasi
            $table->string('file_ijazah_terakhir')->nullable(); // Menampung berkas administrasi
            $table->enum('status_pendaftaran', ['pending', 'diverifikasi', 'ditolak'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftar');
    }
};
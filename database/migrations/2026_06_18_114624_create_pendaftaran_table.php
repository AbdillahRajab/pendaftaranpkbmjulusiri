<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
{
    Schema::create('pendaftarans', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('paket');
        $table->string('nohp');
        $table->string('file_ktp')->nullable();
        $table->string('file_kk')->nullable();
        $table->string('status')->default('Pending'); // Status awal: Pending, nanti bisa Diterima / Ditolak oleh Admin
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};

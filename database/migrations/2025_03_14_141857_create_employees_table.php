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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            // Informasi Dasar
            $table->string('nip')->unique();
            $table->string('nama');
            $table->string('nama_depan');
            $table->string('nama_belakang')->nullable();
            $table->string('jabatan');
            $table->string('departemen');
            
            // Kontak Utama
            $table->string('no_telepon');
            $table->string('email')->unique();
            
            // Foto
            $table->string('foto')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};

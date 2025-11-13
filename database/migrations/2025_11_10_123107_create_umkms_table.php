<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('umkms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nama_umkm');
            $table->string('kategori')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('alamat')->nullable();
            $table->string('kontak')->nullable();
            $table->string('foto')->nullable(); // logo UMKM
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('umkms');
    }
};
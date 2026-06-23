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
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string('judul');      // Kolom untuk judul pengumuman/info kampus
            $table->text('isi');          // Kolom untuk isi pengumuman yang panjang
            $table->string('kategori');   // Kolom untuk kategori (contoh: Akademik, Beasiswa, Event)
            $table->timestamps();         // Otomatis membuat kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
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
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            // Menambahkan foreign key ke tabel tickets
            // onDelete('cascade') artinya jika tiket dihapus, rating otomatis ikut terhapus
            $table->foreignId('ticket_id')->constrained('tickets')->onDelete('cascade');
            
            // Kolom untuk score (misal: 1-5)
            $table->integer('score');
            
            // Kolom untuk komentar tambahan
            $table->text('comment')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
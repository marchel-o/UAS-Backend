<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    // Tambahkan nama tabel jika nama tabel kalian di DB adalah 'announcements'
    protected $table = 'announcements';

    // PERBAIKAN UTAMA: Daftarkan kolom database kalian di dalam $fillable!
    // Ini gunanya agar Laravel mengizinkan input judul, kategori, dan isi masuk ke SQLite.
    protected $fillable = [
        'judul',
        'kategori',
        'isi',
        // JIKA di database kalian nama kolomnya bahasa inggris, ganti dengan baris di bawah ini:
        // 'title', 'category', 'description'
    ];
}
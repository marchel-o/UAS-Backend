<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    // Daftarkan kolom database agar bisa diinput secara massal
    protected $fillable = ['judul', 'isi', 'kategori'];
}
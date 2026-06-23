<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    // Mengizinkan field ini diisi saat proses insert/update
    protected $fillable = ['ticket_id', 'score', 'comment'];

    /**
     * Mendefinisikan relasi: Rating ini milik satu Tiket
     */
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
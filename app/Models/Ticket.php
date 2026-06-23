<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory; // Jangan lupa tambahkan trait ini

    protected $fillable = [
        'title', 
        'description', 
        'status', 
        'priority', 
        'user_id',
        'category_id',
        'attachment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function histories()
    {
        return $this->hasMany(TicketHistory::class);
    }

    // RELASI RATING YANG DIPERBAIKI
    public function rating()
    {
        // Menambahkan foreign key secara eksplisit untuk keamanan
        return $this->hasOne(Rating::class, 'ticket_id');
    }
}
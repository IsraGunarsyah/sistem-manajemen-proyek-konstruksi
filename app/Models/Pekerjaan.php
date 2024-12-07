<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model
{
    use HasFactory;

    protected $table = 'pekerjaans';

    // Kolom yang dapat diisi
    protected $fillable = [
        'nama_pekerjaan',
        'lokasi',
        'kota',
        'deskripsi',
        'tanggal_mulai',
        'subkontraktor',
        'status',
        'user_id'
    ];

    /**
     * Relasi dengan model Progress
     */
    public function progress()
    {
        return $this->hasMany(Progress::class);
    }

    /**
     * Relasi dengan model User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

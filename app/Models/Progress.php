<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    protected $fillable = [
        'pekerjaan_id',
        'tanggal_waktu_pengerjaan',
        'kondisi_cuaca',
        'foto',
        'jenis_pekerjaan',
        'status',
    ];

    public function pekerjaan()
    {
        return $this->belongsTo(Pekerjaan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


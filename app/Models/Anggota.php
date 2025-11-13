<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $fillable = [
        'umkm_id',
        'nama',
        'jabatan',
        'kontak',
        'foto',
    ];

    public function umkm()
    {
        return $this->belongsTo(Umkm::class);
    }
}
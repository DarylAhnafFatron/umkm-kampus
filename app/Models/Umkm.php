<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_umkm',
        'kategori',
        'deskripsi',
        'alamat',
        'kontak',
        'foto',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function produks()
    {
        return $this->hasMany(Produk::class);
    }

    public function anggotas()
    {
        return $this->hasMany(Anggota::class);
    }
}
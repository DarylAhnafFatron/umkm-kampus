<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'umkm_id',
        'nama_produk',
        'deskripsi',
        'harga',
        'stok',
        'foto',
    ];

    public function umkm()
    {
        return $this->belongsTo(Umkm::class);
    }
}
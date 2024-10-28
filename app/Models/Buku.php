<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';

    protected $fillable = [
        'id',
        'judul',
        'image',
        'sinopsis',
        'pengarang',
        'tahun_terbit',
        'id_kategori',
        'stok',

    ];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_buku');
    }
}

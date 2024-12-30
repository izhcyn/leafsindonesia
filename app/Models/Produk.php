<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'Produk'; // Pastikan ini sesuai dengan nama tabel di database.

    /**
     * Kolom yang dapat diisi secara massal (mass assignable).
     */
    protected $fillable = [
        'image',
        'genus',
        'ukuran',
        'deskripsi',
        'nama',
        'harga',
        'label',
        'stock',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk'; // Pastikan sesuai dengan nama tabel di database.

    /**
     * Kolom yang dapat diisi secara massal (mass assignable).
     */
    protected $fillable = [
        'image',
        'image_2',
        'image_3',
        'genus',
        'ukuran',
        'deskripsi',
        'nama',
        'price',
        'label',
        'stock',
    ];

    /**
     * Relasi dengan Cart.
     */
    public function carts()
    {
        return $this->hasMany(Cart::class, 'produk_id');
    }

    /**
     * Relasi dengan OrderItem.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'produk_id');
    }

    /**
     * Ambil harga valid dengan fallback jika null.
     */
    public function getValidPriceAttribute()
    {
        return $this->harga ?? 0; // Jika harga null, kembalikan 0.
    }
}

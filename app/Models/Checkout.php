<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;

    // Nama tabel jika menggunakan nama berbeda
    protected $table = 'checkout';  // Pastikan nama tabel sesuai

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'recipient_name',
        'recipient_address',
        'recipient_phone',
        'product_name',
        'quantity',
        'country',
    ];
}

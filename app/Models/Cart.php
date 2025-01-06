<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Cart extends Model
{
    use HasFactory;

    protected $table = 'cart';

    protected $fillable = [
        'user_id',
        'produk_id',
        'quantity',
        'price',
        'status',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function produk()
{
    return $this->belongsTo(Produk::class, 'produk_id');
}

}

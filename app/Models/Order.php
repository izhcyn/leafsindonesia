<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'recipient_name',
        'recipient_address',
        'recipient_phone',
        'country',
        'whatsapp_number',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}

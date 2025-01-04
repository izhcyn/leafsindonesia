<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genus extends Model
{
    use HasFactory;

    protected $table = 'genus';


    protected $fillable = ['name']; // Kolom yang dapat diisi
}


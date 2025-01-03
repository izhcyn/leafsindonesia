<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Produk;

class FilterController extends Controller
{
    public function index()
    {
        // Fetch distinct sizes from the database
        $sizes = \App\Models\Produk::select('ukuran')->distinct()->pluck('ukuran');

        return view('filter', compact('sizes'));
    }
}

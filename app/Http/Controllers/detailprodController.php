<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class detailprodController extends Controller
{
    public function index(){
        return view('detailprod');
    }

    public function show($id)
    {
        $produk = Produk::findOrFail($id); // Ambil produk berdasarkan ID
        return view('detailprod', compact('produk')); // Kirim produk ke view
    }
}

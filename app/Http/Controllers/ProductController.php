<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class ProductController extends Controller
{
    public function index()
    {
        // Ambil semua produk untuk keperluan lain (jika diperlukan)
        $produks = Produk::all();

        // Ambil semua genus yang unik dari produk yang sudah ada
        $genusList = Produk::select('genus')->distinct()->get();

        return view('allproducts', compact('produks', 'genusList'));
    }

    public function create()
    {
        return view('add-product'); // Pastikan ada file view 'add-product'
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
            'genus' => 'required|string|max:100',
            'ukuran' => 'required|string|max:50',
            'deskripsi' => 'required|string|max:100',
            'nama' => 'required|string|max:100',
            'harga' => 'required|numeric',
            'label' => 'nullable|in:hot_item,last_stock,only_one',
            'stock' => 'required|integer',
        ]);

        // Simpan produk ke database
        $imagePath = $request->file('image')->store('produk', 'public');

Produk::create([
    'image' => $imagePath,
    'genus' => $request->genus,
    'ukuran' => $request->ukuran,
    'deskripsi' => $request->deskripsi,
    'nama' => $request->nama,
    'harga' => $request->harga,
    'label' => $request->label,
    'stock' => $request->stock,
]);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan!');
    }
    public function show($id)
{
    $produk = Produk::findOrFail($id); // Cari produk berdasarkan ID atau tampilkan 404 jika tidak ada
    return view('detailprod', compact('produk')); // Kirim data ke view detail
}


}

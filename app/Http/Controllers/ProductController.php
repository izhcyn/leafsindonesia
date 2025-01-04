<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\Storage;
use App\Models\Genus;


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

    public function showProduct(){
        $produks = Produk::all();
        return view('listproduct', compact('produks'));
    }

    public function create()
    {
        $genusList = Genus::all();
        return view('add-product', compact('genusList')); // Pastikan ada file view 'add-product'
    }



    public function store(Request $request)
    {

        $request->validate([
            'image' => 'required|image|max:2048',
            'image_2' => 'nullable|image|max:2048',
            'image_3' => 'nullable|image|max:2048',
            'genus' => 'required|string|max:100',
            'ukuran' => 'required|string|max:50',
            'deskripsi' => 'required|string|max:255',
            'nama' => 'required|string|max:100',
            'harga' => 'required|numeric',
            'label' => 'nullable|in:hot_item,last_stock,only_one',
            'stock' => 'required|integer',
        ]);

        // Simpan gambar thumbnail (image)
        $imagePath = $request->file('image')->store('produk', 'public');

        // Simpan gambar tambahan (image_2 dan image_3)
        $image2Path = $request->file('image_2') ? $request->file('image_2')->store('produk', 'public') : null;
        $image3Path = $request->file('image_3') ? $request->file('image_3')->store('produk', 'public') : null;

        // Simpan produk ke database
        Produk::create([
            'image' => $imagePath,
            'image_2' => $image2Path,
            'image_3' => $image3Path,
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

public function edit($id)
{
    $produk = Produk::findOrFail($id); // Ambil produk berdasarkan ID
    return view('edit-product', compact('produk')); // Kirim data ke view edit
}

public function update(Request $request, $id)
{
    $request->validate([
        'nama' => 'required|string|max:100',
        'genus' => 'required|string|max:100',
        'ukuran' => 'required|string|max:50',
        'deskripsi' => 'required|string|max:255',
        'harga' => 'required|numeric',
        'stock' => 'required|integer',
        'label' => 'nullable|in:hot_item,last_stock,only_one',
        'image' => 'nullable|image|max:2048',
        'image_2' => 'nullable|image|max:2048',
        'image_3' => 'nullable|image|max:2048',
    ]);

    $produk = Produk::findOrFail($id);

    // Update thumbnail (image)
    if ($request->hasFile('image')) {
        if ($produk->image) {
            Storage::delete('public/' . $produk->image); // Hapus file lama
        }
        $imagePath = $request->file('image')->store('produk', 'public');
        $produk->image = $imagePath;
    }

    if ($request->hasFile('image_2')) {
        if ($produk->image_2) {
            Storage::delete('public/' . $produk->image_2); // Hapus file lama
        }
        $image2Path = $request->file('image_2')->store('produk', 'public');
        $produk->image_2 = $image2Path;
    }

    if ($request->hasFile('image_3')) {
        if ($produk->image_3) {
            Storage::delete('public/' . $produk->image_3); // Hapus file lama
        }
        $image3Path = $request->file('image_3')->store('produk', 'public');
        $produk->image_3 = $image3Path;
    }

    // Update other fields
    $produk->nama = $request->nama;
    $produk->genus = $request->genus;
    $produk->ukuran = $request->ukuran;
    $produk->deskripsi = $request->deskripsi;
    $produk->harga = $request->harga;
    $produk->stock = $request->stock;
    $produk->label = $request->label;

    $produk->save();

    return redirect()->route('listproduct')->with('success', 'Produk berhasil diperbarui!');
}
public function destroy($id)
{
    $produk = Produk::findOrFail($id);

    // Hapus file gambar dari storage jika ada
    if ($produk->image) {
        Storage::delete('public/' . $produk->image);
    }
    if ($produk->image_2) {
        Storage::delete('public/' . $produk->image_2);
    }
    if ($produk->image_3) {
        Storage::delete('public/' . $produk->image_3);
    }

    $produk->delete();

    return redirect()->route('listproduct')->with('success', 'Produk berhasil dihapus!');
}
}

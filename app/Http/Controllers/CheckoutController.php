<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('checkout'); // Buat tampilan di langkah berikutnya
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'address' => 'required|string',
            'country' => 'required|string',
        ]);

        // Simpan data pesanan (contoh sederhana)
        // Anda bisa menyesuaikan dengan model pesanan jika sudah ada
        // Order::create([...]);

        return redirect()->route('allproducts')->with('success', 'Your order has been placed!');
    }
}


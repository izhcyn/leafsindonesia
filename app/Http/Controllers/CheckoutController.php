<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
// Di dalam method index di CheckoutController
public function index(Request $request)
{
    $selectedItems = $request->query('selectedItems', []);

    $cartItems = DB::table('cart')
        ->join('produk', 'cart.produk_id', '=', 'produk.id')
        ->where('cart.user_id', auth()->id())
        ->whereIn('cart.produk_id', $selectedItems) // Hanya ambil item yang dipilih
        ->select('cart.*', 'produk.nama as name', 'produk.price', 'produk.image', 'produk.genus', 'produk.ukuran')
        ->get();

    $total = $cartItems->sum(function ($item) {
        return $item->price * $item->quantity;
    });

    return view('checkout', [
        'cartItems' => $cartItems,
        'total' => $total,
        'selectedItems' => $selectedItems // Kirim item yang dipilih ke view
    ]);
}

    public function store(Request $request)
    {
        try {
            // Validasi input yang diterima dari request
            $validatedData = $request->validate([
                'selectedItems' => 'required|array',
                'selectedItems.*' => 'integer|exists:produk,id', // Pastikan menggunakan 'produk'
                'recipient_name' => 'required|string|max:255',
                'recipient_address' => 'required|string',
                'recipient_phone' => 'required|string|max:15',
                'country' => 'required|string|max:100',
                'whatsapp_number' => 'nullable|string|max:15',
            ]);

            // Proses setiap item yang dipilih
            foreach ($validatedData['selectedItems'] as $productId) {
                // Ambil produk berdasarkan ID
                $product = DB::table('produk')->where('id', $productId)->first();

                // Simpan order item ke database
                DB::table('order_items')->insert([
                    'order_id' => $order,
                    'produk_id' => $productId,
                    'quantity' => 1, // Asumsi default quantity = 1
                    'price' => $product->price,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            return response()->json(['success' => true, 'message' => 'Order placed successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong!'], 500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = DB::table('cart')
            ->join('produk', 'cart.produk_id', '=', 'produk.id')
            ->where('cart.user_id', auth()->id())
            ->select('cart.*', 'produk.nama as name', 'produk.price', 'produk.image', 'produk.genus', 'produk.ukuran')
            ->get();

        $total = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        return view('checkout', [
            'cartItems' => $cartItems,
            'total' => $total
        ]);
    }

    public function store(Request $request)
    {
        try {
            // Log data yang diterima
            Log::info('Request data:', $request->all());

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

            // Log data yang telah divalidasi
            Log::info('Validated data:', $validatedData);

            // Simpan order ke database
            $order = DB::table('orders')->insertGetId([
                'user_id' => auth()->id(), // Ambil ID user yang sedang login
                'recipient_name' => $validatedData['recipient_name'],
                'recipient_address' => $validatedData['recipient_address'],
                'recipient_phone' => $validatedData['recipient_phone'],
                'country' => $validatedData['country'],
                'whatsapp_number' => $validatedData['whatsapp_number'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Log::info('Order created:', ['order_id' => $order]);

            // Proses setiap item yang dipilih
            foreach ($validatedData['selectedItems'] as $productId) {
                // Ambil produk berdasarkan ID
                $product = DB::table('produk')->where('id', $productId)->first(); // Pastikan menggunakan 'produk'

                if (!$product) {
                    throw new \Exception("Product with ID {$productId} not found.");
                }

                // Pastikan untuk memeriksa apakah $product memiliki properti price
                if (!isset($product->price)) {
                    throw new \Exception("Product with ID {$productId} does not have a price.");
                }

                $orderItemData = [
                    'order_id' => $order,
                    'produk_id' => $productId,
                    'quantity' => 1, // Asumsi default quantity = 1
                    'price' => $product->price, // Gunakan 'price' yang baru
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                // Log data untuk setiap item
                Log::info('Data untuk OrderItem:', $orderItemData);

                // Simpan order item ke database
                DB::table('order_items')->insert($orderItemData);
            }

            return response()->json(['success' => true, 'message' => 'Order placed successfully!']);
        } catch (\Exception $e) {
            Log::error('Checkout error: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong!'], 500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', auth()->id())->get();

        $total = $cartItems->reduce(function ($sum, $item) {
            return $sum + ($item->price * $item->quantity);
        }, 0);

        return view('checkout', [
            'cartItems' => $cartItems,
            'total' => $total
        ]);
    }


    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'address' => 'required|string',
            'recipient_name' => 'required|string|max:255',
            'recipient_address' => 'required|string',
            'recipient_phone' => 'required|string|max:15',
            'country' => 'required|string',
            'products' => 'required|array',
            'products.*' => 'exists:carts,id',
            'whatsapp_number' => 'required|string|max:15',
        ]);
        // Buat pesanan baru
        $order = Order::create([
            'user_id' => auth()->id(),
            'recipient_name' => $validated['recipient_name'],
            'recipient_address' => $validated['recipient_address'],
            'recipient_phone' => $validated['recipient_phone'],
            'country' => $validated['country'],
            'whatsapp_number' => $validated['whatsapp_number'],
        ]);

        // Simpan data pesanan (contoh sederhana)
        // Anda bisa menyesuaikan dengan model pesanan jika sudah ada
        // Order::create([...]);
        // Tambahkan item ke dalam pesanan
        foreach ($validated['products'] as $cartId) {
            $cartItem = Cart::find($cartId);
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->price,
            ]);
            // Hapus item dari keranjang setelah checkout
            $cartItem->delete();
        }

        return redirect()->route('allproducts')->with('success', 'Your order has been placed!');
    }
}

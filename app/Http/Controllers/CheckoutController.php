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
        $selectedItems = $request->input('selectedItems');

        if (empty($selectedItems)) {
            return response()->json(['success' => false, 'message' => 'No items selected'], 400);
        }

        $cartItems = \DB::table('cart')
            ->where('user_id', auth()->id())
            ->whereIn('id', $selectedItems)
            ->get();

        $order = Order::create([
            'user_id' => auth()->id(),
            'recipient_name' => $request->input('recipient_name'),
            'recipient_address' => $request->input('recipient_address'),
            'recipient_phone' => $request->input('recipient_phone'),
            'country' => $request->input('country'),
            'whatsapp_number' => $request->input('whatsapp_number'),
        ]);

        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->produk_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->price,
            ]);

            // Hapus item dari keranjang
            \DB::table('cart')->where('id', $cartItem->id)->delete();
        }

        return response()->json(['success' => true]);
    }

}

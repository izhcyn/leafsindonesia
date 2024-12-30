<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Produk;

class shopCartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []); // Ambil data cart dari session
        $total = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cart)); // Hitung total harga

        return view('shopcart', compact('cart', 'total'));
    }



    public function addToCart($id)
    {
        $produk = produk::findOrFail($id);

        // Cek apakah produk sudah ada di tabel 'cart'
        $cartItem = \DB::table('cart')->where('user_id', auth()->id())->where('produk_id', $id)->first();

        if ($cartItem) {
            // Jika produk sudah ada, update jumlahnya
            \DB::table('cart')
                ->where('user_id', auth()->id())
                ->where('produk_id', $id)
                ->update([
                    'quantity' => $cartItem->quantity + 1,
                    'updated_at' => now(),
                ]);
        } else {
            // Jika produk belum ada, tambahkan entri baru
            \DB::table('cart')->insert([
                'user_id' => auth()->id(),
                'produk_id' => $id,
                'quantity' => 1,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->updateCartTotalItems();

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }


    public function update(Request $request)
    {
        if($request->id & $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    public function viewCart()
    {
        $userId = auth()->id();
        $cartItems = \DB::table('cart')
            ->join('produk', 'cart.produk_id', '=', 'produk.id')
            ->where('cart.user_id', $userId)
            ->select(
                'cart.*',
                'produk.nama as name',
                'produk.harga as price',
                'produk.image',
                'produk.genus',
                'produk.ukuran'
            )
            ->get();

        $total = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        return view('shopcart', compact('cartItems', 'total'));
    }

    public function updateCartTotalItems()
{
    // Pastikan user sudah login
    if (Auth::check()) {
        $userId = Auth::id();

        // Hitung total quantity dari semua item di keranjang user
        $totalItems = \DB::table('cart')
            ->where('user_id', $userId)
            ->sum('quantity');

        // Simpan jumlah total item ke sesi
        session(['cart_total_items' => $totalItems]);
    } else {
        // Jika user belum login, set total item ke 0
        session(['cart_total_items' => 0]);
    }
}

public function updateQuantity(Request $request)
{
    $cartItemId = $request->input('id');
    $newQuantity = $request->input('quantity');

    // Validasi input
    if (!$cartItemId || !$newQuantity || $newQuantity < 1) {
        return response()->json(['success' => false, 'message' => 'Invalid data'], 400);
    }

    // Ambil data item keranjang dan harga produk
    $cartItem = \DB::table('cart')
        ->join('produk', 'cart.produk_id', '=', 'produk.id')
        ->where('cart.id', $cartItemId)
        ->select('cart.*', 'produk.harga as price') // Ambil harga produk
        ->first();

    if ($cartItem) {
        // Update quantity di tabel cart
        \DB::table('cart')
            ->where('id', $cartItemId)
            ->update(['quantity' => $newQuantity, 'updated_at' => now()]);

        // Hitung ulang subtotal untuk item ini
        $subTotal = $cartItem->price * $newQuantity;

        // Hitung ulang total untuk semua item keranjang
        $total = \DB::table('cart')
            ->join('produk', 'cart.produk_id', '=', 'produk.id')
            ->where('cart.user_id', auth()->id())
            ->sum(\DB::raw('cart.quantity * produk.harga'));

        return response()->json([
            'success' => true,
            'subTotal' => $subTotal,
            'total' => $total,
        ]);
    }

    return response()->json(['success' => false, 'message' => 'Cart item not found'], 404);
}



    }



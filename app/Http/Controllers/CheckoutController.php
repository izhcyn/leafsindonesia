<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Checkout;

class CheckoutController extends Controller
{
// Di dalam method index di CheckoutController
// Di dalam method index di CheckoutController
public function index(Request $request)
{
    // Ambil produk yang dipilih dari query string
    $selectedItems = $request->query('selectedItems', []);

    if (empty($selectedItems)) {
        return redirect()->route('shopcart.index')->with('error', 'No items selected for checkout.');
    }

    // Ambil data item dari keranjang
    $cartItems = DB::table('cart')
        ->join('produk', 'cart.produk_id', '=', 'produk.id')
        ->where('cart.user_id', auth()->id())
        ->whereIn('cart.id', $selectedItems) // Cocokkan dengan ID dari tabel 'cart'
        ->select(
            'cart.id as cart_id',
            'produk.id as produk_id',
            'produk.nama as name',
            'cart.quantity',
            'produk.price',
            'produk.image'
        )
        ->get();

    if ($cartItems->isEmpty()) {
        return redirect()->route('shopcart.index')->with('error', 'Selected items not found in cart.');
    }

    // Hitung total harga
    $total = $cartItems->sum(function ($item) {
        return $item->price * $item->quantity;
    });

    // Kirim data ke view checkout
    return view('checkout', [
        'cartItems' => $cartItems,
        'total' => $total,
        'selectedItems' => $selectedItems, // Kirim item yang dipilih
        'isBuyNow' => false,
    ]);
}

public function store(Request $request)
{
    try {
        // Validasi input tetap sama
        $validatedData = $request->validate([
            'recipient_name' => 'required|string|max:255',
            'recipient_address' => 'required|string',
            'recipient_phone' => 'required|string|max:15',
            'country' => 'required|string|max:100',
            'products' => 'required|array',
            'products.*' => 'integer|exists:produk,id',
        ]);

        $isBuyNow = $request->input('isBuyNow') === 'true';
        $selectedItems = $request->input('products');

        Log::info("isBuyNow value: " . ($isBuyNow ? 'true' : 'false'));
        Log::info("Selected Items: " . json_encode($selectedItems));

        // Perbaiki query untuk Buy Now
        if ($isBuyNow) {
            $cartItems = DB::table('produk')
                ->whereIn('id', $selectedItems)
                ->select(
                    'id as produk_id',
                    'nama as name',
                    'price',
                    'image'
                )
                ->get()
                ->map(function ($item) {
                    $item->quantity = 1;
                    return $item;
                });
        } else {
            $cartItems = DB::table('cart')
                ->join('produk', 'cart.produk_id', '=', 'produk.id')
                ->where('cart.user_id', auth()->id())
                ->whereIn('cart.produk_id', $selectedItems)
                ->select(
                    'cart.quantity',
                    'produk.nama as name',
                    'produk.price',
                    'produk.id as produk_id',
                    'produk.image'
                )
                ->get();
        }

        Log::info("Cart Items: " . $cartItems->toJson());

        // Hitung total harga
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        // Simpan ke tabel orders
        $order = \App\Models\Order::create([
            'user_id' => auth()->id(),
            'recipient_name' => $validatedData['recipient_name'],
            'recipient_address' => $validatedData['recipient_address'],
            'recipient_phone' => $validatedData['recipient_phone'],
            'country' => $validatedData['country'],
        ]);
        Log::info("Order created with ID: " . $order->id);

        // Simpan ke tabel order_items
        foreach ($cartItems as $item) {
            \App\Models\OrderItem::create([
                'order_id' => $order->id,
                'recipient_name' => $validatedData['recipient_name'],
                'product_name' => $item->name,
                'produk_id' => $item->produk_id,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'total' => $item->price * $item->quantity,
            ]);
            Log::info("Order item saved: " . json_encode($item));
        }

        // Simpan ke tabel checkout
        foreach ($cartItems as $item) {
            $checkoutData = [
                'recipient_name' => $validatedData['recipient_name'],
                'recipient_address' => $validatedData['recipient_address'],
                'recipient_phone' => $validatedData['recipient_phone'],
                'product_name' => $item->name,
                'quantity' => $item->quantity,
                'country' => $validatedData['country'],
            ];

            // Simpan data ke tabel checkout
            Checkout::create($checkoutData);

            Log::info("Checkout data saved: " . json_encode($checkoutData));
        }

        // Hapus data dari cart jika bukan Buy Now
        if (!$isBuyNow) {
            try {
                Log::info("Deleting from cart for user_id: " . auth()->id() . ", product_ids: " . json_encode($selectedItems));
                $selectedItems = array_map('intval', $selectedItems);
                $deletedRows = DB::table('cart')
                    ->where('user_id', auth()->id())
                    ->whereIn('produk_id', $selectedItems)
                    ->delete();
                if ($deletedRows > 0) {
                    Log::info("Rows deleted from cart: " . $deletedRows);
                } else {
                    Log::warning("No rows deleted. Check if user_id or product_ids match.");
                }
            } catch (\Exception $e) {
                Log::error("Error deleting from cart: " . $e->getMessage());
            }
        }

        // Perbarui pesan WhatsApp
        $message = "Hello, I would like to make a purchase with the following details:\n\n";
        $message .= "======== Receipt ========\n";

        if ($cartItems->isNotEmpty()) {
            foreach ($cartItems as $item) {
                $message .= "Product Name: {$item->name}\n";
                $message .= "Price: " . number_format($item->price, 0, ',', '.') . "$\n";
                $message .= "Quantity: {$item->quantity}\n";
                $message .= "Total for this product: " . number_format($item->price * $item->quantity, 0, ',', '.') . "$\n";
                $message .= "----------------------------------\n";
            }
        }

        $message .= "\n======== Buyer Information ========\n";
        $message .= "Recipient Name: {$validatedData['recipient_name']}\n";
        $message .= "Address: {$validatedData['recipient_address']}\n";
        $message .= "WhatsApp Number: {$validatedData['recipient_phone']}\n";
        $message .= "Country: {$validatedData['country']}\n";

        $message .= "\nI would like to confirm the payment. For the total price including the shipping cost. Thank you!";

        $encodedMessage = urlencode($message);
        $sellerPhoneNumber = '6285156349511';
        $whatsappUrl = "https://wa.me/{$sellerPhoneNumber}?text={$encodedMessage}";

        Log::info("Redirecting to WhatsApp with URL: {$whatsappUrl}");

        return response()->json([
            'success' => true,
            'whatsappUrl' => $whatsappUrl,
        ]);

    } catch (\Exception $e) {
        Log::error("Error in CheckoutController@store: " . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'An error occurred during the checkout process.',
        ], 500);
    }
}

public function buyNow($id)
{
    try {
        // Ambil data produk berdasarkan ID
        $produk = DB::table('produk')->where('id', $id)->first();

        if (!$produk) {
            return redirect()->route('allproducts')->with('error', 'Product not found.');
        }

        // Buat array produk sebagai data sementara untuk checkout
        $cartItems = collect([
            (object) [
                'name' => $produk->nama,
                'quantity' => 1,
                'price' => $produk->price,
                'produk_id' => $produk->id,
                'image' => $produk->image,
            ],
        ]);

        // Hitung total harga
        $total = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        Log::info("Buy Now initiated for product:", [
            'product_id' => $id,
            'cartItems' => $cartItems->toArray(),
            'total' => $total
        ]);

        // Kirim data produk langsung ke halaman checkout
        return view('checkout', [
            'cartItems' => $cartItems,
            'total' => $total,
            'selectedItems' => [$produk->id],
            'isBuyNow' => true
        ]);
    } catch (\Exception $e) {
        Log::error("Error in buyNow: " . $e->getMessage());
        return redirect()->route('allproducts')
            ->with('error', 'An error occurred while processing your request.');
    }
}
}

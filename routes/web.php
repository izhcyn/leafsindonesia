<?php

use App\Http\Controllers\aboutUsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\contactUsController;
use App\Http\Controllers\detailprodController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\shopCartController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\CheckoutController;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\GenusController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::controller(SocialiteController::class)->group(function(){
    Route::get('auth/google', [SocialiteController::class, 'googleLogin'])->name('auth.google');
    Route::get('auth/google/callback', [SocialiteController::class, 'googleAuthentication'])->name('auth.google-callback');
});

// Route untuk menampilkan form login (GET request)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/welcome', function() {
    return view('welcome');  // Halaman welcome setelah login berhasil
})->name('welcome');

Route::get('/allproducts', [ProductController::class, 'index'])->name('allproducts');

Route::get('/contactus', [contactUsController::class, 'index'])->name('contactus');

Route::get('/aboutus', [aboutUsController::class, 'index'] )->name('aboutus');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/detailprod', [detailprodController::class, 'index'])->name('detailprod');
Route::get('/detailprod/{id}', [detailprodController::class, 'show'])->name('detailprod');
Route::get('/shopcart', [shopCartController::class, 'index'])->name('shopcart.index');
Route::get('/add-to-cart/{id}', [shopCartController::class, 'addToCart'])->name('add.to.cart');
Route::get('/shopcart', [shopCartController::class, 'viewCart'])->name('shopcart');
Route::patch('update-cart', [shopCartController::class, 'update'])->name('update.cart');
Route::post('/shopcart/update-quantity', [shopCartController::class, 'updateQuantity'])->name('cart.updateQuantity');
Route::post('/cart/update-quantity', [shopCartController::class, 'updateQuantity'])->name('cart.updateQuantity');



Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin/add-product', [ProductController::class, 'create'])->name('add.product');
    Route::post('/admin/add-product', [ProductController::class, 'store'])->name('store.product');
    Route::get('/admin/listproduct',  [ProductController::class, 'showProduct']) ->name('listproduct');
    Route::get('/admin/genus', [GenusController::class, 'listGenus'])->name('genus');
    Route::get('/weldone', function () {
        return view('weldone');
    })->name('weldone');
    Route::get('/produk/{id}/edit', [ProductController::class, 'edit'])->name('edit.product');
    Route::put('/produk/{id}', [ProductController::class, 'update'])->name('update.product');
    Route::delete('/produk/{id}', [ProductController::class, 'destroy'])->name('destroy.product');
    Route::get('/genus/{id}/edit', [GenusController::class, 'edit'])->name('genus.edit');
    Route::get('/admin/add-genus', [GenusController::class, 'create'])->name('genus.create');
    Route::post('/admin/add-genus', [GenusController::class, 'store'])->name('genus.store');
    Route::delete('/genus/{id}', [GenusController::class, 'destroy'])->name('genus.destroy');
    Route::put('/genus/{id}', [GenusController::class, 'update'])->name('genus.update');

});
Route::get('/update-cart-total-items', function () {
    $totalItems = session('cart_total_items', 0);
    return response()->json(['total_items' => $totalItems]);
});

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

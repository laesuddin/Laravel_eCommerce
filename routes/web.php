<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', [HomeController::class, 'rootpage']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('admin/dashboard', [AdminController::class, 'index'])->middleware(['auth', 'admin'])->name('dashboard');

Route::get('admin/view_catagory', [AdminController::class, 'view_catagory'])->name('view_catagory');
Route::post('admin/add_catagory', [AdminController::class, 'add_catagory'])->name('add_catagory');
Route::get('admin/delete_catagory/{id}', [AdminController::class, 'delete_catagory'])->name('delete_catagory');
Route::get('admin/view_product', [AdminController::class, 'view_product'])->name('view_product');
Route::post('admin/add_product', [AdminController::class, 'add_product'])->name('add_product');
Route::get('admin/show_product', [AdminController::class, 'show_product'])->name('show_product');
Route::get('admin/delete_product/{id}', [AdminController::class, 'delete_product'])->name('delete_product');
Route::get('admin/update_product/{id}', [AdminController::class, 'update_product'])->name('update_product');
Route::post('admin/update_product_confirm/{id}', [AdminController::class, 'update_product_confirm'])->name('update_product_confirm');
Route::get('admin/order', [AdminController::class, 'order'])->name('order');
Route::get('admin/delivered/{id}', [AdminController::class, 'delivered'])->name('delivered');
Route::get('admin/order_delete/{id}', [AdminController::class, 'order_delete'])->name('order_delete');
Route::get('admin/print_orderinfo/{id}', [AdminController::class, 'print_orderinfo'])->name('print_orderinfo');


Route::get('/product_details/{id}', [HomeController::class, 'product_details'])->name('product_details');
Route::post('/add_cart/{id}', [HomeController::class, 'add_cart'])->name('add_cart');
Route::get('/show_cart', [HomeController::class, 'show_cart'])->name('show_cart');
Route::get('/remove_cart/{id}', [HomeController::class, 'remove_cart'])->name('remove_cart');
Route::get('/cash_order', [HomeController::class, 'cash_order'])->name('cash_order');
Route::get('/stripe/{totalprice}', [HomeController::class, 'stripe'])->name('stripe');
Route::post('stripe/{totalprice}', [HomeController::class, 'stripePost'])->name('stripe.post');
Route::get('/show_order', [HomeController::class, 'show_order'])->name('show_order');
Route::get('/remove_order/{id}', [HomeController::class, 'remove_order'])->name('remove_order');
Route::get('/product_search', [HomeController::class, 'product_search'])->name('product_search');
Route::get('/search_product', [HomeController::class, 'search_product'])->name('search_product');
Route::get('/all_products', [HomeController::class, 'all_products'])->name('all_products');

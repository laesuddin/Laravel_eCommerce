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


Route::get('admin/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'admin'])->name('dashboard');

Route::get('admin/view_catagory', [AdminController::class, 'view_catagory'])->name('view_catagory');
Route::post('admin/add_catagory', [AdminController::class, 'add_catagory'])->name('add_catagory');
Route::get('admin/delete_catagory/{id}', [AdminController::class, 'delete_catagory'])->name('delete_catagory');
Route::get('admin/view_product', [AdminController::class, 'view_product'])->name('view_product');
Route::post('admin/add_product', [AdminController::class, 'add_product'])->name('add_product');
Route::get('admin/show_product', [AdminController::class, 'show_product'])->name('show_product');
Route::get('admin/delete_product/{id}', [AdminController::class, 'delete_product'])->name('delete_product');
Route::get('admin/update_product/{id}', [AdminController::class, 'update_product'])->name('update_product');
Route::post('admin/update_product_confirm/{id}', [AdminController::class, 'update_product_confirm'])->name('update_product_confirm');

Route::get('/product_details/{id}', [HomeController::class, 'product_details'])->name('product_details');
Route::post('/add_cart/{id}', [HomeController::class, 'add_cart'])->name('add_cart');
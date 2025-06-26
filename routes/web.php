<?php

use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    // return view('web.master');
    return redirect('/web/home');
});

// Route::get('/web', function () {
//     return view('web.home');
// });

// Web Routes
Route::get('/web/home', [WebController::class, 'index'])->name('web-home');
Route::get('/web/shop', [WebController::class, 'shop'])->name('web-shop');

// cart routes
Route::get('/web/cart', [WebController::class, 'cart'])->name('web-cart');
// Route::get('add-to-cart/{id}', [ProductController::class, 'addToCart'])->name('add.to.cart');
Route::get('/web/add-to-cart/{id}', [WebController::class, 'addToCart'])->name('web-add-to-cart');
Route::patch('/web/update-cart', [WebController::class, 'update'])->name('web-update-cart');
Route::delete('/web/remove-from-cart', [WebController::class, 'remove'])->name('web-remove-from-cart');




Route::get('/web/checkout', [WebController::class, 'checkout'])->name('web-checkout');
// Route::get('/*', [WebController::class, 'notfound'])->name('web-notfound');


// admin Routes
Route::get('/admin/home', [AdminController::class, 'index'])->name('admin-home');
Route::delete('/admin/orders/{id}', [AdminController::class, 'destroyOrder'])->name('admin-order-destroy');

// product Routes
Route::get('/admin/products', [ProductController::class, 'index'])->name('admin-products-index');
Route::get('/admin/orders', [ProductController::class, 'orders'])->name('admin-orders-index');
Route::get("/admin/products/create", [ProductController::class, 'create'])->name("admin-products-create");
Route::post("/admin/products", [ProductController::class, 'store'])->name("admin-products-store");
Route::delete("/admin/products/{product}", [ProductController::class, 'destroy'])->name("admin-products-destroy");

Route::get('/admin/products/{product}/edit', [ProductController::class, 'edit'])->name('admin-products-edit');
Route::put('/admin/products/{product}', [ProductController::class, 'update'])->name('admin-products-update');
Route::post('web/placeorder', [WebController::class, 'placeorder'])->name('web-placeorder');




// Route::view('/web/home', 'web.home');

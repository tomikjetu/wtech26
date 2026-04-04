<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;

Route::get('/', function () {
    return view('index');
});

Route::get('/produkty', function () {
    return view('products');
});

Route::get('/produkty/{id}', function ($id) {
    return view('product-detail', ['id' => $id]);
});

Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login']);

Route::get('/admin', function () {
    return redirect('/admin/products');
})->middleware('auth:admin');

Route::get('/admin/products', function () {
    return view('admin-products');
})->middleware('auth:admin');

Route::get('/admin/orders', function () {
    return view('admin-orders');
})->middleware('auth:admin');

Route::post('/admin/logout', [AuthController::class, 'logout']);

require __DIR__.'/auth.php';
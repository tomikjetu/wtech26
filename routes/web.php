<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/produkty', function () {
    return view('products');
});

Route::get('/produkty/{id}', function ($id) {
    return view('product-detail', ['id' => $id]);
});

require __DIR__.'/auth.php';
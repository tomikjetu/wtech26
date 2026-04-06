<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Helpers\MockData;

/* ─────────────────────────────────── HOMEPAGE ──────────────────────────────── */

Route::get('/', function () {
    return view('index');
})->name('home');

/* ──────────────────────────────────── PRODUCTS ─────────────────────────────── */

Route::get('/produkty', function () {
    $activeFilters = request()->only(['sizes', 'colors', 'price_min', 'price_max']);
    $products      = MockData::filterProducts(MockData::products(), $activeFilters);

    return view('products', [
        'products'         => $products,
        'categories'       => MockData::categories(),
        'sizes'            => MockData::sizes(),
        'colors'           => MockData::colors(),
        'mode'             => 'all',
        'pageTitle'        => 'Všetky produkty',
        'selectedCategory' => null,
        'searchQuery'      => null,
        'activeFilters'    => $activeFilters,
    ]);
})->name('products.all');

Route::get('/produkty/odporucane', function () {
    $products = MockData::filterProducts(MockData::products(), ['featured' => true]);

    return view('products', [
        'products'         => $products,
        'categories'       => MockData::categories(),
        'sizes'            => MockData::sizes(),
        'colors'           => MockData::colors(),
        'mode'             => 'featured',
        'pageTitle'        => 'Odporúčané produkty',
        'selectedCategory' => null,
        'searchQuery'      => null,
        'activeFilters'    => [],
    ]);
})->name('products.featured');

Route::get('/produkty/kategoria/{slug}', function (string $slug) {
    $categories = MockData::categories();
    $category   = collect($categories)->firstWhere('slug', $slug);

    if (! $category) {
        abort(404);
    }

    $activeFilters = request()->only(['sizes', 'colors', 'price_min', 'price_max']);
    $filters       = array_merge(['category' => $slug], $activeFilters);
    $products      = MockData::filterProducts(MockData::products(), $filters);

    return view('products', [
        'products'         => $products,
        'categories'       => $categories,
        'sizes'            => MockData::sizes(),
        'colors'           => MockData::colors(),
        'mode'             => 'category',
        'pageTitle'        => $category['name'],
        'selectedCategory' => $category,
        'searchQuery'      => null,
        'activeFilters'    => $activeFilters,
    ]);
})->name('products.category');

Route::get('/produkty/hladat/{query}', function (string $query) {
    $activeFilters = request()->only(['sizes', 'colors', 'price_min', 'price_max']);
    $filters       = array_merge(['search' => $query], $activeFilters);
    $products      = MockData::filterProducts(MockData::products(), $filters);

    return view('products', [
        'products'         => $products,
        'categories'       => MockData::categories(),
        'sizes'            => MockData::sizes(),
        'colors'           => MockData::colors(),
        'mode'             => 'search',
        'pageTitle'        => 'Výsledky: ' . $query,
        'selectedCategory' => null,
        'searchQuery'      => $query,
        'activeFilters'    => $activeFilters,
    ]);
})->name('products.search');

Route::get('/produkty/{id}', function (int $id) {
    $product = collect(MockData::products())->firstWhere('id', $id);

    if (! $product) {
        abort(404);
    }

    return view('product-detail', ['product' => $product]);
})->name('product.detail');

/* ────────────────────────────── CART & CHECKOUT ────────────────────────────── */

Route::get('/kosik', function () {
    return view('cart');
})->name('cart');

Route::get('/pokladna/doprava', function () {
    return view('checkout-delivery');
})->name('checkout.delivery');

Route::get('/pokladna/platba', function () {
    return view('checkout-payment');
})->name('checkout.payment');

Route::get('/pokladna/osobne-udaje', function () {
    return view('checkout-personal');
})->name('checkout.personal');

Route::get('/pokladna/suhrn', function () {
    return view('checkout-summary');
})->name('checkout.summary');

Route::get('/pokladna/potvrdenie', function () {
    return view('checkout-confirmation');
})->name('checkout.confirmation');

/* ──────────────────────────────── AUTH (CUSTOMER) ──────────────────────────── */

Route::get('/prihlasenie', function () {
    return view('login');
})->name('login');

Route::get('/registracia', function () {
    return view('register');
})->name('register');

Route::get('/profil', function () {
    return view('profile');
})->name('profile');

/* ──────────────────────────────────── ADMIN ────────────────────────────────── */

Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login']);

Route::middleware('auth:admin')->group(function () {
    Route::get('/admin', fn () => redirect()->route('admin.products'));

    Route::get('/admin/products', fn () => view('admin-products'))
        ->name('admin.products');

    Route::get('/admin/orders', fn () => view('admin-orders'))
        ->name('admin.orders');

    Route::get('/admin/categories', fn () => view('admin-categories'))
        ->name('admin.categories');
});

Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

require __DIR__.'/auth.php';

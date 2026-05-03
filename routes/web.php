<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\ProductController;
use App\Models\Sizes;
use Illuminate\Support\Facades\Auth;

/* ─────────────────────────────────── HOMEPAGE ──────────────────────────────── */

Route::get('/', [ProductController::class, 'index'])->name('home');

/* ──────────────────────────────────── PRODUCTS ─────────────────────────────── */


Route::get('/produkty', function () {
    $baseQuery = Product::query();

    $priceMinBound = (int) floor((float) ((clone $baseQuery)->min('price') ?? 0));
    $priceMaxBound = (int) ceil((float) ((clone $baseQuery)->max('price') ?? 100));

    if ($priceMinBound > $priceMaxBound) {
        $priceMinBound = 0;
        $priceMaxBound = 100;
    }

    $selectedPriceMin = max($priceMinBound, (int) request('price_min', $priceMinBound));
    $selectedPriceMax = min($priceMaxBound, (int) request('price_max', $priceMaxBound));

    if ($selectedPriceMin > $selectedPriceMax) {
        [$selectedPriceMin, $selectedPriceMax] = [$selectedPriceMax, $selectedPriceMin];
    }

    $activeFilters = array_merge(
        request()->only(['colors', 'sizes', 'sort']),
        [
            'price_min' => $selectedPriceMin,
            'price_max' => $selectedPriceMax,
        ]
    );

    $products = (clone $baseQuery)
                        ->with('images')
                        ->whereBetween('price', [$selectedPriceMin, $selectedPriceMax])
                        ->when(request('colors'), fn($q) => $q->whereIn('color', request('colors')))
                        ->when(request('sizes'), fn($q) => $q->whereHas('sizes', fn($q) => $q->whereIn('name', request('sizes'))))
                        ->when(request('sort') == 'price-asc', fn($q) => $q->orderBy('price', 'asc'))
                        ->when(request('sort') == 'price-desc', fn($q) => $q->orderBy('price', 'desc'))
                        ->paginate(12);

    return view('products', [
        'products'         => $products,
        'categories'       => Category::all(),
        'sizes'            => Sizes::all(),
        'colors'           => Product::distinct()->pluck('color')->filter(),
        'mode'             => 'all',
        'pageTitle'        => 'Všetky produkty',
        'selectedCategory' => null,
        'searchQuery'      => null,
        'activeFilters'    => $activeFilters,
        'priceBounds'      => [
            'min' => $priceMinBound,
            'max' => $priceMaxBound,
        ],
    ]);
})->name('products.all');

Route::get('/produkty/odporucane', function () {
    $baseQuery = Product::query()->where('sale_percent', '>', 0);

    $priceMinBound = (int) floor((float) ((clone $baseQuery)->min('price') ?? 0));
    $priceMaxBound = (int) ceil((float) ((clone $baseQuery)->max('price') ?? 100));

    if ($priceMinBound > $priceMaxBound) {
        $priceMinBound = 0;
        $priceMaxBound = 100;
    }

    $selectedPriceMin = max($priceMinBound, (int) request('price_min', $priceMinBound));
    $selectedPriceMax = min($priceMaxBound, (int) request('price_max', $priceMaxBound));

    if ($selectedPriceMin > $selectedPriceMax) {
        [$selectedPriceMin, $selectedPriceMax] = [$selectedPriceMax, $selectedPriceMin];
    }

    $activeFilters = array_merge(
        request()->only(['colors', 'sizes', 'sort']),
        [
            'price_min' => $selectedPriceMin,
            'price_max' => $selectedPriceMax,
        ]
    );

    $products = (clone $baseQuery)
                    ->with('images')
                    ->whereBetween('price', [$selectedPriceMin, $selectedPriceMax])
                    ->when(request('colors'), fn($q) => $q->whereIn('color', request('colors')))
                    ->when(request('sizes'), fn($q) => $q->whereHas('sizes', fn($q) => $q->whereIn('name', request('sizes'))))
                    ->when(request('sort') == 'price-asc', fn($q) => $q->orderBy('price', 'asc'))
                    ->when(request('sort') == 'price-desc', fn($q) => $q->orderBy('price', 'desc'))
                    ->paginate(12);

    return view('products', [
        'products'         => $products,
        'categories'       => Category::all(),
        'sizes'            => Sizes::all(),
        'colors'           => Product::distinct()->pluck('color')->filter(),
        'mode'             => 'featured',
        'pageTitle'        => 'Odporúčané produkty',
        'selectedCategory' => null,
        'searchQuery'      => null,
        'activeFilters'    => $activeFilters,
        'priceBounds'      => [
            'min' => $priceMinBound,
            'max' => $priceMaxBound,
        ],
    ]);
})->name('products.featured');

Route::get('/produkty/kategoria/{slug}', function (string $slug) {
    $category = Category::where('name', $slug)->firstOrFail();
    $baseQuery = Product::query()->where('category_id', $category->id);

    $priceMinBound = (int) floor((float) ((clone $baseQuery)->min('price') ?? 0));
    $priceMaxBound = (int) ceil((float) ((clone $baseQuery)->max('price') ?? 100));

    if ($priceMinBound > $priceMaxBound) {
        $priceMinBound = 0;
        $priceMaxBound = 100;
    }

    $selectedPriceMin = max($priceMinBound, (int) request('price_min', $priceMinBound));
    $selectedPriceMax = min($priceMaxBound, (int) request('price_max', $priceMaxBound));

    if ($selectedPriceMin > $selectedPriceMax) {
        [$selectedPriceMin, $selectedPriceMax] = [$selectedPriceMax, $selectedPriceMin];
    }

    $activeFilters = array_merge(
        request()->only(['colors', 'sizes', 'sort']),
        [
            'price_min' => $selectedPriceMin,
            'price_max' => $selectedPriceMax,
        ]
    );

    $products = (clone $baseQuery)
                   ->with('images')
                   ->whereBetween('price', [$selectedPriceMin, $selectedPriceMax])
                   ->when(request('colors'), fn($q) => $q->whereIn('color', request('colors')))
                   ->when(request('sizes'), fn($q) => $q->whereHas('sizes', fn($q) => $q->whereIn('name', request('sizes'))))
                   ->when(request('sort') == 'price-asc', fn($q) => $q->orderBy('price', 'asc'))
                   ->when(request('sort') == 'price-desc', fn($q) => $q->orderBy('price', 'desc'))
                   ->paginate(12);

    return view('products', [
        'products'         => $products,
        'categories'       => Category::all(),
        'sizes'            => Sizes::all(),
        'colors'           => Product::distinct()->pluck('color')->filter(),
        'mode'             => 'category',
        'pageTitle'        => $category->display_name,
        'selectedCategory' => $category,
        'searchQuery'      => null,
        'activeFilters'    => $activeFilters,
        'priceBounds'      => [
            'min' => $priceMinBound,
            'max' => $priceMaxBound,
        ],
    ]);
})->name('products.category');

Route::get('/produkty/hladat/{query}', function (string $query) {
    $baseQuery = Product::query()->where(function ($q) use ($query) {
        $q->where('name', 'ilike', '%' . $query . '%')
          ->orWhere('description', 'ilike', '%' . $query . '%');
    });

    $priceMinBound = (int) floor((float) ((clone $baseQuery)->min('price') ?? 0));
    $priceMaxBound = (int) ceil((float) ((clone $baseQuery)->max('price') ?? 100));

    if ($priceMinBound > $priceMaxBound) {
        $priceMinBound = 0;
        $priceMaxBound = 100;
    }

    $selectedPriceMin = max($priceMinBound, (int) request('price_min', $priceMinBound));
    $selectedPriceMax = min($priceMaxBound, (int) request('price_max', $priceMaxBound));

    if ($selectedPriceMin > $selectedPriceMax) {
        [$selectedPriceMin, $selectedPriceMax] = [$selectedPriceMax, $selectedPriceMin];
    }

    $activeFilters = array_merge(
        request()->only(['colors', 'sizes', 'sort']),
        [
            'price_min' => $selectedPriceMin,
            'price_max' => $selectedPriceMax,
        ]
    );

    $products = (clone $baseQuery)
                       ->with('images')
                       ->whereBetween('price', [$selectedPriceMin, $selectedPriceMax])
                       ->when(request('colors'), fn($q) => $q->whereIn('color', request('colors')))
                       ->when(request('sizes'), fn($q) => $q->whereHas('sizes', fn($q) => $q->whereIn('name', request('sizes'))))
                       ->when(request('sort') == 'price-asc', fn($q) => $q->orderBy('price', 'asc'))
                       ->when(request('sort') == 'price-desc', fn($q) => $q->orderBy('price', 'desc'))
                       ->paginate(12);

    return view('products', [
        'products'         => $products,
        'categories'       => Category::all(),
        'sizes'            => Sizes::all(),
        'colors'           => Product::distinct()->pluck('color')->filter(),
        'mode'             => 'search',
        'pageTitle'        => 'Výsledky: ' . $query,
        'selectedCategory' => null,
        'searchQuery'      => $query,
        'activeFilters'    => $activeFilters,
        'priceBounds'      => [
            'min' => $priceMinBound,
            'max' => $priceMaxBound,
        ],
    ]);
})->name('products.search');

Route::get('/produkty/{id}', function (int $id) {
    $product = Product::with(['images', 'sizes'])->findOrFail($id);
    return view('product-detail', ['product' => $product]);
})->name('product.detail');
/* ────────────────────────────── CART & CHECKOUT ────────────────────────────── */

use App\Http\Controllers\CartController;

Route::get('/kosik', [CartController::class, 'index'])->name('cart');
Route::post('/kosik/pridat', [CartController::class, 'add'])->name('cart.add');
Route::post('/kosik/odstranit', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/kosik/aktualizovat', [CartController::class, 'update'])->name('cart.update');

Route::get('/pokladna/doprava', function () {
    $total = session('cart_total', 0);
    $delivery_method = session('checkout.delivery_method');
    return view('checkout-delivery', compact('total', 'delivery_method'));
})->name('checkout.delivery');

Route::post('/pokladna/doprava', function (Illuminate\Http\Request $request) {
    $request->validate([
        'delivery' => 'required|in:standard,express,pickup'
    ]);
    
    $delivery_methods = [
        'standard' => ['price' => 4.99, 'title' => 'Štandardná doprava'],
        'express' => ['price' => 9.99, 'title' => 'Expresná doprava'],
        'pickup' => ['price' => 0.00, 'title' => 'Osobný odber'],
    ];
    
    session([
        'checkout.delivery_method' => $request->delivery,
        'checkout.delivery_price' => $delivery_methods[$request->delivery]['price'],
        'checkout.delivery_title' => $delivery_methods[$request->delivery]['title']
    ]);
    
    return redirect()->route('checkout.payment');
})->name('checkout.delivery.post');

Route::get('/pokladna/platba', function () {
    $total = session('cart_total', 0);
    $payment_method = session('checkout.payment_method');
    return view('checkout-payment', compact('total', 'payment_method'));
})->name('checkout.payment');

Route::post('/pokladna/platba', function (Illuminate\Http\Request $request) {
    $request->validate([
        'payment' => 'required|in:card,bank,cash'
    ]);
    
    $payment_methods = [
        'card' => ['title' => 'Kreditná/debetná karta'],
        'bank' => ['title' => 'Bankový prevod'],
        'cash' => ['title' => 'Dobierka'],
    ];
    
    session([
        'checkout.payment_method' => $request->payment,
        'checkout.payment_title' => $payment_methods[$request->payment]['title']
    ]);
    
    return redirect()->route('checkout.personal');
})->name('checkout.payment.post');

Route::get('/pokladna/osobne-udaje', function () {
    $total = session('cart_total', 0);
    $personal_data = session('checkout.personal_data', []);
    return view('checkout-personal', compact('total', 'personal_data'));
})->name('checkout.personal');

Route::post('/pokladna/osobne-udaje', function (Illuminate\Http\Request $request) {
    $request->validate([
        'email'       => 'required|email:rfc,dns',
        'phone'       => 'nullable|string|regex:/^[0-9+\-\s()]+$/|max:20',
        'firstName'   => 'required|string|min:2|max:50',
        'lastName'    => 'required|string|min:2|max:50',
        'address'     => 'required|string|min:5|max:100',
        'city'        => 'required|string|min:2|max:50',
        'zip'         => 'required|string|regex:/^\d{3}\s?\d{2}$/',
        'country'     => 'required|string|in:SK,CZ',
        'billingSame' => 'nullable|in:1',
        'newsletter'  => 'nullable|in:1',

        // Billing address — only required when billingSame is NOT checked
        'billing_firstName' => 'required_unless:billingSame,1|nullable|string|min:2|max:50',
        'billing_lastName'  => 'required_unless:billingSame,1|nullable|string|min:2|max:50',
        'billing_address'   => 'required_unless:billingSame,1|nullable|string|min:5|max:100',
        'billing_city'      => 'required_unless:billingSame,1|nullable|string|min:2|max:50',
        'billing_zip'       => 'required_unless:billingSame,1|nullable|string|regex:/^\d{3}\s?\d{2}$/',
        'billing_country'   => 'required_unless:billingSame,1|nullable|string|in:SK,CZ',
    ], [
        'email.required'    => 'Email je povinný.',
        'email.email'       => 'Zadajte platnú emailovú adresu.',
        'phone.regex'       => 'Telefónne číslo môže obsahovať iba čísla, +, -, medzery a zátvorky.',
        'phone.max'         => 'Telefónne číslo môže mať maximálne 20 znakov.',
        'firstName.required' => 'Meno je povinné.',
        'firstName.min'     => 'Meno musí mať aspoň 2 znaky.',
        'firstName.max'     => 'Meno môže mať maximálne 50 znakov.',
        'lastName.required' => 'Priezvisko je povinné.',
        'lastName.min'      => 'Priezvisko musí mať aspoň 2 znaky.',
        'lastName.max'      => 'Priezvisko môže mať maximálne 50 znakov.',
        'address.required'  => 'Adresa je povinná.',
        'address.min'       => 'Adresa musí mať aspoň 5 znakov.',
        'address.max'       => 'Adresa môže mať maximálne 100 znakov.',
        'city.required'     => 'Mesto je povinné.',
        'city.min'          => 'Mesto musí mať aspoň 2 znaky.',
        'city.max'          => 'Mesto môže mať maximálne 50 znakov.',
        'zip.required'      => 'PSČ je povinné.',
        'zip.regex'         => 'PSČ musí byť vo formáte 12345 alebo 123 45.',
        'country.required'  => 'Krajina je povinná.',
        'country.in'        => 'Vyberte platnú krajinu (SK alebo CZ).',

        'billing_firstName.required_unless' => 'Meno (fakturácia) je povinné.',
        'billing_firstName.min'  => 'Meno (fakturácia) musí mať aspoň 2 znaky.',
        'billing_lastName.required_unless'  => 'Priezvisko (fakturácia) je povinné.',
        'billing_lastName.min'   => 'Priezvisko (fakturácia) musí mať aspoň 2 znaky.',
        'billing_address.required_unless'   => 'Fakturačná adresa je povinná.',
        'billing_address.min'    => 'Fakturačná adresa musí mať aspoň 5 znakov.',
        'billing_city.required_unless'      => 'Mesto (fakturácia) je povinné.',
        'billing_city.min'       => 'Mesto (fakturácia) musí mať aspoň 2 znaky.',
        'billing_zip.required_unless'       => 'PSČ (fakturácia) je povinné.',
        'billing_zip.regex'      => 'PSČ (fakturácia) musí byť vo formáte 12345 alebo 123 45.',
        'billing_country.required_unless'   => 'Krajina (fakturácia) je povinná.',
        'billing_country.in'     => 'Vyberte platnú krajinu (SK alebo CZ) pre fakturáciu.',
    ]);

    session(['checkout.personal_data' => $request->only([
        'email', 'phone', 'firstName', 'lastName', 'address', 'city', 'zip', 'country',
        'billingSame', 'newsletter',
        'billing_firstName', 'billing_lastName', 'billing_address',
        'billing_city', 'billing_zip', 'billing_country',
    ])]);

    return redirect()->route('checkout.summary');
})->name('checkout.personal.post');

Route::get('/pokladna/suhrn', function () {
    $total = session('cart_total', 0);
    $checkout_data = session()->get('checkout', []);
    
    // Get cart items
    if (Auth::check()) {
        $items = App\Models\CartItem::with(['product.images', 'size'])
                                 ->where('user_id', Auth::id())
                                 ->get();
    } else {
        $cart = session()->get('cart', []);
        $items = collect($cart)->map(function ($item) {
            $item['product'] = App\Models\Product::with('images')->find($item['product_id']);
            $item['size'] = App\Models\sizes::find($item['size_id']);
            return $item;
        });
    }
    
    return view('checkout-summary', compact('total', 'checkout_data', 'items'));
})->name('checkout.summary');

Route::post('/pokladna/suhrn', [App\Http\Controllers\OrderController::class, 'confirm'])->name('checkout.confirm.post');

Route::get('/pokladna/potvrdenie', function () {
    $orderId = session('last_order_id');
    if (!$orderId) {
        return redirect()->route('home');
    }
    
    $order = App\Models\Order::with('items')->find($orderId);
    if (!$order) {
        return redirect()->route('home');
    }
    
    return view('checkout-confirmation', compact('order'));
})->name('checkout.confirmation');

/* ──────────────────────────────── AUTH (CUSTOMER) ──────────────────────────── */

Route::get('/prihlasenie', function () {
    return view('login');
})->name('login');

Route::get('/registracia', function () {
    return view('register');
})->name('register');

Route::middleware('auth')->get('/profil', function () {
    $orders = App\Models\Order::with('items.product.images')
        ->where('user_id', auth()->id())
        ->orderBy('created_at', 'desc')
        ->get();
    return view('profile', compact('orders'));
})->name('profile');

Route::middleware('auth')->get('/profil/objednavka/{id}', function ($id) {
    $order = App\Models\Order::with('items.product.images')
        ->where('user_id', auth()->id())
        ->where('id', $id)
        ->firstOrFail();
        
    return view('order-detail', compact('order'));
})->name('order.detail');

/* ──────────────────────────────────── ADMIN ────────────────────────────────── */

Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login']);

Route::middleware('auth:admin')->group(function () {
    Route::get('/admin', fn () => redirect()->route('admin.products'));

    Route::get('/admin/products', [ProductController::class, 'adminIndex'])->name('admin.products');

    Route::post('/admin/products', [ProductController::class, 'store'])
        ->name('products.store');

    Route::post('/admin/products/{id}', [ProductController::class, 'update'])->name('products.update');

    Route::delete('/admin/products/{id}', [ProductController::class, 'destroy'])->name('admin.products.destroy');

    Route::get('/admin/orders', fn () => view('admin-orders',['hideLogout' => false]))
        ->name('admin.orders');

    Route::get('/admin/categories', fn () => view('admin-categories', ['hideLogout' => false]))
        ->name('admin.categories');
});

Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

require __DIR__.'/auth.php';

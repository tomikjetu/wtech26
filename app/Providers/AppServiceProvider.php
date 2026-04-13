<?php

namespace App\Providers;

use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $cartCount = Auth::check()
                ? CartItem::where('user_id', Auth::id())->sum('quantity')
                : collect(session()->get('cart', []))->sum('quantity');

            $view->with('cartCount', $cartCount);
        });
    }
}

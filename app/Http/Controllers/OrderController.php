<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function confirm(Request $request)
    {
        // Get checkout data from session
        $checkoutData = session('checkout', []);
        $cartTotal = session('cart_total', 0);
        
        // Validate that we have all required data
        if (empty($checkoutData['personal_data']) || !isset($checkoutData['delivery_method'])) {
            return redirect()->route('checkout.summary')->with('error', 'Chýbajú údaje pre dokončenie objednávky.');
        }

        // Get cart items
        if (Auth::check()) {
            $cartItems = CartItem::with(['product', 'size'])
                                ->where('user_id', Auth::id())
                                ->get();
        } else {
            $cart = session()->get('cart', []);
            $cartItems = collect($cart)->map(function ($item) {
                $item['product'] = \App\Models\Product::find($item['product_id']);
                $item['size'] = \App\Models\sizes::find($item['size_id']);
                return $item;
            });
        }

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Váš košík je prázdny.');
        }

        DB::transaction(function () use ($checkoutData, $cartTotal, $cartItems) {
            $personalData = $checkoutData['personal_data'];
            
            // Create the order
            $order = Order::create([
                'user_id' => Auth::id(),
                'status' => 'confirmed',
                'subtotal' => $cartTotal,
                'delivery_price' => $checkoutData['delivery_price'] ?? 0,
                'total_amount' => $cartTotal + ($checkoutData['delivery_price'] ?? 0),
                'delivery_method' => $checkoutData['delivery_method'],
                'delivery_title' => $checkoutData['delivery_title'],
                'payment_method' => $checkoutData['payment_method'],
                'payment_title' => $checkoutData['payment_title'],
                'customer_email' => $personalData['email'],
                'customer_phone' => $personalData['phone'] ?? null,
                'customer_first_name' => $personalData['firstName'],
                'customer_last_name' => $personalData['lastName'],
                'customer_address' => $personalData['address'],
                'customer_city' => $personalData['city'],
                'customer_zip' => $personalData['zip'],
                'customer_country' => $personalData['country'],
                'billing_same' => isset($personalData['billingSame']),
                'newsletter'  => isset($personalData['newsletter']),
                'billing_first_name' => isset($personalData['billingSame']) ? null : ($personalData['billing_firstName'] ?? null),
                'billing_last_name'  => isset($personalData['billingSame']) ? null : ($personalData['billing_lastName'] ?? null),
                'billing_address'    => isset($personalData['billingSame']) ? null : ($personalData['billing_address'] ?? null),
                'billing_city'       => isset($personalData['billingSame']) ? null : ($personalData['billing_city'] ?? null),
                'billing_zip'        => isset($personalData['billingSame']) ? null : ($personalData['billing_zip'] ?? null),
                'billing_country'    => isset($personalData['billingSame']) ? null : ($personalData['billing_country'] ?? null),
            ]);

            // Create order items
            foreach ($cartItems as $item) {
                $product = Auth::check() ? $item->product : $item['product'];
                $size = Auth::check() ? $item->size : $item['size'];
                $quantity = Auth::check() ? $item->quantity : $item['quantity'];

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'size_id' => $size?->id,
                    'quantity' => $quantity,
                    'price' => $product->price,
                    'product_name' => $product->name,
                    'product_color' => $product->color,
                    'size_name' => $size?->name,
                ]);
            }

            // Clear cart
            if (Auth::check()) {
                CartItem::where('user_id', Auth::id())->delete();
            } else {
                session()->forget('cart');
            }

            // Clear checkout session data
            session()->forget(['checkout', 'cart_total']);
            
            // Store order ID for confirmation page
            session(['last_order_id' => $order->id]);
        });

        return redirect()->route('checkout.confirmation');
    }
}

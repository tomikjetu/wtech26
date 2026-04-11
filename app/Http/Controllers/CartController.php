<?php

namespace App\Http\Controllers;

session(['total' => 0]);


use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:product,id',
            'size_id'    => 'nullable|exists:sizes,id',
            'quantity'   => 'integer|min:1',
        ]);

        $quantity = $request->quantity ?? 1;

        if (Auth::check()) {
            $item = CartItem::where('user_id', Auth::id())
                            ->where('product_id', $request->product_id)
                            ->where('size_id', $request->size_id)
                            ->first();

            if ($item) {
                $item->increment('quantity', $quantity);
            } else {
                CartItem::create([
                    'user_id'    => Auth::id(),
                    'product_id' => $request->product_id,
                    'size_id'    => $request->size_id,
                    'quantity'   => $quantity,
                ]);
            }
        } else {
            $cart = session()->get('cart', []);
            $key  = $request->product_id . '_' . $request->size_id;

            if (isset($cart[$key])) {
                $cart[$key]['quantity'] += $quantity;
            } else {
                $cart[$key] = [
                    'product_id' => $request->product_id,
                    'size_id'    => $request->size_id,
                    'quantity'   => $quantity,
                ];
            }

            session()->put('cart', $cart);
        }

        // Recalculate total
        $this->updateCartTotal();

        return redirect()->back()->with('success', 'Produkt pridaný do košíka.');
    }

    public function index()
    {
        if (Auth::check()) {
            $items = CartItem::with(['product', 'size'])
                             ->where('user_id', Auth::id())
                             ->get();
        } else {
            $cart  = session()->get('cart', []);
            $items = collect($cart)->map(function ($item) {
                $item['product'] = Product::find($item['product_id']);
                $item['size']    = \App\Models\sizes::find($item['size_id']);
                return $item;
            });
        }

        // Calculate total and store in session
        $total = collect($items)->sum(function($item) {
            $product = Auth::check() ? $item->product : $item['product'];
            $qty     = Auth::check() ? $item->quantity : $item['quantity'];
            return $product->price * $qty;
        });
        session(['cart_total' => $total]);

        return view('cart', compact('items'));
    }

    public function remove(Request $request)
    {
        if (Auth::check()) {
            CartItem::where('user_id', Auth::id())
                    ->where('id', $request->item_id)
                    ->delete();
        } else {
            $cart = session()->get('cart', []);
            unset($cart[$request->key]);
            session()->put('cart', $cart);
        }

        // Recalculate total
        $this->updateCartTotal();

        return redirect()->back()->with('success', 'Produkt odstránený.');
    }

    public function update(Request $request)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);

        if (Auth::check()) {
            CartItem::where('user_id', Auth::id())
                    ->where('id', $request->item_id)
                    ->update(['quantity' => $request->quantity]);
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$request->key])) {
                $cart[$request->key]['quantity'] = $request->quantity;
                session()->put('cart', $cart);
            }
        }

        // Recalculate total
        $this->updateCartTotal();

        return redirect()->back();
    }

    private function updateCartTotal()
    {
        if (Auth::check()) {
            $items = CartItem::with(['product'])
                             ->where('user_id', Auth::id())
                             ->get();
        } else {
            $cart  = session()->get('cart', []);
            $items = collect($cart)->map(function ($item) {
                $item['product'] = Product::find($item['product_id']);
                return $item;
            });
        }

        $total = collect($items)->sum(function($item) {
            $product = Auth::check() ? $item->product : $item['product'];
            $qty     = Auth::check() ? $item->quantity : $item['quantity'];
            return $product->price * $qty;
        });

        session(['cart_total' => $total]);
    }

    public static function transferSessionCartToUser($userId)
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return;
        }

        foreach ($cart as $item) {
            $existingItem = CartItem::where('user_id', $userId)
                                    ->where('product_id', $item['product_id'])
                                    ->where('size_id', $item['size_id'])
                                    ->first();

            if ($existingItem) {
                $existingItem->increment('quantity', $item['quantity']);
            } else {
                CartItem::create([
                    'user_id'    => $userId,
                    'product_id' => $item['product_id'],
                    'size_id'    => $item['size_id'],
                    'quantity'   => $item['quantity'],
                ]);
            }
        }

        // Clear session cart after transfer
        session()->forget('cart');
    }
}
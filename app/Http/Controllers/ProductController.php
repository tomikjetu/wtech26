<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $products = Product::with('images')->paginate(12);
    $categories = Category::all();
    return view('index', compact('products', 'categories'));
}

public function adminIndex()
    {
        $products = Product::with(['images', 'category'])->get();
        $categories = Category::all();
        return view('admin-products', compact('products', 'categories'))->with('hideLogout', false);
    }

public function destroy(string $id)
{
    Product::findOrFail($id)->delete();
    return response()->json(['success' => true]);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer|min:0',
            'sale_percent' => 'nullable|integer|min:0|max:100',
            ]);

        Product::create($validatedData);

        return redirect()->route('admin.products')->with('success', 'Produkt bol úspešne přidán.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\sizes as Size;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('images')->paginate(12);
        $categories = Category::all();
        return view('index', compact('products', 'categories'));
    }

    public function adminIndex()
    {
        $products = Product::with(['images', 'category', 'sizes'])->get();
        $categories = Category::all();
        $sizes = Size::orderBy('id')->get();
        return view('admin-products', compact('products', 'categories', 'sizes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'description'  => 'nullable|string',
            'price'        => 'required|numeric|min:0',
            'category_id'  => 'required|exists:categories,id',
            'stock'        => 'required|integer|min:0',
            'sale_percent' => 'nullable|integer|min:0|max:100',
            'color'        => 'nullable|string|max:100',
            'sizes'        => 'nullable|array',
            'sizes.*'      => 'integer|exists:sizes,id',
            'photos'       => 'nullable|array',
            'photos.*'     => 'image|mimes:jpg,jpeg,png,webp,gif|max:5120',
        ]);

        $product = Product::create([
            'name'         => $validated['name'],
            'description'  => $validated['description'] ?? null,
            'price'        => $validated['price'],
            'category_id'  => $validated['category_id'],
            'stock'        => $validated['stock'],
            'sale_percent' => $validated['sale_percent'] ?? 0,
            'color'        => $validated['color'] ?? null,
        ]);

        if (!empty($validated['sizes'])) {
            $product->sizes()->sync($validated['sizes']);
        }

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $i => $photo) {
                $filename = time() . '_' . $i . '.' . $photo->getClientOriginalExtension();
                $photo->move(public_path('images/products'), $filename);
                $product->images()->create([
                    'path'       => 'images/products/' . $filename,
                    'sort_order' => $i,
                ]);
            }
        }

        if ($request->wantsJson()) {
            $product->load(['images', 'category', 'sizes']);
            return response()->json(['success' => true]);
        }

        return redirect()->route('admin.products')->with('success', 'Produkt bol úspešne pridaný.');
    }

    public function update(Request $request, string $id)
    {
        $product = Product::with(['images', 'sizes'])->findOrFail($id);

        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'description'     => 'nullable|string',
            'price'           => 'required|numeric|min:0',
            'category_id'     => 'required|exists:categories,id',
            'stock'           => 'required|integer|min:0',
            'sale_percent'    => 'nullable|integer|min:0|max:100',
            'color'           => 'nullable|string|max:100',
            'sizes'           => 'nullable|array',
            'sizes.*'         => 'integer|exists:sizes,id',
            'photos'          => 'nullable|array',
            'photos.*'        => 'image|mimes:jpg,jpeg,png,webp,gif|max:5120',
            'remove_images'   => 'nullable|array',
            'remove_images.*' => 'integer',
        ]);

        $product->update([
            'name'         => $validated['name'],
            'description'  => $validated['description'] ?? null,
            'price'        => $validated['price'],
            'category_id'  => $validated['category_id'],
            'stock'        => $validated['stock'],
            'sale_percent' => $validated['sale_percent'] ?? 0,
            'color'        => $validated['color'] ?? null,
        ]);

        $product->sizes()->sync($validated['sizes'] ?? []);

        if (!empty($validated['remove_images'])) {
            foreach ($validated['remove_images'] as $imageId) {
                $image = $product->images()->find($imageId);
                if ($image) {
                    $fullPath = public_path($image->path);
                    if (file_exists($fullPath)) {
                        @unlink($fullPath);
                    }
                    $image->delete();
                }
            }
        }

        if ($request->hasFile('photos')) {
            $maxOrder = $product->images()->max('sort_order') ?? -1;
            foreach ($request->file('photos') as $i => $photo) {
                $filename = time() . '_' . $i . '.' . $photo->getClientOriginalExtension();
                $photo->move(public_path('images/products'), $filename);
                $product->images()->create([
                    'path'       => 'images/products/' . $filename,
                    'sort_order' => $maxOrder + $i + 1,
                ]);
            }
        }

        $product->load(['images', 'category', 'sizes']);

        return response()->json([
            'success' => true,
            'product' => [
                'id'           => $product->id,
                'name'         => $product->name,
                'price'        => number_format((float) $product->price, 2),
                'stock'        => $product->stock,
                'category'     => $product->category->display_name,
                'sale_percent' => $product->sale_percent,
                'image'        => $product->images->first()?->path,
            ],
        ]);
    }

    public function destroy(string $id)
    {
        Product::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }

    public function create() {}
    public function show(string $id) {}
    public function edit(string $id) {}
}

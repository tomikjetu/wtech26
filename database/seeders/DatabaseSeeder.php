<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Sizes;
use App\Models\ProductImage;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'email' => 'test@example.com',
        ]);

        Admin::create([
            'name' => 'Super Admin',
            'email' => 'admin@trickohouse.sk',
            'password' => 'password123',
            'level' => 2,
        ]);

        $categoryMap = [];
        $categories = [
            ['name' => 'men', 'display_name' => 'Muži'],
            ['name' => 'women', 'display_name' => 'Ženy'],
            ['name' => 'clothing', 'display_name' => 'Oblečenie'],
            ['name' => 'shoes', 'display_name' => 'Topánky'],
            ['name' => 'sale', 'display_name' => 'Výpredaj'],
            ['name' => 'accessories', 'display_name' => 'Doplnky'],
        ];

        foreach ($categories as $categoryData) {
            $category = Category::updateOrCreate(
                ['name' => $categoryData['name']],
                ['display_name' => $categoryData['display_name']]
            );
            $categoryMap[$categoryData['name']] = $category->id;
        }

        $sizeIds = [];
        foreach (['XS', 'S', 'M', 'L', 'XL', 'XXL'] as $sizeName) {
            $sizeIds[] = Sizes::updateOrCreate(['name' => $sizeName], [])->id;
        }

        $allImages = [
            'images/products/shirt.jpg',
            'images/products/shirt-2.jpg',
            'images/products/hoodie.jpg',
            'images/products/sweater.jpg',
            'images/products/bag.jpg',
        ];

        $colors = ['Biela', 'Čierna', 'Šedá', 'Modrá', 'Červená', 'Zelená', 'Béžová'];

        $categoryPresets = [
            'men' => [
                'names' => ['Pánske Core', 'Pánske Street', 'Pánske Basic', 'Pánske Active', 'Pánske Relax'],
                'price_min' => 18,
                'price_max' => 48,
                'sale_max' => 25,
            ],
            'women' => [
                'names' => ['Dámske Soft', 'Dámske Fit', 'Dámske Urban', 'Dámske Elegant', 'Dámske Comfort'],
                'price_min' => 17,
                'price_max' => 45,
                'sale_max' => 30,
            ],
            'clothing' => [
                'names' => ['Mikina Urban', 'Mikina Heavy', 'Tepláky Motion', 'Šortky Summer', 'Bunda Light'],
                'price_min' => 22,
                'price_max' => 95,
                'sale_max' => 25,
            ],
            'shoes' => [
                'names' => ['Tenisky Runner', 'Tenisky Classic', 'Tenisky Urban', 'Topánky Trail', 'Slip-on City'],
                'price_min' => 39,
                'price_max' => 139,
                'sale_max' => 20,
            ],
            'sale' => [
                'names' => ['Výpredaj Extra', 'Výpredaj Limit', 'Výpredaj Mix', 'Výpredaj Daily', 'Výpredaj Flash'],
                'price_min' => 10,
                'price_max' => 65,
                'sale_max' => 70,
            ],
            'accessories' => [
                'names' => ['Čiapka Logo', 'Taška Canvas', 'Opasok Basic', 'Ponožky Pack', 'Šiltovka Pro'],
                'price_min' => 8,
                'price_max' => 39,
                'sale_max' => 35,
            ],
        ];

        $productsPerCategory = 42;

        foreach ($categoryPresets as $categorySlug => $preset) {
            for ($i = 1; $i <= $productsPerCategory; $i++) {
                $namePrefix = $preset['names'][($i - 1) % count($preset['names'])];
                $name = $namePrefix . ' ' . str_pad((string) $i, 2, '0', STR_PAD_LEFT);

                $price = mt_rand((int) ($preset['price_min'] * 100), (int) ($preset['price_max'] * 100)) / 100;
                $salePercent = mt_rand(0, 100) > 65 ? mt_rand(5, $preset['sale_max']) : 0;

                $product = Product::create([
                    'name' => $name,
                    'category_id' => $categoryMap[$categorySlug],
                    'price' => $price,
                    'description' => $name . ' z kolekcie TrickoHouse s dôrazom na pohodlie a štýl.',
                    'stock' => mt_rand(20, 250),
                    'color' => $colors[array_rand($colors)],
                    'sale_percent' => $salePercent,
                ]);

                shuffle($sizeIds);
                $product->sizes()->attach(array_slice($sizeIds, 0, mt_rand(3, count($sizeIds))));

                $pickedImages = collect($allImages)->shuffle()->take(2)->values();
                foreach ($pickedImages as $order => $path) {
                    ProductImage::create([
                        'product_id' => $product->id,
                        'path' => $path,
                        'sort_order' => $order,
                    ]);
                }
            }
        }
    }
}

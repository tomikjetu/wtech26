<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\sizes;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'email' => 'test@example.com',
        ]);

        Admin::create([
        'name'     => 'Super Admin',
        'email'    => 'admin@trickohouse.sk',
        'password' => 'password123',
        'level'    => 2,
        ]);

        Category::create(['name' => 'men',         'display_name' => 'Muži']);
        Category::create(['name' => 'women',       'display_name' => 'Ženy']);
        Category::create(['name' => 'clothing',    'display_name' => 'Oblečenie']);
        Category::create(['name' => 'shoes',       'display_name' => 'Topánky']);
        Category::create(['name' => 'sale',        'display_name' => 'Výpredaj']);
        Category::create(['name' => 'accessories', 'display_name' => 'Doplnky']);

        $product = $product = Product::create([
        'name' => 'TrickoHouse Core', 'category_id' => 1, 'price' => 24.99, 'description' => 'Základné tričko pre každodenné nosenie.', 'stock' => 100, 'color' => 'Biela', 'sale_percent' => 0
        ]);

        $colors = ['Biela', 'Čierna', 'Šedá', 'Modrá', 'Červená'];

$products = [
    ['name' => 'TrickoHouse Classic', 'category_id' => 1, 'price' => 27.99, 'description' => 'Klasické tričko s prémiovou bavlnou.', 'stock' => 80, 'color' => 'Čierna', 'sale_percent' => 0],
    ['name' => 'TrickoHouse Slim', 'category_id' => 1, 'price' => 29.99, 'description' => 'Slim fit tričko pre moderný vzhľad.', 'stock' => 60, 'color' => 'Šedá', 'sale_percent' => 10],
    ['name' => 'TrickoHouse Sport', 'category_id' => 1, 'price' => 34.99, 'description' => 'Športové tričko s odvlhčovacou technológiou.', 'stock' => 50, 'color' => 'Modrá', 'sale_percent' => 0],
    ['name' => 'TrickoHouse Vintage', 'category_id' => 1, 'price' => 32.99, 'description' => 'Retro štýlové tričko s vintage potlačou.', 'stock' => 40, 'color' => 'Červená', 'sale_percent' => 15],

    ['name' => 'Dámske Basic', 'category_id' => 2, 'price' => 22.99, 'description' => 'Jednoduché dámske tričko zo 100% bavlny.', 'stock' => 90, 'color' => 'Biela', 'sale_percent' => 0],
    ['name' => 'Dámske Crop Top', 'category_id' => 2, 'price' => 26.99, 'description' => 'Moderný crop top pre letné dni.', 'stock' => 70, 'color' => 'Červená', 'sale_percent' => 0],
    ['name' => 'Dámske Oversize', 'category_id' => 2, 'price' => 31.99, 'description' => 'Oversize tričko pre pohodlný štýl.', 'stock' => 55, 'color' => 'Šedá', 'sale_percent' => 20],
    ['name' => 'Dámske Floral', 'category_id' => 2, 'price' => 28.99, 'description' => 'Tričko s kvetinovou potlačou.', 'stock' => 45, 'color' => 'Biela', 'sale_percent' => 0],
    ['name' => 'Dámske Elegant', 'category_id' => 2, 'price' => 35.99, 'description' => 'Elegantné dámske tričko na špeciálne príležitosti.', 'stock' => 30, 'color' => 'Čierna', 'sale_percent' => 0],

    ['name' => 'Mikina Hoodie', 'category_id' => 3, 'price' => 49.99, 'description' => 'Teplá mikina s kapucňou pre chladné dni.', 'stock' => 60, 'color' => 'Šedá', 'sale_percent' => 0],
    ['name' => 'Mikina Zip', 'category_id' => 3, 'price' => 54.99, 'description' => 'Mikina na zips s vreckami.', 'stock' => 50, 'color' => 'Čierna', 'sale_percent' => 10],
    ['name' => 'Tepláky Slim', 'category_id' => 3, 'price' => 39.99, 'description' => 'Slim fit tepláky pre pohodlie aj štýl.', 'stock' => 70, 'color' => 'Šedá', 'sale_percent' => 0],
    ['name' => 'Šortky Summer', 'category_id' => 3, 'price' => 29.99, 'description' => 'Ľahké šortky na leto.', 'stock' => 80, 'color' => 'Modrá', 'sale_percent' => 0],

    ['name' => 'Tenisky Classic', 'category_id' => 4, 'price' => 69.99, 'description' => 'Klasické tenisky pre každodenné nosenie.', 'stock' => 40, 'color' => 'Biela', 'sale_percent' => 0],
    ['name' => 'Tenisky Sport', 'category_id' => 4, 'price' => 84.99, 'description' => 'Športové tenisky s extra tlmením.', 'stock' => 35, 'color' => 'Čierna', 'sale_percent' => 15],

    ['name' => 'Tričko Výpredaj', 'category_id' => 5, 'price' => 14.99, 'description' => 'Výpredajové tričko za skvelú cenu.', 'stock' => 200, 'color' => 'Červená', 'sale_percent' => 50],
    ['name' => 'Mikina Výpredaj', 'category_id' => 5, 'price' => 29.99, 'description' => 'Výpredajová mikina so zľavou.', 'stock' => 100, 'color' => 'Šedá', 'sale_percent' => 40],

    ['name' => 'Čiapka Logo', 'category_id' => 6, 'price' => 19.99, 'description' => 'Čiapka s logom TrickoHouse.', 'stock' => 150, 'color' => 'Čierna', 'sale_percent' => 0],
    ['name' => 'Taška TrickoHouse', 'category_id' => 6, 'price' => 24.99, 'description' => 'Plátená taška s potlačou.', 'stock' => 120, 'color' => 'Biela', 'sale_percent' => 0],
];

    Sizes::create(['name' => 'XS']);
        Sizes::create(['name' => 'S']);
        Sizes::create(['name' => 'M']);
        Sizes::create(['name' => 'L']);
        Sizes::create(['name' => 'XL']);
        Sizes::create(['name' => 'XXL']);

        $product->sizes()->attach([1, 2, 3, 4]); // XS, S, M, L

foreach ($products as $data) {
    $product = Product::create($data);
    $product->sizes()->attach([1, 2, 3, 4]); // XS, S, M, L
}

    

        
    }
}

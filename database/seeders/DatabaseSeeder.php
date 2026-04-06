<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

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

        Product::create([
        'name' => 'TrickoHouse Core',
        'price' => 24.99,
        'description' => 'A basic core t-shirt.',
        'stock' => 100,
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'category_id' => 1,
            'name' => 'iPhone 15 Pro',
            'image' => null,
            'price' => 1099.99,
            'stock' => 20,
            'is_active' => true,
        ]);

        Product::create([
            'category_id' => 2,
            'name' => 'MacBook Pro M3',
            'image' => null,
            'price' => 1999.99,
            'stock' => 14,
            'is_active' => true,
        ]);

        Product::create([
            'category_id' => 3,
            'name' => 'Wireless Earbuds',
            'image' => null,
            'price' => 149.99,
            'stock' => 50,
            'is_active' => true,
        ]);
    }
}

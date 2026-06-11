<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Create some sample categories
        Category::create([
            'name' => 'Mobile',
            'description' => 'mobile description',
            'is_active' => true,
        ]);

        Category::create([
            'name' => 'Laptop',
            'description' => 'laptop description',
            'is_active' => true,
        ]);

        Category::create([
            'name' => 'Accessories',
            'description' => 'phone and laptop accessories',
            'is_active' => true,
        ]);
    }
}

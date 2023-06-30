<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Salary',
            'type' => 'income',
            'category_id' => null,
            'country_id' => 1,
        ]);
        Category::create([
            'name' => 'Trio International',
            'type' => 'income',
            'category_id' => 1,
            'country_id' => 1,
        ]);
        Category::create([
            'name' => 'Home',
            'type' => 'expense',
            'category_id' => null,
            'country_id' => 1,
        ]);
        Category::create([
            'name' => 'Super Market',
            'type' => 'expense',
            'category_id' => 3,
            'country_id' => 1,
        ]);
        Category::create([
            'name' => 'Bakala',
            'type' => 'expense',
            'category_id' => 3,
            'country_id' => 1,
        ]);
        Category::create([
            'name' => 'Car',
            'type' => 'expense',
            'category_id' => null,
            'country_id' => 1,
        ]);
        
    }
}

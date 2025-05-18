<?php

namespace Database\Seeders;

use App\Models\CategoryModel;
use App\Models\ProductModel;
use Database\Factories\ProductFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = CategoryModel::all();

        foreach ($categories as $category) {
            ProductModel::create([
                'name' => fake()->words(2, true),
                'description' => fake()->sentence(),
                'price' => fake()->randomFloat(2, 10, 1000),
                'stock' => fake()->numberBetween(1, 100),
                'category_id' => $category->id,
            ]);
        }
    }
}

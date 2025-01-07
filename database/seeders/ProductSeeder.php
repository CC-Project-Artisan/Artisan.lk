<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $users = User::all();
        $categories = Category::all();

        foreach(range(1, 20) as $index) {
            Product::create([
                'user_id' => $users->random()->id,
                'productName' => $faker->words(3, true),
                'productDescription' => $faker->paragraph,
                'productPrice' => $faker->numberBetween(100, 10000),
                'productQuantity' => $faker->numberBetween(1, 100),
                'productImages' => json_encode(['default.jpg']),
                'weight' => $faker->randomFloat(2, 0.1, 10),
                'dimensions' => $faker->numberBetween(10, 100) . 'x' . $faker->numberBetween(10, 100),
                'category_id' => $categories->random()->id
            ]);
        }
    }
}
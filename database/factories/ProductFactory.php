<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Vendor;
use App\Models\Brand;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
   
     public function definition(): array
     {
         $faker = \Faker\Factory::create();
 
         $category = Category::all()->isNotEmpty() ? Category::all()->random()->id : null;
         $brand = Brand::all()->isNotEmpty() ? Brand::all()->random()->id : null;
 
         return [
             'slug' => $faker->unique()->slug,
             'name' => $faker->word,
             'description' => $faker->paragraph,
             'price' => $faker->randomFloat(2, 0, 9999),
             'quantity' => $faker->numberBetween(0, 100),
             'sku' => $faker->unique()->randomNumber(),
             'manage_stock' => $faker->randomElement([0, 1]),
             'is_available' => $faker->randomElement([0, 1]),
             'image' => $faker->imageUrl(),
             'qty' => $faker->randomNumber(),
             'in_stock' => $faker->randomElement([0, 1]),
             'category_id' => $category,
             'brand_id' => $brand,
             'is_active' => $faker->randomElement([0, 1]),
             'created_at' => now(),
             'updated_at' => now(),
         ];
     }
}

<?php

namespace Database\Factories;
use App\Models\Category;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */        

     protected $model = Category::class;

     public function definition()
     {
        $faker = \Faker\Factory::create();
         $parentCategory = Category::inRandomOrder()->first(); // Get a random parent category
 
         return [
             'name' => $this->faker->word,
             'description' => $this->faker->paragraph,
             'parent_id' => $parentCategory ? $parentCategory->id : null, // Set the parent_id to the ID of the parent category or null if no parent category exists
         ];
     }
}

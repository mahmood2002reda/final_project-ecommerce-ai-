<?php

namespace Database\Factories;

use Faker\Generator as Faker;
use App\Models\Brand;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    protected $model = Brand::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word,
            'active' => $this->faker->randomElement(['0', '1']),
            'vendor_id' => function () {
                return Vendor::factory()->create()->id;
            },
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
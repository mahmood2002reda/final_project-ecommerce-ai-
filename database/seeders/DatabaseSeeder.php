<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\brand;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
     //   $this->call(AdminSeeder::class);
        //$this->call(VendorSeeder::class);
      //  \App\Models\Vendor::factory()->count(5)->create();
      Vendor::factory()->count(5)->create();
        Category::factory()->count(5)->create();
        
        brand::factory()->count(5)->create();
        Product::factory()->count(5)->create();


    }
}

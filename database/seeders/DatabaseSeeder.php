<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Color;
use App\Models\Size;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
         // OrdersTableSeeder::class,
           OrderItemsTableSeeder::class,
           UsersTableSeeder::class,
          VendorTableSeeder::class,
         AdminTableSeeder::class,
         VendorSeeder::class,


        ]);

       // \App\Models\User::factory(10)->create();

        // \App\Models\User::create([
        //     'name' => 'user',
        //     'email' => 'user@example.com',
        //     'password'=> bcrypt('123456789'),
        // ]);



    }
}

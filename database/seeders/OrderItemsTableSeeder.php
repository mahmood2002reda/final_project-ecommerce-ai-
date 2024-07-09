<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('orderitems')->insert([
                'order_id' => $i,
                'product_id' => $i,
                'product_color_id' => null,
                'quantity' => $i,
                'price' => 100 * $i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

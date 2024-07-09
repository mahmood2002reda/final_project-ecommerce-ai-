<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        for ($i = 1; $i <= 10; $i++) {
            DB::table('orders')->insert([
                'user_id' => $i,
                'tracking_no' => '123456-' . $i,
                'fullname' => 'John Doe ' . $i,
                'email' => 'john' . $i . '@example.com',
                'pincode' => '12345' . $i,
                'address' => $i . ' Main St',
                'phone' =>  '0102891013'.$i ,
                'status_message' => 'Pending',
                'payment_mode' => 'Credit Card',
                'payment_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

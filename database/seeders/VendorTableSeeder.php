<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VendorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $vendors = [];

        for ($i = 1; $i <= 4; $i++) {
            $vendors[] = [
                'name' => 'Vendor ' . $i,
                'email' => 'vendor' . $i . '@example.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'remember_token' => Str::random(4),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('vendors')->insert($vendors);

    }
}

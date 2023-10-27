<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('vendors')->insert([
            'name' => 'Vendor 1',
            'email' => 'vendor1@gemail.com',
            'password' => Hash::make('12345678'),
            // Add more data as required
        ]);
    }
}


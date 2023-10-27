<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('admins')->insert([
            'name' => 'admin 1',
            'email' => 'admin1@gmail.com',
            'password' => Hash::make('12345678'),
            // Add more data as required
        ]);
        DB::table('admins')->insert([
            'name' => 'admin2',
            'email' => 'admin2@gmail.com',
            'password' => Hash::make('123456789'),
            // Add more data as required
        ]);
    }
}

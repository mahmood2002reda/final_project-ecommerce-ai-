<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Admins = [];



        DB::table('admins')->insert(
            [
            'name' => 'admin1 ' ,
            'email' => 'admin1'  . '@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password1234'),
            'remember_token' => Str::random(4),
            'created_at' => now(),
            'updated_at' => now(),
        ],
        // [
        //     'name' => 'admin2 ' ,
        //     'email' => 'admin2'  . '@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('password15678'),
        //     'remember_token' => Str::random(4),
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ],
    );
        //
    }
}

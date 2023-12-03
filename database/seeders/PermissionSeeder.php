<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $permessions=[
            
           'add_product',
           'edit_product',
           'show_product',
           'delete_product',



        ];

           foreach($permessions as $permession){

               Permission::updateOrCreate(['name'=>$permession],[
                
                'name'=>$permession,
                'guard_name'=>'admin']);




           }





    }
}

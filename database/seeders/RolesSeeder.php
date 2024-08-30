<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //admin=1,user=2
        DB::table('roles')->insert([
            'name'=>'admin'
        ]);
        DB::table('roles')->insert([
            'name'=>'user'
        ]);
    }
}

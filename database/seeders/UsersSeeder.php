<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Carbon\Carbon;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //USERS SEED
        DB::table('users')->insert([
            'email'=>'laravelmejl321@gmail.com',
            'password'=>Hash::make('Laravel123'),
            'first_name'=>'Admin',
            'last_name'=>'Electro',
            'phone'=>'0631234567',
            'role_id'=>1
        ]);
        DB::table('users')->insert([
            'email'=>'user@test.com',
            'password'=>Hash::make('Test123'),
            'first_name'=>'Test',
            'last_name'=>'User',
            'phone'=>'0631234567',
            'role_id'=>2
        ]);

        //USER ADDRESS AND USER CARD SEED
        $faker=Faker::create();
        DB::table('user_address')->insert([
            'user_id'=>2,
            'address_line'=>$faker->address(),
            'city'=>$faker->city(),
            'postal_code'=>'3238764',
            'country'=>$faker->country()
        ]);
        DB::table('user_cards')->insert([
            'user_id'=>2,
            'card_number'=>$faker->creditCardNumber(),
            'expiry_date'=>Carbon::create('2026','01','01')
        ]);
    }
}

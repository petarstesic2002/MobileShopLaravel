<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('order_sessions')->insert([
            'user_id'=>2,
            'total'=>1060,
            'card_id'=>1
        ]);
        DB::table('order_items')->insert([
            'product_id'=>4,
            'order_id'=>1,
            'price_id'=>7,
            'quantity'=>1
        ]);
        DB::table('order_items')->insert([
            'product_id'=>5,
            'order_id'=>1,
            'price_id'=>9,
            'quantity'=>1
        ]);

        DB::table('order_sessions')->insert([
            'user_id'=>2,
            'total'=>1060,
            'card_id'=>1
        ]);
        DB::table('order_items')->insert([
            'product_id'=>4,
            'order_id'=>2,
            'price_id'=>7,
            'quantity'=>1
        ]);
        DB::table('order_items')->insert([
            'product_id'=>5,
            'order_id'=>2,
            'price_id'=>9,
            'quantity'=>1
        ]);
    }
}

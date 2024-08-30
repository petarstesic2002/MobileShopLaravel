<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //CATEGORIES SEED
        $categories=['Laptops','Smartphones','Cameras','Accessories'];
        foreach ($categories as $c) {
            DB::table('categories')->insert([
                'name'=>$c
            ]);
        }

        //BRANDS SEED
        $brands=['Lenovo','Asus','Acer','Dell','Samsung','Xiaomi','Canon','Razer','JBL'];
        foreach ($brands as $b) {
            DB::table('brands')->insert([
                'name' => $b,
            ]);
        }

        //DETAILS SEED
        $details=['Screen Size','CPU','GPU','Camera Quality','Sound Range','Cable Length','RAM','Storage'];
        foreach ($details as $d){
            DB::table('details')->insert([
                'name'=>$d
            ]);
        }
        //PRODUCTS SEED
        $products=[
            [
                'name'=>'Latitude 512',
                'image'=>'product01.png',
                'category_id'=>1,
                'brand_id'=>4,
                'prices'=>[
                    999,
                    980
                ],
                'details'=>[
                    1=>'17 inches',
                    2=>'Intel i7 15600K',
                    3=>'Nvidia GTX 1650',
                    7=>'16GB',
                    8=>'1TB'
                ],
                'description'=>"Laptop Dell Latitude 512 built for greatness"
            ],
            [
                'name'=>'Bass General',
                'image'=>'product02.png',
                'category_id'=>4,
                'brand_id'=>9,
                'prices'=>[
                    129.99,
                    109.99
                ],
                'details'=>[
                    5=>'20db-20000db',
                    6=>'2m'
                ],
                'description'=>"Bass General, straight from the battlefield"

            ],
            [
                'name'=>'Ideapad 115',
                'image'=>'product03.png',
                'category_id'=>1,
                'brand_id'=>1,
                'prices'=>[
                    879.99
                ],
                'details'=>[
                    1=>'18 inches',
                    2=>'Intel i5 13600K',
                    3=>'Nvidia GTX 1060',
                    7=>'12GB',
                    8=>'850GB'
                ],
                'description'=>"Lenovo built for greatness"
            ],
            [
                'name'=>'Galaxy Tab 7',
                'image'=>'product04.png',
                'category_id'=>2,
                'brand_id'=>5,
                'prices'=>[
                    999,
                    980
                ],
                'details'=>[
                    1=>'10 inches',
                    4=>'40MP',
                    7=>'8GB',
                    8=>'64GB'
                ],
                'description'=>"Samsung, explore your own galaxy"
            ],
            [
                'name'=>'Soundmaster 5',
                'image'=>'product05.png',
                'category_id'=>4,
                'brand_id'=>8,
                'prices'=>[
                    89.98,
                    80
                ],
                'details'=>[
                    5=>'20db-20000db',
                    6=>'2m'
                ],
                'description'=>"Soundmaster 5, master your sound"
            ],
            [
                'name'=>'Gaming Prodigy',
                'image'=>'product06.png',
                'category_id'=>1,
                'brand_id'=>2,
                'prices'=>[
                    1299
                ],
                'details'=>[
                    1=>'18 inches',
                    2=>'AMD Ryzen 4700X',
                    3=>'Nvidia GTX 4060',
                    7=>'24GB',
                    8=>'2TB'
                ],
                'description'=>"Prepare to not go out for the next two years"
            ],
            [
                'name'=>'Mi 7',
                'image'=>'product07.png',
                'category_id'=>2,
                'brand_id'=>6,
                'prices'=>[
                    999,
                    980
                ],
                'details'=>[
                    1=>'7 inches',
                    4=>'64MP',
                    7=>'6GB',
                    8=>'128GB'
                ],
                'description'=>"Xiaomi. Best price to performance ratio"

            ],
            [
                'name'=>'Aspire 4',
                'image'=>'product08.png',
                'category_id'=>1,
                'brand_id'=>3,
                'prices'=>[
                    978,
                    899
                ],
                'details'=>[
                    1=>'18 inches',
                    2=>'Intel i5 13600K',
                    3=>'Nvidia GTX 1060',
                    7=>'12GB',
                    8=>'850GB'
                ],
                'description'=>"Acer Aspire, find new inspiration"
            ],
            [
                'name'=>'Reality 2',
                'image'=>'product09.png',
                'category_id'=>3,
                'brand_id'=>7,
                'prices'=>[
                    769.99,
                    750
                ],
                'details'=>[
                    4=>'150MP',
                    8=>'50GB'
                ],
                'description'=>"Professional Camera that speaks for itself"
            ],
            [
                'name'=>'Galaxy S8 Ultra',
                'image'=>'product07.png',
                'category_id'=>2,
                'brand_id'=>6,
                'prices'=>[
                    999,
                    980
                ],
                'details'=>[
                    1=>'7 inches',
                    4=>'64MP',
                    7=>'6GB',
                    8=>'128GB'
                ],
                'description'=>"Samsung. Explore your galaxy"

            ],
            [
                'name'=>'Aspire 7',
                'image'=>'product08.png',
                'category_id'=>1,
                'brand_id'=>3,
                'prices'=>[
                    978,
                    899
                ],
                'details'=>[
                    1=>'18 inches',
                    2=>'Intel i5 13600K',
                    3=>'Nvidia GTX 1060',
                    7=>'12GB',
                    8=>'850GB'
                ],
                'description'=>"Acer Aspire, find new inspiration"
            ],
            [
                'name'=>'Zenphone',
                'image'=>'product10.png',
                'category_id'=>2,
                'brand_id'=>2,
                'prices'=>[
                    759,
                    709.99
                ],
                'details'=>[
                    1=>'8 inches',
                    4=>'64MP',
                    7=>'6GB',
                    8=>'128GB'
                ],
                'description'=>"Asus. Reflect your soul"
            ],
            [
                'name'=>'Sunshine 34',
                'image'=>'product09.png',
                'category_id'=>3,
                'brand_id'=>7,
                'prices'=>[
                    769.99,
                    750
                ],
                'details'=>[
                    4=>'150MP',
                    8=>'50GB'
                ],
                'description'=>"Professional Camera that speaks for itself"
            ],
            [
                'name'=>'Soundmaster 7',
                'image'=>'product11.png',
                'category_id'=>4,
                'brand_id'=>8,
                'prices'=>[
                    129.98,
                    90
                ],
                'details'=>[
                    5=>'20db-20000db',
                    6=>'2m'
                ],
                'description'=>"Soundmaster 7, master your sound"
            ],
            [
                'name'=>'Unreal 4',
                'image'=>'product12.png',
                'category_id'=>3,
                'brand_id'=>7,
                'prices'=>[
                    769.99,
                    747.99
                ],
                'details'=>[
                    4=>'150MP',
                    8=>'50GB'
                ],
                'description'=>"Professional Camera"
            ],
        ];
        $id=1;
        foreach ($products as $p) {
            DB::table('products')->insert([
                'name'=>$p['name'],
                'image'=>$p['image'],
                'category_id'=>$p['category_id'],
                'brand_id'=>$p['brand_id'],
                'description'=>$p['description']
            ]);
            //Posto se uzima najnovija cena, potrebna je sleep funkcija, jer bi u suprotnom sve imale isto CREATED_AT
            foreach($p['prices'] as $price){
                DB::table('prices')->insert([
                    'product_id'=>$id,
                    'price'=>$price
                ]);
                sleep(0.1);
            }
            foreach($p['details'] as $key=>$d){
                DB::table('product_details')->insert([
                   'product_id'=>$id,
                   'detail_id'=>$key,
                    'detail_value'=>$d
                ]);
            }
            $id++;
        }
    }
}

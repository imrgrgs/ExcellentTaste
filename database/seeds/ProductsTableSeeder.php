<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'category_id' => '1',
        	'name'=> 'Soep',
            'description' => 'Soep van de dag',
            'price' => 4.00
        ]);

        DB::table('products')->insert([
            'category_id' => '1',
            'name'=> 'Gerookte zalm',
            'description' => 'Gerookte zalm op een bedje van basilicum',
            'price' => 8.50
        ]);

        DB::table('products')->insert([
            'category_id' => '1',
            'name'=> 'Carpaccio',
            'description' => 'Licht gezouten carpaccio met schijfjes buffelmozzarella',
            'price' => 9.00
        ]);

        DB::table('products')->insert([
            'category_id' => '1',
            'name'=> 'Buffelmozzarella',
            'description' => 'Buffelmozzarella met tomaat en basilicumpesto',
            'price' => 7.00
        ]);

        DB::table('products')->insert([
            'category_id' => '2',
            'name'=> 'Wienerschnitzel',
            'description' => 'Wienerschnitzel met saus naar keuze',
            'price' => 16.00
        ]);

        DB::table('products')->insert([
            'category_id' => '2',
            'name'=> 'Kaasschnitzel',
            'description' => 'Kaasschnitzel van oude kaas met verse peterselieknoflookpesto',
            'price' => 12.00
        ]);

        DB::table('products')->insert([
            'category_id' => '2',
            'name'=> 'Gerookte kipfilet',
            'description' => 'Gerookte kipfilet met kruidenboter',
            'price' => 16.00
        ]);

        DB::table('products')->insert([
            'category_id' => '2',
            'name'=> 'Tournedos',
            'description' => 'Tournedos met kruidenboter',
            'price' => 23.00
        ]);

        DB::table('products')->insert([
            'category_id' => '3',
            'name'=> 'Macaroni',
            'description' => 'Macaroni met ham en kaas',
            'price' => 8.00
        ]);

        DB::table('products')->insert([
            'category_id' => '3',
            'name'=> 'Pizza Margarita',
            'description' => '',
            'price' => 6.00
        ]);

        DB::table('products')->insert([
            'category_id' => '3',
            'name'=> 'Pizza Flex',
            'description' => 'Met 2 toppings naar keuze: kaas, spek, ham, tomaat, ui en mozzarella',
            'price' => 10.00
        ]);


    }
}

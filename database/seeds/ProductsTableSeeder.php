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
        	'name'=> 'Spagetti', 
            'description' => 'Description placeholder for a product',
            'price' => 10.99
        ]);
        DB::table('products')->insert([
        	'name'=> 'Prij', 
            'description' => 'Description placeholder for a product',
            'price' => 12.49
        ]);
        DB::table('products')->insert([
        	'name'=> 'Courgette', 
            'description' => 'Description placeholder for a product',
            'price' => 7.51
        ]);
        DB::table('products')->insert([
        	'name'=> 'Cola', 
            'description' => 'Description placeholder for a product',
            'price' => 10.11
        ]);
        DB::table('products')->insert([
        	'name'=> 'Sinas', 
            'description' => 'Description placeholder for a product',
            'price' => 9.12
        ]);
        DB::table('products')->insert([
        	'name'=> '7-up', 
            'description' => 'Description placeholder for a product',
            'price' => 1.98
        ]);
        DB::table('products')->insert([
        	'name'=> 'Pannekoek', 
            'description' => 'Description placeholder for a product',
            'price' => 2.89
        ]);
    }
}

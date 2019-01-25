<?php

use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Category::create([
            'name' => 'Voorgerecht',
        ]);

        \App\Category::create([
            'name' => 'Hoofdgerecht',
        ]);

        \App\Category::create([
            'name' => 'Overige hoofdgerechten',
        ]);
    }
}

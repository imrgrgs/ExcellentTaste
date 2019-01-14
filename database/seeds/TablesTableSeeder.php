<?php

use Illuminate\Database\Seeder;

class TablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($x = 0; $x <= 3; $x++)
        {

            \App\Table::create([
                'seat_count' => 2
            ]);
        }

        for ($x = 0; $x <= 7; $x++)
        {

            \App\Table::create([
                'seat_count' => 4
            ]);
        }

        for ($x = 0; $x <= 8; $x++)
        {

            \App\Table::create([
                'seat_count' => 3
            ]);
        }
    }
}

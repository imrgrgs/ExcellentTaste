<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(App\User::class, 50)->create()->each(function ($user) {
            if ($user->id === 1) {
                $user->attachRole('administrator');
            }
        });
    }
}

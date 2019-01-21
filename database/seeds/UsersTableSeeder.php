<?php

use App\User;
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
            $user->number = User::getLastNumber() + 1;
            $user->save();

            if ($user->id === 1) {
                $user->attachRole('administrator');
            }
        });
    }
}

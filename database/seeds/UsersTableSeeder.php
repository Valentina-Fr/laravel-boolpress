<?php

use App\User;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $user = new User();
        $user->name = 'Admin';
        $user->email = 'admin@admin.com';
        $user->password = bcrypt('adminadmin');

        $user->save();

        for($i = 0; $i < 2; $i++){


            $user = new User();
            $user->name = $faker->username();
            $user->email = $faker->email();
            $user->password = bcrypt($faker->password());

            $user->save();

        }


    }
}

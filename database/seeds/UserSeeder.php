<?php

use Illuminate\Database\Seeder;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 5; $i++) { 
            $newUser = new User();

            $newUser->name = $faker->name();
            $newUser->email = $faker->email();
            $myPsw = "ciaociao";
            $newUser->password = Hash::make($myPsw);

            $newUser->save();
        }
    }
}

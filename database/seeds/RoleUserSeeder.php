<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Model\Role;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $users = User::all();

        foreach($users as $user) {
            $role = Role::inRandomOrder()->first();
            $user->roles()->attach($role);

            if(rand(0, 1)) {
                $secondRole = Role::inRandomOrder()->first();
                if($secondRole != $role) {
                    $user->roles()->attach($secondRole);
                }
            }
        }
    }
}

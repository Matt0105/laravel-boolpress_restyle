<?php

use Illuminate\Database\Seeder;
use App\Model\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $roles = [
            "Admin",
            "Editor"
        ];

        foreach ($roles as $role) {
            $newRole = new Role();

            $newRole->roleName = $role;

            $newRole->save();
        }
    }
}

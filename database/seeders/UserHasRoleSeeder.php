<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UserHasRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_one = User::find(1);
        $user_two = User::find(2);
        $user_one->assignRole('Administrador');
        $user_two->assignRole('Administrador');
    }
}

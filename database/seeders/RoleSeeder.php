<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createPermissions();
        $this->createRole();
        $this->asiignPermissions();
    }

    private function createPermissions () {
        $permissions = [
            //category
            ['name' => 'category.index', 'level' => '1', 'guard_name' => 'api'],
            ['name' => 'category.edit', 'level' => '2', 'guard_name' => 'api'],
            ['name' => 'category.delete', 'level' => '2', 'guard_name' => 'api'],
            // product
            ['name' => 'product.index', 'level' => '1', 'guard_name' => 'api'],
            ['name' => 'product.edit', 'level' => '2', 'guard_name' => 'api'],
            ['name' => 'product.delete', 'level' => '2', 'guard_name' => 'api'],
            // expense
            ['name' => 'expense.index', 'level' => '1', 'guard_name' => 'api'],
            ['name' => 'expense.edit', 'level' => '2', 'guard_name' => 'api'],
            ['name' => 'expense.delete', 'level' => '2', 'guard_name' => 'api'],
            ['name' => 'expense.show', 'level' => '2', 'guard_name' => 'api'],
            // provider
            ['name' => 'provider.index', 'level' => '1', 'guard_name' => 'api'],
            ['name' => 'provider.edit', 'level' => '2', 'guard_name' => 'api'],
            ['name' => 'provider.delete', 'level' => '2', 'guard_name' => 'api'],
            // order
            ['name' => 'order.index', 'level' => '1', 'guard_name' => 'api'],
            ['name' => 'order.edit', 'level' => '2', 'guard_name' => 'api'],
            ['name' => 'order.delete', 'level' => '2', 'guard_name' => 'api'],
            ['name' => 'order.verify', 'level' => '2', 'guard_name' => 'api'],
            ['name' => 'order.show', 'level' => '2', 'guard_name' => 'api'],
            ['name' => 'order.status_one', 'level' => '2', 'guard_name' => 'api'],
            ['name' => 'order.status_two', 'level' => '2', 'guard_name' => 'api'],
            ['name' => 'order.status_three', 'level' => '2', 'guard_name' => 'api'],
            // client
            ['name' => 'client.index', 'level' => '1', 'guard_name' => 'api'],
            ['name' => 'client.edit', 'level' => '2', 'guard_name' => 'api'],
            ['name' => 'client.delete', 'level' => '2', 'guard_name' => 'api'],
            // employee
            ['name' => 'employee.index', 'level' => '1', 'guard_name' => 'api'],
            ['name' => 'employee.edit', 'level' => '2', 'guard_name' => 'api'],
            ['name' => 'employee.delete', 'level' => '2', 'guard_name' => 'api'],
            // role
            ['name' => 'role.index', 'level' => '1', 'guard_name' => 'api'],
            ['name' => 'role.edit', 'level' => '2', 'guard_name' => 'api'],
            ['name' => 'role.delete', 'level' => '2', 'guard_name' => 'api'],
            // organization
            ['name' => 'organization.index', 'level' => '1', 'guard_name' => 'api'],
        ];
        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }

    private function createRole (){
        $roles = ['Administrador'];
        foreach ($roles as $role) {
            Role::create(['name' => $role, 'guard_name' => 'api']);
        }
    }

    private function asiignPermissions (){
        $role = Role::findByName('Administrador');
        $role->syncPermissions(Permission::all());
    }
}

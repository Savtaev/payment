<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'create-users']);
        Permission::create(['name' => 'edit-users']);
        Permission::create(['name' => 'delete-users']);

        Permission::create(['name' => 'top-up-account']);
        Permission::create(['name' => 'send-bonuses']);
        Permission::create(['name' => 'check-account']);

        $adminRole = Role::create(['name' => 'Super-Admin']);
        $businessRole = Role::create(['name' => 'Business']);
        $clientRole = Role::create(['name' => 'Client`']);

        $adminRole->givePermissionTo([
            'create-users',
            'edit-users',
            'delete-users',
//            'top-up-account',
//            'send-bonuses',
//            'check-account',
        ]);

        $businessRole->givePermissionTo([
            'top-up-account',
            'send-bonuses',
            'check-account',
        ]);

        $clientRole->givePermissionTo([
            'check-account',
        ]);
    }
}

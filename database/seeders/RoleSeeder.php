<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = Role::create(['name' => 'superadmin']);
        $permissions = ['manage users', 'manage roles', 'manage permissions']; // Add any permissions needed
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
        $superAdmin->givePermissionTo(Permission::all());
    }
}

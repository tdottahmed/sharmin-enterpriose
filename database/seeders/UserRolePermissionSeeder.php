<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserRolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Define permissions
        $permissions = [
            ['name' => 'create role', 'group' => 'Role Management'],
            ['name' => 'view role', 'group' => 'Role Management'],
            ['name' => 'update role', 'group' => 'Role Management'],
            ['name' => 'delete role', 'group' => 'Role Management'],

            ['name' => 'create user', 'group' => 'User Management'],
            ['name' => 'view user', 'group' => 'User Management'],
            ['name' => 'update user', 'group' => 'User Management'],
            ['name' => 'delete user', 'group' => 'User Management'],

            ['name' => 'create permission', 'group' => 'Permission Management'],
            ['name' => 'view permission', 'group' => 'Permission Management'],
            ['name' => 'update permission', 'group' => 'Permission Management'],
            ['name' => 'delete permission', 'group' => 'Permission Management'],

            // Application info setup
            ['name' => 'view applicationSettings', 'group' => 'Application Management'],
            ['name' => 'update applicationSettings', 'group' => 'Application Management'],

            // clients permissions
            ['name' => 'create client', 'group' => 'Client Management'],
            ['name' => 'view client', 'group' => 'Client Management'],
            ['name' => 'update client', 'group' => 'Client Management'],
            ['name' => 'delete client', 'group' => 'Client Management'],

            // Orders Permissions
            ['name' => 'create orders', 'group' => 'Orders Management'],
            ['name' => 'view orders', 'group' => 'Orders Management'],
            ['name' => 'update orders', 'group' => 'Orders Management'],
            ['name' => 'delete orders', 'group' => 'Orders Management'],

            // Orders Permissions
            ['name' => 'create notes', 'group' => 'Notes Management'],
            ['name' => 'view notes', 'group' => 'Notes Management'],
            ['name' => 'update notes', 'group' => 'Notes Management'],
            ['name' => 'delete notes', 'group' => 'Notes Management'],
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission['name']], $permission);
        }

        // Define roles
        $roles = ['super-admin', 'admin', 'staff', 'user'];

        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        // Assign permissions to roles
        $superAdminRole = Role::findByName('super-admin');
        $superAdminRole->syncPermissions(Permission::all());

        $adminRole = Role::findByName('admin');
        $adminPermissions = [
            'create role',
            'view role',
            'update role',
            'create user',
            'view user',
            'update user',
            'create permission',
            'view permission',
        ];
        $adminRole->syncPermissions($adminPermissions);

        // Define users
        $users = [
            [
                'email' => 'superadmin@gmail.com',
                'name' => 'Super Admin',
                'password' => '12345678',
                'role' => 'super-admin',
            ],
            [
                'email' => 'admin@gmail.com',
                'name' => 'Admin',
                'password' => '12345678',
                'role' => 'admin',
            ],
            [
                'email' => 'staff@gmail.com',
                'name' => 'Staff',
                'password' => '12345678',
                'role' => 'staff',
            ],
        ];

        foreach ($users as $userData) {
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => Hash::make($userData['password']),
                ]
            );
            $user->assignRole($userData['role']);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Membuat Permissions
        Permission::create(['name' => 'manage cars']);
        Permission::create(['name' => 'manage customers']);
        Permission::create(['name' => 'manage transactions']);
        Permission::create(['name' => 'view analytics']);

        // Membuat Roles dan memberi Permissions
        $adminRole = Role::create(['name' => 'administrator']);
        $operatorRole = Role::create(['name' => 'operator']);

        // Berikan permission kepada administrator
        $adminRole->givePermissionTo(['manage cars', 'manage customers', 'manage transactions', 'view analytics']);

        // Berikan permission kepada operator
        $operatorRole->givePermissionTo(['manage transactions', 'manage customers']);

        // Membuat user administrator
        $adminUser = User::create([
            'name' => 'Admin User',
            'last_name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Password bisa diubah sesuai kebutuhan
        ]);

        // Membuat user operator
        $operatorUser = User::create([
            'name' => 'Operator User',
            'last_name' => 'Operator User',
            'email' => 'operator@example.com',
            'password' => Hash::make('password'), // Password bisa diubah sesuai kebutuhan
        ]);

        // Assign role ke user
        $adminUser->assignRole($adminRole);
        $operatorUser->assignRole($operatorRole);
    }
}

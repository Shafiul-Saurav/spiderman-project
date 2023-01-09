<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create an admin role and assign all permission on it

        $adminPermissions = Permission::select('id')->get();

        Role::updateOrCreate([
            'role_name' => 'Admin',
            'role_slug' => 'admin',
            'role_note' => 'admin has all permission',
            'is_deletable' => false,
        ])->permissions()->sync($adminPermissions->pluck('id'));

        Role::updateOrCreate([
            'role_name' => 'User',
            'role_slug' => 'user',
            'role_note' => 'user has limited permission',
            'is_deletable' => true,
        ]);
    }
}

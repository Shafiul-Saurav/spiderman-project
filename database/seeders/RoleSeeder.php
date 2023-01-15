<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        // DB::table('role')->truncate();
        // Create an admin role and assign all permission on it

        $adminPermissions = Permission::select('id')->get();

        Role::updateOrCreate([
            'role_name' => 'Admin',
            'role_slug' => 'admin',
            'role_note' => 'admin has all permission',
            'is_deletable' => false,
        ])->permissions()->sync($adminPermissions->pluck('id'));

        Role::updateOrCreate([
            'role_name' => 'Manager',
            'role_slug' => 'manager',
            'role_note' => 'manager has limited permission',
            'is_deletable' => true,
        ]);

        Role::updateOrCreate([
            'role_name' => 'Editor',
            'role_slug' => 'editor',
            'role_note' => 'editor has limited permission',
            'is_deletable' => true,
        ]);
    }
}

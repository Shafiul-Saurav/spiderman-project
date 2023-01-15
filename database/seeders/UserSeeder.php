<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->truncate();
        //Create Admin
        $adminRoleId = Role::where('role_slug', 'admin')->first()->id;
        User::updateOrCreate([
            'role_id' => $adminRoleId,
            'name' => 'Shafi',
            'email' => 'shafi@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('@19-01-89Shafi'),//@19-01-89Shafi
            'remember_token' => Str::random(10),
        ]);

        //Create Manager
        $ManagerRoleId = Role::where('role_slug', 'manager')->first()->id;
        User::updateOrCreate([
            'role_id' => $ManagerRoleId,
            'name' => 'Maisha',
            'email' => 'maisha@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('1234@maisha'),//1234@maisha
            'remember_token' => Str::random(10),
        ]);

        //Create Editor
        $editorRoleId = Role::where('role_slug', 'editor')->first()->id;
        User::updateOrCreate([
            'role_id' => $editorRoleId,
            'name' => 'Saurav',
            'email' => 'saurav@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('1234@saurav'),//1234@saurav
            'remember_token' => Str::random(10),
        ]);
        User::updateOrCreate([
            'role_id' => $editorRoleId,
            'name' => 'User',
            'email' => 'user@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('1234@user'),//1234@user
            'remember_token' => Str::random(10),
        ]);
    }
}

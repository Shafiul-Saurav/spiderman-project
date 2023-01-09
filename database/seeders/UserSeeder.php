<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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

        //Create User
        $userRoleId = Role::where('role_slug', 'user')->first()->id;
        User::updateOrCreate([
            'role_id' => $userRoleId,
            'name' => 'User',
            'email' => 'user@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('1234@user'),//1234@user
            'remember_token' => Str::random(10),
        ]);
    }
}

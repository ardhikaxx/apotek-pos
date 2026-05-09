<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Role::where('name', 'admin')->first();
        $apoteker = Role::where('name', 'apoteker')->first();

        User::create([
            'role_id'  => $admin->id,
            'name'     => 'Administrator',
            'email'    => 'admin@apotek.com',
            'password' => Hash::make('password'),
            'is_active' => true,
        ]);

        User::create([
            'role_id'  => $apoteker->id,
            'name'     => 'Apoteker',
            'email'    => 'apoteker@apotek.com',
            'password' => Hash::make('password'),
            'is_active' => true,
        ]);
    }
}

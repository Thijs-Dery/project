<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@ehb.be',
            'password' => Hash::make('Password!321'),
            'role' => 'admin',
        ]);

        Profile::create([
            'user_id' => $admin->id,
            'birthday' => '2000-01-01',
            'bio' => 'Administrator profile',
            'avatar' => 'default.png',
        ]);
    }
}

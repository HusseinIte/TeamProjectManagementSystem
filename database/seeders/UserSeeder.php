<?php

namespace Database\Seeders;

use App\Enums\RoleUser;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::Create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => '123456789',
            'role' => RoleUser::Admin
        ]);

        User::Create([
            'name' => 'user1',
            'email' => 'user1@gmail.com',
            'password' => '123456789',
        ]);

        User::Create([
            'name' => 'user2',
            'email' => 'user2@gmail.com',
            'password' => '123456789',

        ]);
    }
}

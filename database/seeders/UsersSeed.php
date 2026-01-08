<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'marra',
            'name' => 'Herick Marra',
            'password' => '123456789',
            'profile_picture' => '/img/marra.png'
        ]);

        User::create([
            'username' => 'anne',
            'name' => 'Anne',
            'password' => '123456789',
            'profile_picture' => '/img/rafah.png'
        ]);

    }
}

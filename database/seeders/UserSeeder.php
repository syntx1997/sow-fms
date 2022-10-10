<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'SowFMS Administrator',
            'email' => 'admin@sowfms.com',
            'password' => bcrypt('admin@1234'),
            'role' => 'Administrator'
        ]);

        User::create([
            'name' => 'SowFMS Staff',
            'email' => 'staff@sowfms.com',
            'password' => bcrypt('staff@1234'),
            'role' => 'Staff'
        ]);
    }
}

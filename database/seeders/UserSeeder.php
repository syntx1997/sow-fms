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
            'name' => 'Stracker Administrator',
            'email' => 'admin@stracker-fms.com',
            'phone' => '09156390988',
            'password' => bcrypt('admin@1234'),
            'role' => 'Administrator'
        ]);

        User::create([
            'name' => 'Stracker Staff',
            'email' => 'staff@stracker-fms.com',
            'phone' => '09156390981',
            'password' => bcrypt('staff@1234'),
            'role' => 'Staff'
        ]);
    }
}

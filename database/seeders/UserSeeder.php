<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
        User::create([
            'fullname' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'role_id' => 1,
            'password' => Hash::make('admin123'),
        ]);
    }
}

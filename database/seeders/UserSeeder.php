<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ],
            [
                'name' => 'Employee 1',
                'email' => 'employee1@example.com',
                'password' => Hash::make('password123'),
                'role' => 'employee',
            ],
            [
                'name' => 'Employee 2',
                'email' => 'employee2@example.com',
                'password' => Hash::make('password123'),
                'role' => 'employee',
            ],
            [
                'name' => 'Employee 3',
                'email' => 'employee3@example.com',
                'password' => Hash::make('password123'),
                'role' => 'employee',
            ],
        ]);
    }
}

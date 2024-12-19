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
                'name' => 'saleh',
                'email' => 'saleh@amrtm.sa',
                'password' => Hash::make('saleh@123'),
                'role' => 'admin',
            ],
            [
                'name' => 'Jumana',
                'email' => 'jumana@amrtm.sa',
                'password' => Hash::make('jumana@123'),
                'role' => 'employee',
            ],
            [
                'name' => 'Abdullah',
                'email' => 'abdullah@amrtm.sa',
                'password' => Hash::make('abdullah@123'),
                'role' => 'employee',
            ],
            [
                'name' => 'Safvan',
                'email' => 'safvan@amrtm.sa',
                'password' => Hash::make('safvan@123'),
                'role' => 'employee',
            ],
            [
                'name' => 'Zain',
                'email' => 'zain@zain.sa',
                'password' => Hash::make('zain@123'),
                'role' => 'employee',
            ],
        ]);
    }
}

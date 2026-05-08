<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'bambang karyawan',
            'email' => 'bambang@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'employee',
        ]);

        \App\Models\User::create([
            'name' => 'budi IT Support',
            'email' => 'budi@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'it_support',
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{ 
    public function run(): void
    {
        User::create([
            'name' => 'Alpian',
            'email' => 'Alpian@todoapp.com',
            'password' => bcrypt('alpian4321'),
        ]);

        User::create([
            'name' => 'Kanza',
            'email' => 'Kanza@todoapp.com',
            'password' => bcrypt('kanza1234'),
        ]);
    }
}

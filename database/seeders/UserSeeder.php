<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = \App\Models\User::create([
            'name' => 'Dirham',
            'email' => 'dirham@gmail.com',
            'password' => bcrypt('password'),
        ]);

        $user->assignRole('admin');
    }
}

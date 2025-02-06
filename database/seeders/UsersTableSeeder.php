<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'john_doe',
            'password' => bcrypt('password123'), // Contraseña cifrada
            'email' => 'john@example.com',
        ]);

        User::create([
            'username' => 'jane_doe',
            'password' => bcrypt('password456'),
            'email' => 'jane@example.com',
        ]);

        User::create([
            'username' => 'alex_smith',
            'password' => bcrypt('alex123'),
            'email' => 'alex.smith@example.com',
        ]);

        User::create([
            'username' => 'mary_jones',
            'password' => bcrypt('mary456'),
            'email' => 'mary.jones@example.com',
        ]);

        User::create([
            'username' => 'robert_brown',
            'password' => bcrypt('robert789'),
            'email' => 'robert.brown@example.com',
        ]);
    }
}

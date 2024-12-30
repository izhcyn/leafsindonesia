<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Make sure to import the User model

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // Create a specific admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('passwordadmin'), // Use bcrypt to hash the password
            'role' => 'admin', // Set the role to 'admin'
        ]);

        // Optionally, you can create a test user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'), // Use bcrypt to hash the password
            'role' => 'user', // Set the role to 'user'
        ]);
    }
}
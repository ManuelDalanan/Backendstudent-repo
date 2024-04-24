<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Hash, Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(1)->create([
            'role' => 'superadmin',

            'department' => 'Library Department',
            'position' => 'Head',
            'username' => 'superadmin',
            'password' => bcrypt('Admin123')
        ]);

        User::factory()->count(1)->create([
            'role' => 'admin',

            'department' => 'Library Department',
            'position' => 'Chief',
            'username' => 'admin',
            'password' => Hash::make('Admin123')
        ]);

        User::factory()->count(1)->create([
            'role' => 'staff',

            'department' => 'Library Department',
            'position' => 'idk',
            'username' => 'staff',
            'password' => Hash::make('Admin123')
        ]);

        User::factory()->count(1)->create([
            'role' => 'user',
            'username' => 'user',
            'password' => Hash::make('123'),
            'department' => 'CCS Department',
            'position' => 'Teacher'
        ]);

        User::factory()->count(3)->create([
            'role' => 'user',
            'course_id' => fake()->numberBetween(1, 4),
        ]);
    }
}

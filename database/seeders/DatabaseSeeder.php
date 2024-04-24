<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('patrons')->insert([[
            'patron' => 'student',
            'fine' => 500.00,
            'description' => 'GC students'
        ],
        [
            'patron' => 'faculty',
            'fine' => 250.00,
            'description' => 'GC faculty members'
        ]
    ]);

        $this->call([
            UserSeeder::class,
            DepartmentSeeder::class,
            LocationSeeder::class,
            BookSeeder::class,
            PeriodicalSeeder::class,
            ArticleSeeder::class,
            ProjectSeeder::class,
            AnnouncementSeeder::class
          ]);
    }
}

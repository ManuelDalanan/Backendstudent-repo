<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Announcement>
 */
class AnnouncementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->title(),
            'category' => Str::random(10),  //ano nga ba laman ng category HAHAHAHHA
            'author_id' => fake()->numberBetween(1, 5),
            'text' => fake()->sentence(4),
            'image' => fake()->url()
        ];
    }
}

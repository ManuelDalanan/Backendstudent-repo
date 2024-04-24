<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'call_number' => Str::random(10),
            'isbn' => Str::random(15),
            'title' => fake()->words(3, true),
            'author' => fake()->name(),
            // 'image_location' => fake()->filePath(),
            'language' => fake()->randomElement(['FIL', 'FOR']),
            'location_id' => fake()->numberBetween(1, 10),
            'publisher' => fake()->company(),
            'copyright' => fake()->year(),
            'volume' => fake()->numberBetween(1, 3),
            'edition' => fake()->numberBetween(1, 3),
            'pages' => fake()->randomNumber(3),
            'purchase_date' => fake()->date(),
            'content' => fake()->sentences(2, true),
            'remarks' => fake()->sentences(3, true),
            'date_published' => fake()->date()
        ];
    }
}

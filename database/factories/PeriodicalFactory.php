<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Periodical>
 */
class PeriodicalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'material_type' => fake()->randomElement(['journal', 'magazine', 'newspaper']),
            'title' => fake()->words(3, true),
            'author' => fake()->name(),
            'image_location' => fake()->filePath(),
            'language' => fake()->randomElement(['FIL', 'FOR']),
            'receive_date' => fake()->date(),   
            'publisher' => fake()->company(),
            'copyright' => fake()->year(),
            'volume' => fake()->numberBetween(1, 3),
            'issue' => fake()->numberBetween(1, 5),
            'pages' => fake()->randomNumber(3),
            'content' => fake()->sentence(),
            'remarks' => fake()->sentence(),
            'date_published' => fake()->date()        
        ];
    }
}

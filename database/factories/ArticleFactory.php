<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->words(3, true),
            'author' => fake()->name(),
            'language' => fake()->randomElement(['FIL', 'FOR']),
            'subject' => fake()->sentences(2, true),
            'date_published' => fake()->date(),
            'volume' => fake()->numberBetween(1, 3),
            'issue' => fake()->numberBetween(1, 3),
            'page' => fake()->randomNumber(3),
            'abstract' => fake()->sentences(2, true),
            'remarks' => fake()->sentence()
        ];
    }
}

<?php

namespace Database\Factories;


use App\Models\Author;
use App\Models\Publisher;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'publisher_id' => Publisher::factory(),
            'isbn' => fake()->numberBetween(1000000000000, 9999999999999),
            'title' =>fake()->sentence(),
            'description' =>fake()->text,
            'cover' =>fake()->imageUrl(),
            'price' =>fake()->randomDigitNotNull,
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Genre;
use App\Models\Director;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word(),
            'raiting' => $this->faker->numberBetween(1,10),
            'description' => $this->faker->sentence(),
            'year' => $this->faker->numberBetween(1970,2022),
            'director_id' => Director::factory(),
            'genre_id' => Genre::factory(),

        ];
    }
}

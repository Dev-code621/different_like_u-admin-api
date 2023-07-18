<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TrainingResourceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'url' => $this->faker->url,
            'description' => $this->faker->sentence,
            'thumbnail' => $this->faker->imageUrl($width = 800, $height = 600),
            'status' => 'PUBLISHED',
        ];
    }
}
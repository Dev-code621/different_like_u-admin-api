<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'title' => $this->faker->sentence,
            'content' => $this->faker->text(1600),
            'summary' =>  $this->faker->sentence,
            'status' => 'PUBLISHED',
            'category' => $this->faker->randomElement([
                'UNCONSCIOUS_BIAS',
                'INCLUSIVE_COMMUNICATION_AND_MARKETING',
                'ANTI_DISCRIMINATION_RESOURCES',
                'DIVERSE_AND_INCLUSIVE_TEAMS',
                'CONSUMER_TRENDS',
                'MAXIMIZING_YOUR_DATA',
            ]),
            'thumbnail' =>  $this->faker->imageUrl($width = 640, $height = 480),
            'image' =>  $this->faker->imageUrl($width = 800, $height = 600)
        ];
    }
}
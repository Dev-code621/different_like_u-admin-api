<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BusinessFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'google_id'=> $this->faker->postcode,
            'name' => $this->faker->company(),
            'about' => $this->faker->bs,
            'image' => $this->faker->imageUrl(640, 480, 'animals', true),
            'links' => $this->faker->url(),
            'other_link' => $this->faker->url(),
            'claimed' => 'Accepted',
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'user_id' => 1,
            'default_address' => $this->faker->address(),
            'latitude' => $this->faker->randomFloat(5, -30.17078, 48.74483),
            'longitude' => $this->faker->randomFloat(5, -123.95428, -72.755442),
            'types' => $this->faker->bs,
            'international_phone_number' => $this->faker->phoneNumber,
            'url' => $this->faker->imageUrl(640, 400),
        ];
    }
}

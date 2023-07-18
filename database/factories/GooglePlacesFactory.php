<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GooglePlacesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = \App\GooglePlaces::class;
    public function definition()
    {
        return [
            'default_address' => $this->faker->address(),
            'latitude' => $this->faker->randomNumber(),
            'longitude' => $this->faker->randomNumber(),
            'place_id' => $this->faker->isbn13,
            'name' => $this->faker->company,
            'types' => $this->faker->bs,
            'international_phone_number' => $this->faker->phoneNumber,
            'url' => $this->faker->imageUrl(640, 400),
            'website' => $this->faker->url,
            'city' => $this->faker->city,
            'postal_code' => $this->faker->postcode,
            'state' => $this->faker->state,
        ];
    }
}

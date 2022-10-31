<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'date_of_birth' => $this->faker->dateTimeBetween('-70 year', '-18 year'),
            'profile_photo_path' => $this->faker->imageUrl(128,128),
            'content' => $this->faker->text(mt_rand(50, 300))
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrganisationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'email' => $this->faker->safeEmail(),
            'email_verified_at' => now(),
            'profile_photo_path' => $this->faker->imageUrl(128, 128),
            'about' => $this->faker->text(mt_rand(50, 300)),
            'motivation' => $this->faker->text(mt_rand(50, 150)),
        ];
    }
}

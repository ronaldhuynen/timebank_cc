<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bank>
 */
class BankFactory extends Factory
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
            'profile_photo_path' => $this->faker->imageUrl(128, 128),
            'about' => $this->faker->text(mt_rand(50, 300)),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'Personal Account',
            'limit_min' => 0,
            'limit_max' => 12000,
            'accountable_type' => 'App\Models\User',
        ];
    }
}



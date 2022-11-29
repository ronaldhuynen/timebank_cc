<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        //TODO: use all fields
        $fromAccountId = Account::all()->random()->id;
        $toAccountId = Account::all()->random()->id;
        return [
           'from_account_id' => $fromAccountId,
           'to_account_id' => $toAccountId,
        //    'creator_user_id' => Account::find($fromAccountId)->accountable->id,
           'creator_user_id' => 1,
           'amount' => $this->faker->numberBetween(15, 2000),
           'description' => $this->faker->sentence(),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;
use App\Models\Payment;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Payment::class;

    public function definition(): array
    {
        $customer = Customer::inRandomOrder()->first();
        $firstName = $customer->first_name;
        $lastName = $customer->last_name;
        $customerUsername = $customer->username;

        return [
            'transaction_code' => $this->faker->unique()->randomNumber(8),
            'first_name' => $firstName,
            'last_name' => $lastName,
            'customer_id' => $customer->id,
            'amount' => $this->faker->randomFloat(2, 10, 500),
            'account_number' => $customerUsername,
            'transaction_date' => $this->faker->dateTimeBetween('-1 year', 'now')
        ];
    }
}

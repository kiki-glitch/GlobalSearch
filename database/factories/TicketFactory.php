<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Ticket::class;

    public function definition(): array
    {
        $customer = Customer::inRandomOrder()->first();
        $user = User::inRandomOrder()->first();

        return [
            'title' => $this->faker->sentence(5),
            'description' => $this->faker->text(200),
            'customer_id' => $customer->id,
            'user_id' => $user->id,
            'scheduled_date' => $this->faker->dateTimeBetween('+1 week', '+1 month'),
        ];
    }
}

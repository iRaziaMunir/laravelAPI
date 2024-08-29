<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition()
    {
        $customerNumber = Customer::inRandomOrder()->value('customerNumber');
        return [

            'customerNumber'=>$customerNumber,
            'checkNumber'=>$this->faker->regexify('[A-Z0-9]{6}'),
            'paymentDate'=>$this->faker->date,
            'amount'=>$this->faker->randomFloat(2, 5000, 500000),
        ];
    }
}

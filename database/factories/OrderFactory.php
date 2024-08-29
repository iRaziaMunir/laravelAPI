<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $customerNumber = Customer::inRandomOrder()->value('customerNumber');

        $orderDate=$this->faker->date;
        $requiredDate=$this->faker->dateTimeBetween($orderDate, '+1 month');
        $shippedDate=$this->faker->dateTimeBetween($requiredDate, '+60 days');
        return [
            'orderNumber'=>$this->faker->unique()->numberBetween(1000, 9999),
            'orderDate'=>$orderDate,
            'requiredDate'=>$requiredDate,
            'shippedDate'=>$shippedDate,
            'status'=>$this->faker->randomElement(['Shipped', 'On Hold', 'Resolved','Cancelled', 'In Process']),
            'comments'=>$this->faker->sentence,
            'customerNumber'=>$customerNumber,
        ];
    }
}

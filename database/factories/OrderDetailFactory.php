<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderDetail>
 */
class OrderDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $orderNumber = Order::inRandomOrder()->value('orderNumber');
        $productCode = Product::inRandomOrder()->value('productCode');

        return [
            'orderNumber'=>$orderNumber,
            'productCode'=>$productCode,
            'quantityOrdered'=>$this->faker->numberBetween(1, 100),
            'priceEach'=>$this->faker->randomFloat(2, 10, 100),
            'orderLineNumber'=>$this->faker->numberBetween(1, 50),
        ];
    }
}

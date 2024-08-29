<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $salesRepEmployeeNumber = Employee::inRandomOrder()->value('employeeNumber');
        return [
            
            'customerNumber'=>$this->faker->unique()->numberBetween(1000, 10000),
            'customerName'=>$this->faker->word,
            'contactLastName'=>$this->faker->lastName,
            'contactFirstName'=>$this->faker->firstName,
            'phone'=>$this->faker->phoneNumber,
            'addressLine1'=>$this->faker->streetAddress,
            'addressLine2'=>$this->faker->secondaryAddress,
            'city'=>$this->faker->city,
            'state'=>$this->faker->state,
            'postalCode'=>$this->faker->postcode,
            'country'=>$this->faker->country,
            'salesRepEmployeeNumber'=>$salesRepEmployeeNumber,
            'creditLimit'=>$this->faker->randomFloat(2, 1000, 10000),
        ];
    }
}

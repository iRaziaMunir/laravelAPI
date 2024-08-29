<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Office;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $office=Office::inRandomOrder()->first();
        $reportsTo=Employee::inRandomOrder()->first();

        return [
            'employeeNumber'=>$this->faker->unique()->randomNumber(),
            'firstName'=>$this->faker->word,
            'lastName'=>$this->faker->word,
            'extension'=>$this->faker->regexify('[A-Z0-8]{4}'),
            'email'=>$this->faker->unique()->safeEmail,
            'officeCode'=>$office ? $office->officeCode : null,
            'reportsTo'=>$reportsTo ? $reportsTo->employeeNumber :null,
            'jobTitle'=>$this->faker->jobTitle,
        ];
    }
}

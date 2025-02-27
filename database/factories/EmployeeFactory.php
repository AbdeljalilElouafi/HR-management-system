<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

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
    protected $model = Employee::class;

    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'date_of_birth' => $this->faker->date(),
            'hire_date' => $this->faker->date(),
            'address' => $this->faker->address,
            'contract_type' => $this->faker->randomElement(['full-time', 'part-time', 'contract']),
            'salary' => $this->faker->randomFloat(2, 30000, 90000), 
            'status' => $this->faker->randomElement(['active', 'inactive']),
            
            
            'company_id' => 2, 
        ];
    }
}

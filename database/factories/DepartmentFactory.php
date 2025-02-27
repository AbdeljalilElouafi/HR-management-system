<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Department;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Department>
 */
class DepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


     protected $model = Department::class;


     public function definition()
     {
         return [
             'name' => $this->faker->word, 
             'description' => $this->faker->sentence,  
             'manager_id' => 1,  
             'company_id' => 2,
         ];
     }
}

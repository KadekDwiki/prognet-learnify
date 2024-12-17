<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Assignments>
 */
class AssignmentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'topic' => $this->faker->paragraph(),
            'due_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'class_id' => $this->faker->numberBetween(1, 10),
            'file_url' => $this->faker->optional->url()
        ];
    }
}

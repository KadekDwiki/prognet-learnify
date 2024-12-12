<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AssignmentsSubmissions>
 */
class AssignmentsSubmissionsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'assignment_id' => $this->faker->numberBetween(1, 10),
            'student_id' => $this->faker->numberBetween(3, 10),
            'submission_text' => $this->faker->paragraph(),
            'file_url' => $this->faker->url(),
            'submitted_at' => $this->faker->dateTime(),
            'grade' => $this->faker->optional()->randomFloat(2, 0, 100),
        ];
    }
}

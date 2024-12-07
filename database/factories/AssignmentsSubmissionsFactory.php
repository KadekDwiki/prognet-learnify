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
            'assignment_id' => \App\Models\Assignments::factory(),
            'student_id' => \App\Models\User::factory()->create(['role' => 'student'])->id,
            'submission_text' => $this->faker->optional()->paragraph(),
            'file_url' => $this->faker->optional()->url(),
            'submitted_at' => $this->faker->dateTime(),
            'grade' => $this->faker->optional()->randomFloat(2, 0, 100),
        ];
    }
}

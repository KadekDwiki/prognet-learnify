<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClassStudents>
 */
class ClassStudentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'class_id' => \App\Models\Classes::factory(),
            'student_id' => \App\Models\User::factory()->create(['role' => 'student'])->id,
            'joined_at' => now(),
        ];
    }
}

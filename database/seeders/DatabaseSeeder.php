<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Assignments;
use App\Models\AssignmentsSubmissions;
use App\Models\Classes;
use App\Models\ClassStudents;
use App\Models\Lessons;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'student',
            'email' => 'student@gmail.com',
            'role' => 'student',
            'password' => 'password'
        ]);

        User::factory()->create([
            'name' => 'teacher',
            'email' => 'teacher@gmail.com',
            'role' => 'teacher',
            'password' => 'password'
        ]);

        Classes::factory(5)->create();
        ClassStudents::factory(5)->create();
        Lessons::factory(5)->create();
        Assignments::factory(5)->create();
        AssignmentsSubmissions::factory(5)->create();
    }
}

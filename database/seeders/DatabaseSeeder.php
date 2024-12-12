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
            'name' => 'teacher',
            'email' => 'teacher@gmail.com',
            'role' => 'teacher',
            'password' => 'password'
        ]);

        User::factory()->create([
            'name' => 'dwiki teacher',
            'email' => 'teacher1@gmail.com',
            'role' => 'teacher',
            'password' => 'password'
        ]);

        User::factory()->create([
            'name' => 'student',
            'email' => 'student@gmail.com',
            'role' => 'student',
            'password' => 'password'
        ]);

        User::factory(7)->create();
        Classes::factory(10)->create();
        ClassStudents::factory(10)->create();
        Lessons::factory(20)->create();
        Assignments::factory(10)->create();
        AssignmentsSubmissions::factory(5)->create();
    }
}

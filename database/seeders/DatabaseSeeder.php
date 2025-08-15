<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Professor;
use App\Models\Student;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Create 10 sample professors first
        Professor::factory(10)->create();

        // Create 15 sample courses (with professor relationships)
        Course::factory(15)->create();

        // Create 20 sample students
        Student::factory(20)->create();

        // Assign some students to courses (many-to-many relationship)
        $students = Student::all();
        $courses = Course::all();
        
        foreach ($students as $student) {
            // Randomly assign 1-3 courses to each student
            $randomCourses = $courses->random(rand(1, 3));
            $student->courses()->attach($randomCourses->pluck('id'));
        }
    }
}

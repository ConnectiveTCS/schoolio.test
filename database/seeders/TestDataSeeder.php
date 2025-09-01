<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TenantStudents;
use App\Models\TenantClasses;
use App\Models\TenantTeacher;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create some teachers first
        $teacher1 = TenantTeacher::create([
            'user_id' => 1,
            'name' => 'John Teacher',
            'email' => 'teacher1@example.com',
            'subject' => 'Mathematics',
            'hire_date' => now()->subYears(2),
            'is_active' => true,
        ]);

        $teacher2 = TenantTeacher::create([
            'user_id' => 1,
            'name' => 'Jane Science',
            'email' => 'teacher2@example.com',
            'subject' => 'Science',
            'hire_date' => now()->subYears(1),
            'is_active' => true,
        ]);

        // Create some classes
        $class1 = TenantClasses::create([
            'teacher_id' => $teacher1->id,
            'name' => 'Mathematics 101',
            'subject' => 'Mathematics',
            'description' => 'Basic Mathematics course',
            'room' => 'Room A1',
            'is_active' => true,
        ]);

        $class2 = TenantClasses::create([
            'teacher_id' => $teacher2->id,
            'name' => 'Science Basics',
            'subject' => 'Science',
            'description' => 'Introduction to Science',
            'room' => 'Room B2',
            'is_active' => true,
        ]);

        $class3 = TenantClasses::create([
            'teacher_id' => $teacher1->id,
            'name' => 'Advanced Math',
            'subject' => 'Mathematics',
            'description' => 'Advanced Mathematics course',
            'room' => 'Room A2',
            'is_active' => true,
        ]);

        // Create some students
        $student1 = TenantStudents::create([
            'user_id' => 1,
            'name' => 'Alice Student',
            'email' => 'alice@example.com',
            'enrollment_date' => now()->subMonths(6),
            'is_active' => true,
        ]);

        $student2 = TenantStudents::create([
            'user_id' => 1,
            'name' => 'Bob Student',
            'email' => 'bob@example.com',
            'enrollment_date' => now()->subMonths(4),
            'is_active' => true,
        ]);

        $student3 = TenantStudents::create([
            'user_id' => 1,
            'name' => 'Charlie Student',
            'email' => 'charlie@example.com',
            'enrollment_date' => now()->subMonths(3),
            'is_active' => true,
        ]);

        // Enroll students in multiple classes
        $student1->classes()->attach([
            $class1->id => [
                'enrolled_at' => now()->subMonths(5),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            $class2->id => [
                'enrolled_at' => now()->subMonths(4),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        $student2->classes()->attach([
            $class1->id => [
                'enrolled_at' => now()->subMonths(3),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            $class3->id => [
                'enrolled_at' => now()->subMonths(2),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        $student3->classes()->attach([
            $class2->id => [
                'enrolled_at' => now()->subMonths(2),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}

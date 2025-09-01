<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentClassEnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = \App\Models\TenantStudents::all();
        $classes = \App\Models\TenantClasses::all();

        if ($students->count() > 0 && $classes->count() > 0) {
            foreach ($students as $student) {
                // Enroll each student in 1-3 random classes
                $numEnrollments = rand(1, min(3, $classes->count()));
                $selectedClasses = $classes->random($numEnrollments);

                foreach ($selectedClasses as $class) {
                    // Check if enrollment doesn't already exist
                    if (!$student->classes()->where('tenant_class_id', $class->id)->exists()) {
                        $student->classes()->attach($class->id, [
                            'enrolled_at' => now()->subDays(rand(1, 365)),
                            'is_active' => rand(1, 100) > 10, // 90% chance of being active
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }
        }
    }
}

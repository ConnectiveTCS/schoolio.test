<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\TenantStudents;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TenantStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TenantStudents::factory()->count(50)->create();
        // For every student create a user account and assign the 'student' role
        $students = TenantStudents::all();
        $studentRole = \Spatie\Permission\Models\Role::where('name', 'student')->first();

        foreach ($students as $student) {
            $user = \App\Models\User::create([
                'name' => $student->name,
                'email' => $student->email,
                'password' => bcrypt('password'), // Use a secure password
            ]);

            // Assign the 'student' role to the user
            $user->assignRole($studentRole);
        }
    }
}

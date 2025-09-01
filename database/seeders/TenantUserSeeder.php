<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TenantUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // This seeder runs within tenant context
        $tenantAdmin = User::factory()->create([
            'name' => 'Tenant Administrator',
            'email' => 'admin@tenant.local',
            'password' => bcrypt('password'),
        ]);
        $tenantAdmin->assignRole('tenant_admin');
        
        $teacher = User::factory()->create([
            'name' => 'Sample Teacher',
            'email' => 'teacher@tenant.local',
            'password' => bcrypt('password'),
        ]);
        $teacher->assignRole('teacher');
        
        $student = User::factory()->create([
            'name' => 'Sample Student',
            'email' => 'student@tenant.local',
            'password' => bcrypt('password'),
        ]);
        $student->assignRole('student');
    }
}
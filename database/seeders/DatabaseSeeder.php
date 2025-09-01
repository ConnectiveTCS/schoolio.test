<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Tenant;
use App\Models\TenantTeacher;
use App\Models\TenantStudents;
use Illuminate\Database\Seeder;
use Database\Seeders\RolesSeeder;
use Database\Seeders\TenantSeeder;
use Database\Seeders\PermissionSeeder;
use Spatie\Permission\PermissionRegistrar;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call(TenantSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(PermissionSeeder::class);
        // Create main admin user (central domain)
        $mainAdmin = User::factory()->create([
            'name' => 'Kyle McPherson',
            'email' => 'admin@acewebdesign.co.za',
            'password' => bcrypt('1'),
        ]);
        $mainAdmin->assignRole('admin');
        // Create tenant-specific data
        $tenant1 = Tenant::find(1); // Alsahwa Schools
        $tenant1->run(function () {
            // Create roles and permissions for this tenant
            app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
            $this->call(RolesSeeder::class);
            $this->call(PermissionSeeder::class);

            // Create tenant users with specific data
            $tenantUser = User::factory()->create([
                'name' => 'Alsahwa Admin',
                'email' => 'admin@alsahwa.edu',
                'password' => bcrypt('1'),
            ]);
            $tenantUser->assignRole('tenant_admin');

            $this->call(TenantTeacherSeeder::class);

            $user2 = User::factory()->create([
                'name' => 'Steven Hyde',
                'email' => 'steven@student.edu',
                'password' => bcrypt('1'),
            ]);
            $user2->assignRole('student');

            TenantStudents::factory()->create([
                'user_id' => $user2->id,
                'name' => $user2->name,
                'email' => $user2->email,
                'phone' => '123-456-7890',
                'address' => '123 Main St, Anytown, USA',
                'date_of_birth' => '2005-01-01',
                'gender' => 'male',
            ]);

            $user3 = User::factory()->create([
                'name' => 'Linda Smith',
                'email' => 'linda@student.edu',
                'password' => bcrypt('1'),
            ]);
            $user3->assignRole('student');

            TenantStudents::factory()->create([
                'user_id' => $user3->id,
                'name' => $user3->name,
                'email' => $user3->email,
                'phone' => '123-456-7890',
                'address' => '123 Main St, Anytown, USA',
                'date_of_birth' => '2005-01-01',
                'gender' => 'female',
            ]);
            $this->call(\Database\Seeders\TenantClassesSeeder::class);
        });

        $tenant2 = Tenant::find(2); // Future Generation Schools
        $tenant2->run(function () {
            // Create roles and permissions for this tenant
            app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
            $this->call(RolesSeeder::class);
            $this->call(PermissionSeeder::class);

            $tenantUser = User::factory()->create([
                'name' => 'Future Admin',
                'email' => 'admin@future.edu',
                'password' => bcrypt('1'),
            ]);
            $tenantUser->assignRole('tenant_admin');
        });
    }
}

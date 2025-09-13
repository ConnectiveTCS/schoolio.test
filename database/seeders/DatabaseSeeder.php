<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Tenant;
use App\Models\CentralAdmin;
use App\Models\TenantTeacher;
use App\Models\TenantStudents;
use Illuminate\Database\Seeder;
use Database\Seeders\RolesSeeder;
use Database\Seeders\TenantSeeder;
use Illuminate\Support\Facades\Hash;
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

            $this->call(TenantStudentSeeder::class);
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
        CentralAdmin::create([
            'name' => 'Kyle McPherson',
            'email' => 'admin@acewebdesign.co.za',
            'password' => Hash::make('Morgan146@'),
            'role' => 'super_admin',
            'permissions' => [
                'manage_tenants',
                'view_tenant_data',
                'manage_admins',
                'system_settings',
            ],
            'is_active' => true,
        ]);
    }
}

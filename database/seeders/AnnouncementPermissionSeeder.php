<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AnnouncementPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create announcement permissions if they don't exist
        $announcementPermissions = [
            'manage announcements',
            'create announcements',
            'edit announcements',
            'delete announcements',
            'view announcements',
        ];

        foreach ($announcementPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Get roles
        $roles = Role::all();

        // Give permissions to tenant admin
        $tenantAdmin = $roles->where('name', 'tenant_admin')->first();
        if ($tenantAdmin) {
            $tenantAdmin->givePermissionTo([
                'manage announcements',
                'create announcements',
                'edit announcements',
                'delete announcements',
                'view announcements',
            ]);
        }

        // Give teacher announcement permissions
        $teacher = $roles->where('name', 'teacher')->first();
        if ($teacher) {
            $teacher->givePermissionTo([
                'create announcements',
                'edit announcements',
                'view announcements',
            ]);
        }

        // Give basic view permissions to students and parents
        $student = $roles->where('name', 'student')->first();
        if ($student) {
            $student->givePermissionTo(['view announcements']);
        }

        $parent = $roles->where('name', 'parent')->first();
        if ($parent) {
            $parent->givePermissionTo(['view announcements']);
        }
    }
}

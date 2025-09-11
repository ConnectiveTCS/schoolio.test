<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $roles = Role::all();
        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'view dashboard']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);
        Permission::create(['name' => 'assign roles']);
        Permission::create(['name' => 'manage roles']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'multi admin']);
        Permission::create(['name' => 'manage tenants']);
        Permission::create(['name' => 'create classes']);
        Permission::create(['name' => 'manage classes']);
        Permission::create(['name' => 'manage announcements']);
        Permission::create(['name' => 'create announcements']);
        Permission::create(['name' => 'edit announcements']);
        Permission::create(['name' => 'delete announcements']);
        Permission::create(['name' => 'view announcements']);
        // Calendar Event permissions
        Permission::create(['name' => 'manage calendar events']);
        Permission::create(['name' => 'create calendar events']);
        Permission::create(['name' => 'edit calendar events']);
        Permission::create(['name' => 'delete calendar events']);
        Permission::create(['name' => 'view calendar events']);
        Permission::create(['name' => 'create students']);
        Permission::create(['name' => 'edit students']);
        Permission::create(['name' => 'delete students']);
        Permission::create(['name' => 'view students']);
        Permission::create(['name' => 'enroll students']);
        Permission::create(['name' => 'unenroll students']);
        Permission::create(['name' => 'create teachers']);
        Permission::create(['name' => 'edit teachers']);
        Permission::create(['name' => 'delete teachers']);
        Permission::create(['name' => 'view teachers']);
        Permission::create(['name' => 'create parents']);
        Permission::create(['name' => 'edit parents']);
        Permission::create(['name' => 'delete parents']);
        Permission::create(['name' => 'view parents']);
        Permission::create(['name' => 'create attendance']);
        Permission::create(['name' => 'edit attendance']);
        Permission::create(['name' => 'delete attendance']);
        Permission::create(['name' => 'view attendance']);
        Permission::create(['name' => 'manage attendance']);
        Permission::create(['name' => 'create reports']);
        Permission::create(['name' => 'edit reports']);
        Permission::create(['name' => 'delete reports']);
        Permission::create(['name' => 'view reports']);
        Permission::create(['name' => 'view classes']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'edit permissions']);
        Permission::create(['name' => 'delete permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'apply permissions to roles']);

        $support = $roles->where('name', 'support')->first();
        if ($support) {
            $support->givePermissionTo([
                'view dashboard',
                'view users',
                'view announcements',
                'view calendar events',
            ]);
        }

        // Give permissions to roles
        $tenantAdmin = $roles->where('name', 'tenant_admin')->first();
        $tenantAdmin->givePermissionTo([
            'manage users',
            'view dashboard',
            'edit users',
            'delete users',
            'assign roles',
            'manage roles',
            'view users',
            'create classes',
            'manage classes',
            'manage announcements',
            'create announcements',
            'edit announcements',
            'delete announcements',
            'view announcements',
            'manage calendar events',
            'create calendar events',
            'edit calendar events',
            'delete calendar events',
            'view calendar events',
            'create students',
            'edit students',
            'delete students',
            'view students',
            'enroll students',
            'unenroll students',
            'create teachers',
            'edit teachers',
            'delete teachers',
            'view teachers',
            'create parents',
            'edit parents',
            'delete parents',
            'view parents',
            'create attendance',
            'edit attendance',
            'delete attendance',
            'view attendance',
            'manage attendance',
            'create reports',
            'edit reports',
            'delete reports',
            'view reports',
            'view classes',
            'create permissions',
            'edit permissions',
            'delete permissions',
            'view permissions',
            'apply permissions to roles',
            'manage settings'
        ]);

        // Give teacher permissions
        $teacher = $roles->where('name', 'teacher')->first();
        if ($teacher) {
            $teacher->givePermissionTo([
                'view dashboard',
                // Announcement permissions
                'create announcements',
                'edit announcements',
                'view announcements',
                // Calendar event permissions
                'create calendar events',
                'edit calendar events',
                'view calendar events',
                // Attendance permissions
                'create attendance',
                'edit attendance',
                'view attendance',
                // Student permissions (view only for teachers)
                'view students',
                // Class permissions
                'view classes',
                // Reports permissions
                'view reports',
            ]);
        }

        // Give basic view permissions to students and parents
        $student = $roles->where('name', 'student')->first();
        if ($student) {
            $student->givePermissionTo(['view announcements', 'view calendar events']);
        }

        $parent = $roles->where('name', 'parent')->first();
        if ($parent) {
            $parent->givePermissionTo(['view announcements', 'view calendar events']);
        }
    }
}

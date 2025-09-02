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
        ]);

        // Give teacher announcement permissions
        $teacher = $roles->where('name', 'teacher')->first();
        if ($teacher) {
            $teacher->givePermissionTo([
                'view dashboard',
                'create announcements',
                'edit announcements',
                'view announcements',
                'create calendar events',
                'edit calendar events',
                'view calendar events',
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

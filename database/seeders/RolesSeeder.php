<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Role::create(
            ['name' => 'admin', ]
        );
        Role::create(
            ['name' => 'support', ]
        );
        Role::create(
            ['name' => 'senior_support', ]
        );
        Role::create(
            ['name' => 'multi_admin']
        );
        Role::create(
            ['name' => 'teacher']
        );
        Role::create(
            ['name' => 'student']
        );
        Role::create(
            ['name' => 'parent']
        );
        Role::create(
            ['name' => 'tenant_admin']
        );
    }
}

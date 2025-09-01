<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CentralAdmin;
use Illuminate\Support\Facades\Hash;

class CentralAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CentralAdmin::create([
            'name' => 'Super Admin',
            'email' => 'admin@schoolio.test',
            'password' => Hash::make('password'),
            'role' => 'super_admin',
            'is_active' => true,
        ]);
    }
}

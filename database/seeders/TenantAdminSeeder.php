<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Tenant;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TenantAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $tenant1 = Tenant::find(1); // Alsahwa Schools
        $tenant1->run(function () {
            // Create tenant users with specific data
            $tenantUser = User::factory()->create([
                'name' => 'Alsahwa Admin',
                'email' => 'kyle@acewebdesign.co.za',
                'password' => bcrypt('Aceweb1!'),
            ]);
            $tenantUser->assignRole('tenant_admin');
        });
    }
}

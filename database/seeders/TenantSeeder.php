<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Stancl\Tenancy\Database\Models\Domain;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $tenant1 = \App\Models\Tenant::factory()->create([
            'id' => 1,
            'name' => 'Alsahwa Schools',
            'email' => 'test@example.com',
            'phone' => '123-456-7890',
            'alt_phone' => '098-765-4321',
            'logo' => 'logo.png',
            'website' => 'https://alsahwa.edu',
            'address' => '123 Main St, City, Country',
            'status' => 'active',
            'plan' => 'premium',
            'trial_ends_at' => now()->addDays(30),
            'payment_method' => 'credit_card',
            'language' => 'en',
            'school_type' => 'private',
            'timezone' => 'UTC',
            'color_scheme' => 'blue',
            'data' => [],
        ]);
        Domain::create(['domain' => 'alsahwa.schoolio.test', 'tenant_id' => $tenant1->id]);

        $tenant2 = \App\Models\Tenant::factory()->create(
            [
                'id' => 2,
                'name' => 'Future Generation Schools',
                'email' => 'future@example.com',
                'phone' => '123-456-7890',
                'alt_phone' => '098-765-4321',
                'logo' => 'logo.png',
                'website' => 'https://future.edu',
                'address' => '456 Elm St, City, Country',
                'status' => 'active',
                'plan' => 'premium',
                'trial_ends_at' => now()->addDays(30),
                'payment_method' => 'credit_card',
                'language' => 'en',
                'school_type' => 'private',
                'timezone' => 'UTC',
                'color_scheme' => 'blue',
                'data' => [],
            ]
        );
        Domain::create(['domain' => 'future.schoolio.test', 'tenant_id' => $tenant2->id]);

        $tenant3 = \App\Models\Tenant::factory()->create([
            'id' => 3,
            'name' => 'Global Academy',
            'email' => 'global@example.com',
            'phone' => '123-456-7890',
            'alt_phone' => '098-765-4321',
            'logo' => 'logo.png',
            'website' => 'https://global.edu',
            'address' => '789 Oak St, City, Country',
            'status' => 'active',
            'plan' => 'premium',
            'trial_ends_at' => now()->addDays(30),
            'payment_method' => 'credit_card',
            'language' => 'en',
            'school_type' => 'private',
            'timezone' => 'UTC',
            'color_scheme' => 'blue',
            'data' => [],
        ]);
        Domain::create(['domain' => 'global.schoolio.test', 'tenant_id' => $tenant3->id]);
    }
}

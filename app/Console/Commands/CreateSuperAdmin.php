<?php

namespace App\Console\Commands;

use App\Models\CentralAdmin;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateSuperAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'central:create-super-admin {--name=} {--email=} {--password=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a super admin for the central tenant management system';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Creating Super Admin for Central Tenant Management...');

        // Get or prompt for details
        $name = $this->option('name') ?? $this->ask('Enter the super admin name');
        $email = $this->option('email') ?? $this->ask('Enter the super admin email');
        $password = $this->option('password') ?? $this->secret('Enter the super admin password');

        // Check if email already exists
        if (CentralAdmin::where('email', $email)->exists()) {
            $this->error('A central admin with this email already exists!');
            return 1;
        }

        // Create the super admin
        $admin = CentralAdmin::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 'super_admin',
            'permissions' => [
                'manage_tenants',
                'view_tenant_data',
                'manage_admins',
                'system_settings',
            ],
            'is_active' => true,
        ]);

        $this->info('Super Admin created successfully!');
        $this->line('Name: ' . $admin->name);
        $this->line('Email: ' . $admin->email);
        $this->line('Role: ' . $admin->role);
        $this->line('You can now login at: /central/login');

        return 0;
    }
}

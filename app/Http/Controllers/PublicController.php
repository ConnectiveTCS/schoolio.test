<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'school_type' => 'required|in:primary,secondary,university,vocational',
        ]);

        $trialEndsAt = now()->addDays(30);

        $tenant = Tenant::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'school_type' => $validated['school_type'],
            'trial_ends_at' => $trialEndsAt,
        ]);

        // Switch to tenant context and seed roles/permissions
        $tenant->run(function () use ($validated) {
            // Clear permission cache and create roles/permissions
            app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

            // Seed roles and permissions within tenant context
            (new \Database\Seeders\RolesSeeder())->run();
            (new \Database\Seeders\PermissionSeeder())->run();

            // Create tenant admin user
            $tenantUser = \App\Models\User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => bcrypt('password'),
            ]);
            $tenantUser->assignRole('tenant_admin');

            // create 1 sample activity
        });

        return redirect('/')->with('status', 'Trial registration successful! You will receive an email with further instructions.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

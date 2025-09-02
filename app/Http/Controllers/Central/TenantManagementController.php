<?php

namespace App\Http\Controllers\Central;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\Domain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stancl\Tenancy\Facades\Tenancy;

class TenantManagementController extends Controller
{
    /**
     * Display a listing of tenants
     */
    public function index(Request $request)
    {
        $user = Auth::guard('central_admin')->user();

        if (!$user->canManageTenants() && !$user->canViewTenantData()) {
            abort(403, 'You do not have permission to view tenants.');
        }

        $query = Tenant::with('domains');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('id', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by plan
        if ($request->filled('plan')) {
            $query->where('plan', $request->plan);
        }

        $tenants = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('central.tenants.index', compact('tenants'));
    }

    /**
     * Show the form for creating a new tenant
     */
    public function create()
    {
        $user = Auth::guard('central_admin')->user();

        if (!$user->canManageTenants()) {
            abort(403, 'You do not have permission to create tenants.');
        }

        return view('central.tenants.create');
    }

    /**
     * Store a newly created tenant
     */
    public function store(Request $request)
    {
        $user = Auth::guard('central_admin')->user();

        if (!$user->canManageTenants()) {
            abort(403, 'You do not have permission to create tenants.');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'alt_phone' => ['nullable', 'string', 'max:20'],
            'website' => ['nullable', 'url', 'max:255'],
            'address' => ['nullable', 'string', 'max:500'],
            'plan' => ['required', 'string', 'in:basic,premium,enterprise'],
            'school_type' => ['required', 'string', 'in:primary,secondary,university,vocational'],
            'language' => ['required', 'string', 'max:10'],
            'timezone' => ['required', 'string', 'max:50'],
            'domain' => ['required', 'string', 'max:255', 'unique:domains,domain'],
        ]);

        DB::transaction(function () use ($request) {
            // Create tenant
            $tenant = Tenant::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'alt_phone' => $request->alt_phone,
                'website' => $request->website,
                'address' => $request->address,
                'status' => 'active',
                'plan' => $request->plan,
                'school_type' => $request->school_type,
                'language' => $request->language,
                'timezone' => $request->timezone,
                'trial_ends_at' => now()->addDays(30), // 30-day trial
            ]);

            // Create domain
            $tenant->domains()->create([
                'domain' => $request->domain,
            ]);
        });

        return redirect()->route('central.tenants.index')
            ->with('success', 'Tenant created successfully.');
    }

    /**
     * Display the specified tenant
     */
    public function show(Tenant $tenant)
    {
        $user = Auth::guard('central_admin')->user();

        if (!$user->canViewTenantData()) {
            abort(403, 'You do not have permission to view tenant details.');
        }

        $tenant->load('domains');

        // Get tenant statistics
        $stats = $this->getTenantStats($tenant);

        return view('central.tenants.show', compact('tenant', 'stats'));
    }

    /**
     * Show the form for editing the specified tenant
     */
    public function edit(Tenant $tenant)
    {
        $user = Auth::guard('central_admin')->user();

        if (!$user->canManageTenants()) {
            abort(403, 'You do not have permission to edit tenants.');
        }

        $tenant->load('domains');

        return view('central.tenants.edit', compact('tenant'));
    }

    /**
     * Update the specified tenant
     */
    public function update(Request $request, Tenant $tenant)
    {
        $user = Auth::guard('central_admin')->user();

        if (!$user->canManageTenants()) {
            abort(403, 'You do not have permission to update tenants.');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'alt_phone' => ['nullable', 'string', 'max:20'],
            'website' => ['nullable', 'url', 'max:255'],
            'address' => ['nullable', 'string', 'max:500'],
            'status' => ['required', 'string', 'in:active,suspended,inactive'],
            'plan' => ['required', 'string', 'in:basic,premium,enterprise'],
            'school_type' => ['required', 'string', 'in:primary,secondary,university,vocational'],
            'language' => ['required', 'string', 'max:10'],
            'timezone' => ['required', 'string', 'max:50'],
            'trial_ends_at' => ['nullable', 'date'],
            'payment_method' => ['nullable', 'string', 'in:stripe,paypal,bank_transfer,cash'],
        ]);

        $updateData = $request->only([
            'name',
            'email',
            'phone',
            'alt_phone',
            'website',
            'address',
            'status',
            'plan',
            'school_type',
            'language',
            'timezone',
            'payment_method'
        ]);

        if ($request->filled('trial_ends_at')) {
            $updateData['trial_ends_at'] = $request->trial_ends_at;
        }

        $tenant->update($updateData);

        return redirect()->route('central.tenants.show', $tenant)
            ->with('success', 'Tenant updated successfully.');
    }

    /**
     * Remove the specified tenant
     */
    public function destroy(Tenant $tenant)
    {
        $user = Auth::guard('central_admin')->user();

        if (!$user->canManageTenants()) {
            abort(403, 'You do not have permission to delete tenants.');
        }

        // This will also delete the tenant's database and related data
        $tenant->delete();

        return redirect()->route('central.tenants.index')
            ->with('success', 'Tenant deleted successfully.');
    }

    /**
     * Suspend a tenant
     */
    public function suspend(Tenant $tenant)
    {
        $user = Auth::guard('central_admin')->user();

        if (!$user->canManageTenants()) {
            abort(403, 'You do not have permission to suspend tenants.');
        }

        $tenant->update(['status' => 'suspended']);

        return back()->with('success', 'Tenant suspended successfully.');
    }

    /**
     * Activate a tenant
     */
    public function activate(Tenant $tenant)
    {
        $user = Auth::guard('central_admin')->user();

        if (!$user->canManageTenants()) {
            abort(403, 'You do not have permission to activate tenants.');
        }

        $tenant->update(['status' => 'active']);

        return back()->with('success', 'Tenant activated successfully.');
    }

    /**
     * Get tenant statistics
     */
    private function getTenantStats(Tenant $tenant)
    {
        $stats = [];

        try {
            // Switch to tenant context to get statistics
            tenancy()->initialize($tenant);

            $stats = [
                'users_count' => DB::connection('tenant')->table('users')->count(),
                'students_count' => DB::connection('tenant')->table('tenant_students')->count(),
                'teachers_count' => DB::connection('tenant')->table('tenant_teachers')->count(),
                'classes_count' => DB::connection('tenant')->table('tenant_classes')->count(),
                'announcements_count' => DB::connection('tenant')->table('announcements')->count(),
            ];

            // End tenant context
            tenancy()->end();
        } catch (\Exception $e) {
            // If tenant database doesn't exist or has issues
            $stats = [
                'users_count' => 0,
                'students_count' => 0,
                'teachers_count' => 0,
                'classes_count' => 0,
                'announcements_count' => 0,
                'error' => 'Unable to fetch tenant statistics',
            ];
        }

        return $stats;
    }

    /**
     * Impersonate tenant (switch to tenant context for admin)
     */
    public function impersonate(Tenant $tenant)
    {
        $user = Auth::guard('central_admin')->user();

        if (!$user->canManageTenants()) {
            abort(403, 'You do not have permission to impersonate tenants.');
        }

        // Get the tenant's primary domain
        $domain = $tenant->domains->first();

        if (!$domain) {
            return back()->with('error', 'Tenant has no domain configured.');
        }

        // Generate impersonation token
        $token = \App\Models\ImpersonationToken::generate($tenant->id, $user->id);

        // Build the impersonation URL
        $impersonationUrl = 'http://' . $domain->domain . '/impersonate?impersonation_token=' . $token->token;

        return redirect()->away($impersonationUrl);
    }

    /**
     * Store a new domain for the tenant
     */
    public function storeDomain(Request $request, Tenant $tenant)
    {
        $user = Auth::guard('central_admin')->user();

        if (!$user->canManageTenants()) {
            return response()->json(['message' => 'You do not have permission to manage domains.'], 403);
        }

        $request->validate([
            'domain' => [
                'required',
                'string',
                'max:255',
                'unique:domains,domain',
                'regex:/^[a-zA-Z0-9][a-zA-Z0-9-]*[a-zA-Z0-9]*\.[a-zA-Z0-9][a-zA-Z0-9.-]*[a-zA-Z0-9]$/'
            ],
        ], [
            'domain.regex' => 'Please enter a valid domain name (e.g., example.com or subdomain.schoolio.test)',
        ]);

        try {
            $domain = strtolower(trim($request->domain));

            // Remove http/https if provided
            $domain = preg_replace('#^https?://#', '', $domain);
            $domain = rtrim($domain, '/');

            $tenant->domains()->create([
                'domain' => $domain,
            ]);

            return response()->json(['message' => 'Domain added successfully.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error adding domain: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Delete a domain from the tenant
     */
    public function destroyDomain(Tenant $tenant, $domainId)
    {
        $user = Auth::guard('central_admin')->user();

        if (!$user->canManageTenants()) {
            return response()->json(['message' => 'You do not have permission to manage domains.'], 403);
        }

        try {
            $domain = $tenant->domains()->findOrFail($domainId);

            // Allow deletion if tenant has multiple domains
            if ($tenant->domains()->count() <= 1) {
                return response()->json([
                    'message' => 'Cannot delete the last domain. Tenant must have at least one domain for access.'
                ], 400);
            }

            $domainName = $domain->domain;
            $domain->delete();

            return response()->json(['message' => "Domain '{$domainName}' deleted successfully."]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Domain not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error deleting domain: ' . $e->getMessage()], 500);
        }
    }
}

<?php

namespace App\Http\Controllers\Central;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\Domain;
use App\Models\User;
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

        // Phase 1: Get tenant role & user snapshot (read-only)
        $roleSnapshot = $this->getTenantRoleSnapshot($tenant);

        return view('central.tenants.show', compact('tenant', 'stats', 'roleSnapshot'));
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
     * Get a snapshot of tenant roles and sample users (read-only, Phase 1)
     */
    private function getTenantRoleSnapshot(Tenant $tenant): array
    {
        $snapshot = [];
        try {
            tenancy()->initialize($tenant);

            // Verify required tables exist before querying (defensive in case of partial migrations)
            $connection = DB::connection('tenant');
            $schema = $connection->getSchemaBuilder();
            $requiredTables = ['users', 'roles', 'model_has_roles', 'permissions', 'role_has_permissions'];
            foreach ($requiredTables as $tbl) {
                if (!$schema->hasTable($tbl)) {
                    throw new \RuntimeException("Missing table '{$tbl}' in tenant database.");
                }
            }

            // Role counts
            $roles = $connection->table('roles')
                ->leftJoin('model_has_roles', function ($join) {
                    $join->on('roles.id', '=', 'model_has_roles.role_id')
                        ->where('model_has_roles.model_type', '=', User::class);
                })
                ->select('roles.name', DB::raw('COUNT(model_has_roles.model_id) as users_count'))
                ->groupBy('roles.id', 'roles.name')
                ->orderBy('roles.name')
                ->get();

            // Permissions per role (build associative array role_name => [permissions])
            $rolesPermissions = [];
            foreach ($roles as $roleRow) {
                $perms = $connection->table('permissions')
                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                    ->join('roles as r2', 'r2.id', '=', 'role_has_permissions.role_id')
                    ->where('r2.name', $roleRow->name)
                    ->orderBy('permissions.name')
                    ->pluck('permissions.name')
                    ->toArray();
                $rolesPermissions[$roleRow->name] = $perms;
            }

            // Sample users (first 15) with roles via Eloquent for convenience
            $users = User::with('roles')
                ->orderBy('id')
                ->limit(15)
                ->get()
                ->map(function ($u) {
                    return [
                        'id' => $u->id,
                        'name' => $u->name,
                        'email' => $u->email,
                        'roles' => $u->roles->pluck('name')->values()->all(),
                    ];
                });

            // Total users count (reuse existing stats if available later; count directly here for isolation)
            $totalUsers = $connection->table('users')->count();

            $snapshot = [
                'roles' => $roles,
                'users' => $users,
                'total_users' => $totalUsers,
                'roles_permissions' => $rolesPermissions,
            ];
        } catch (\Throwable $e) {
            $snapshot = [
                'error' => 'Unable to fetch role/permission snapshot: ' . $e->getMessage(),
            ];
        } finally {
            // Ensure tenant context is ended
            try {
                tenancy()->end();
            } catch (\Throwable $e) {
                // swallow
            }
        }

        return $snapshot;
    }

    /**
     * Phase 2: Update a tenant user's primary role (sync to single role)
     */
    public function updateTenantUserRole(Request $request, Tenant $tenant, $userId)
    {
        $centralUser = Auth::guard('central_admin')->user();
        if (!$centralUser->canManageTenants()) {
            abort(403, 'You do not have permission to modify tenant users.');
        }

        $request->validate([
            'role' => 'required|string|max:100',
        ]);

        $newRole = $request->input('role');

        try {
            tenancy()->initialize($tenant);

            // Validate target role exists in tenant context
            $roleExists = DB::connection('tenant')->table('roles')->where('name', $newRole)->exists();
            if (!$roleExists) {
                return back()->with('error', 'Selected role does not exist in tenant.');
            }

            $user = User::findOrFail($userId);
            $user->syncRoles([$newRole]);

            return back()->with('success', 'User role updated.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return back()->with('error', 'User not found in tenant.');
        } catch (\Throwable $e) {
            return back()->with('error', 'Unable to update role: ' . $e->getMessage());
        } finally {
            try {
                tenancy()->end();
            } catch (\Throwable $e) {
            }
        }
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

    /**
     * Handle bulk actions on tenants
     */
    public function bulk(Request $request)
    {
        $user = Auth::guard('central_admin')->user();

        if (!$user->canManageTenants()) {
            abort(403, 'You do not have permission to manage tenants.');
        }

        $request->validate([
            'action' => 'required|in:suspend,activate,delete',
            'tenants' => 'required|array|min:1',
            'tenants.*' => 'exists:tenants,id',
        ]);

        $action = $request->input('action');
        $tenantIds = $request->input('tenants');
        $successCount = 0;
        $errors = [];

        foreach ($tenantIds as $tenantId) {
            try {
                $tenant = Tenant::findOrFail($tenantId);

                switch ($action) {
                    case 'suspend':
                        if ($tenant->status !== 'suspended') {
                            $tenant->update(['status' => 'suspended']);
                            $successCount++;
                        }
                        break;

                    case 'activate':
                        if ($tenant->status !== 'active') {
                            $tenant->update(['status' => 'active']);
                            $successCount++;
                        }
                        break;

                    case 'delete':
                        // Only allow deletion of suspended tenants for safety
                        if ($tenant->status === 'suspended') {
                            $tenant->delete();
                            $successCount++;
                        } else {
                            $errors[] = "Tenant '{$tenant->name}' must be suspended before deletion.";
                        }
                        break;
                }
            } catch (\Exception $e) {
                $errors[] = "Error processing tenant ID {$tenantId}: " . $e->getMessage();
            }
        }

        $message = "Successfully {$action}d {$successCount} tenant(s).";
        if (!empty($errors)) {
            $message .= " Errors: " . implode(', ', $errors);
        }

        return redirect()->route('central.tenants.index')->with('success', $message);
    }

    /**
     * Export tenants data
     */
    public function export(Request $request)
    {
        $user = Auth::guard('central_admin')->user();

        if (!$user->canViewTenantData()) {
            abort(403, 'You do not have permission to export tenant data.');
        }

        // Default format for GET requests (export all)
        $format = $request->input('format', 'csv');
        $exportAll = $request->has('all') || $request->isMethod('get');

        if (!$exportAll) {
            $request->validate([
                'format' => 'sometimes|in:csv,excel,pdf',
                'tenants' => 'required|array|min:1',
                'tenants.*' => 'exists:tenants,id',
            ]);
        }

        $selectedTenants = $request->input('tenants', []);

        // Build query
        $query = Tenant::with('domains');

        if (!$exportAll && !empty($selectedTenants)) {
            $query->whereIn('id', $selectedTenants);
        }

        // Apply same filters as index if they exist in session or request
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('id', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('plan')) {
            $query->where('plan', $request->plan);
        }

        $tenants = $query->orderBy('created_at', 'desc')->get();

        switch ($format) {
            case 'csv':
                return $this->exportToCsv($tenants);
            case 'excel':
                return $this->exportToExcel($tenants);
            case 'pdf':
                return $this->exportToPdf($tenants);
            default:
                return redirect()->back()->with('error', 'Invalid export format.');
        }
    }

    /**
     * Export tenants to CSV
     */
    private function exportToCsv($tenants)
    {
        $filename = 'tenants_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($tenants) {
            $file = fopen('php://output', 'w');

            // Add CSV headers
            fputcsv($file, [
                'ID',
                'Name',
                'Email',
                'Status',
                'Plan',
                'Domains',
                'Created At',
                'Updated At'
            ]);

            // Add data rows
            foreach ($tenants as $tenant) {
                fputcsv($file, [
                    $tenant->id,
                    $tenant->name,
                    $tenant->email,
                    $tenant->status,
                    $tenant->plan,
                    $tenant->domains->pluck('domain')->implode(', '),
                    $tenant->created_at->format('Y-m-d H:i:s'),
                    $tenant->updated_at->format('Y-m-d H:i:s')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Export tenants to Excel (basic implementation)
     */
    private function exportToExcel($tenants)
    {
        // For now, we'll use CSV format with .xlsx extension
        // In a real application, you might want to use Laravel Excel package
        $filename = 'tenants_' . date('Y-m-d_H-i-s') . '.xlsx';

        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        // For simplicity, returning CSV format
        // TODO: Implement proper Excel export using Laravel Excel package
        return $this->exportToCsv($tenants);
    }

    /**
     * Export tenants to PDF
     */
    private function exportToPdf($tenants)
    {
        // Basic HTML to PDF conversion
        // In a real application, you might want to use a proper PDF library like DomPDF
        $html = view('central.tenants.export-pdf', compact('tenants'))->render();

        $filename = 'tenants_' . date('Y-m-d_H-i-s') . '.pdf';

        // For now, return as HTML
        // TODO: Implement proper PDF generation
        return response($html)
            ->header('Content-Type', 'text/html')
            ->header('Content-Disposition', "attachment; filename=\"{$filename}\"");
    }

    /**
     * Generate health report for all tenants
     */
    public function healthReport(Request $request)
    {
        $user = Auth::guard('central_admin')->user();

        if (!$user->canViewTenantData()) {
            abort(403, 'You do not have permission to view health reports.');
        }

        // Get all tenants with their related data
        $tenants = Tenant::with('domains')->get();

        // Calculate health metrics
        $totalTenants = $tenants->count();
        $activeTenants = $tenants->where('status', 'active')->count();
        $suspendedTenants = $tenants->where('status', 'suspended')->count();
        $inactiveTenants = $tenants->where('status', 'inactive')->count();

        // Calculate percentages
        $activePercentage = $totalTenants > 0 ? round(($activeTenants / $totalTenants) * 100, 1) : 0;
        $suspendedPercentage = $totalTenants > 0 ? round(($suspendedTenants / $totalTenants) * 100, 1) : 0;
        $inactivePercentage = $totalTenants > 0 ? round(($inactiveTenants / $totalTenants) * 100, 1) : 0;

        // Get recent activity (tenants created in last 30 days)
        $recentTenants = $tenants->where('created_at', '>=', now()->subDays(30))->count();

        // Get domain statistics
        $totalDomains = 0;
        $tenantsWithDomains = 0;
        $tenantsWithoutDomains = 0;

        foreach ($tenants as $tenant) {
            $domainCount = $tenant->domains->count();
            $totalDomains += $domainCount;

            if ($domainCount > 0) {
                $tenantsWithDomains++;
            } else {
                $tenantsWithoutDomains++;
            }
        }

        // Plan distribution
        $planDistribution = $tenants->groupBy('plan')->map(function ($group) {
            return $group->count();
        });

        // Prepare health data
        $healthData = [
            'overview' => [
                'total_tenants' => $totalTenants,
                'active_tenants' => $activeTenants,
                'suspended_tenants' => $suspendedTenants,
                'inactive_tenants' => $inactiveTenants,
                'active_percentage' => $activePercentage,
                'suspended_percentage' => $suspendedPercentage,
                'inactive_percentage' => $inactivePercentage,
                'recent_tenants' => $recentTenants,
            ],
            'domains' => [
                'total_domains' => $totalDomains,
                'tenants_with_domains' => $tenantsWithDomains,
                'tenants_without_domains' => $tenantsWithoutDomains,
                'average_domains_per_tenant' => $totalTenants > 0 ? round($totalDomains / $totalTenants, 1) : 0,
            ],
            'plans' => $planDistribution,
            'recent_activity' => $tenants->where('created_at', '>=', now()->subDays(7))->sortByDesc('created_at')->take(5),
            'issues' => [
                'tenants_without_domains' => $tenants->filter(function ($tenant) {
                    return $tenant->domains->count() === 0;
                })->take(5),
                'suspended_tenants' => $tenants->where('status', 'suspended')->take(5),
            ]
        ];

        // If this is an AJAX request, return HTML content
        if ($request->ajax()) {
            $html = $this->generateHealthReportHtml($healthData);
            return response($html);
        }

        // Return the full health report view (if needed)
        return view('central.tenants.health-report', compact('healthData'));
    }

    /**
     * Generate HTML for health report
     */
    private function generateHealthReportHtml($healthData)
    {
        $overview = $healthData['overview'];
        $domains = $healthData['domains'];
        $plans = $healthData['plans'];

        $html = '
        <div class="space-y-6">
            <!-- Overview Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="text-blue-800 text-sm font-medium">Total Tenants</div>
                    <div class="text-2xl font-bold text-blue-900">' . $overview['total_tenants'] . '</div>
                </div>
                <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                    <div class="text-green-800 text-sm font-medium">Active Tenants</div>
                    <div class="text-2xl font-bold text-green-900">' . $overview['active_tenants'] . '</div>
                    <div class="text-green-600 text-sm">' . $overview['active_percentage'] . '%</div>
                </div>
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <div class="text-yellow-800 text-sm font-medium">Suspended Tenants</div>
                    <div class="text-2xl font-bold text-yellow-900">' . $overview['suspended_tenants'] . '</div>
                    <div class="text-yellow-600 text-sm">' . $overview['suspended_percentage'] . '%</div>
                </div>
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                    <div class="text-gray-800 text-sm font-medium">Inactive Tenants</div>
                    <div class="text-2xl font-bold text-gray-900">' . $overview['inactive_tenants'] . '</div>
                    <div class="text-gray-600 text-sm">' . $overview['inactive_percentage'] . '%</div>
                </div>
            </div>

            <!-- Domain Statistics -->
            <div class="bg-white border border-gray-200 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Domain Statistics</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div>
                        <div class="text-sm text-gray-600">Total Domains</div>
                        <div class="text-xl font-bold text-gray-900">' . $domains['total_domains'] . '</div>
                    </div>
                    <div>
                        <div class="text-sm text-gray-600">With Domains</div>
                        <div class="text-xl font-bold text-gray-900">' . $domains['tenants_with_domains'] . '</div>
                    </div>
                    <div>
                        <div class="text-sm text-gray-600">Without Domains</div>
                        <div class="text-xl font-bold text-gray-900">' . $domains['tenants_without_domains'] . '</div>
                    </div>
                    <div>
                        <div class="text-sm text-gray-600">Avg per Tenant</div>
                        <div class="text-xl font-bold text-gray-900">' . $domains['average_domains_per_tenant'] . '</div>
                    </div>
                </div>
            </div>

            <!-- Plan Distribution -->
            <div class="bg-white border border-gray-200 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Plan Distribution</h3>
                <div class="space-y-2">';

        foreach ($plans as $plan => $count) {
            $percentage = $overview['total_tenants'] > 0 ? round(($count / $overview['total_tenants']) * 100, 1) : 0;
            $html .= '
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">' . ucfirst($plan) . '</span>
                        <span class="text-sm font-medium text-gray-900">' . $count . ' (' . $percentage . '%)</span>
                    </div>';
        }

        $html .= '
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white border border-gray-200 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Activity</h3>
                <div class="text-sm text-gray-600">
                    <p>' . $overview['recent_tenants'] . ' new tenants in the last 30 days</p>
                </div>
            </div>
        </div>';

        return $html;
    }
}

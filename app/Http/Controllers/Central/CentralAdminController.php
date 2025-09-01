<?php

namespace App\Http\Controllers\Central;

use App\Models\CentralAdmin;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class CentralAdminController extends Controller
{
    /**
     * Get all available permissions dynamically
     */
    private function getAvailablePermissions()
    {
        // Get all unique permissions from both sources:
        // 1. Spatie permissions from database
        // 2. Permissions currently assigned to admins
        $spatiePermissions = Permission::all()->pluck('name')->toArray();

        // Get all permissions currently used by admins
        $adminPermissions = CentralAdmin::whereNotNull('permissions')
            ->get()
            ->pluck('permissions')
            ->flatten()
            ->unique()
            ->filter() // Remove empty values
            ->toArray();

        // Combine and get unique permissions
        return collect($spatiePermissions)
            ->merge($adminPermissions)
            ->unique()
            ->filter(function ($permission) {
                // Filter out empty or whitespace-only permissions
                return !empty(trim($permission));
            })
            ->sort()
            ->mapWithKeys(function ($permission) {
                $cleanPermission = trim($permission);
                return [$cleanPermission => ucwords(str_replace('_', ' ', $cleanPermission))];
            })
            ->toArray();
    }

    /**
     * Display the admin dashboard
     */
    public function dashboard()
    {
        $user = Auth::guard('central_admin')->user();

        if (!$user->canManageTenants() && !$user->canViewTenantData()) {
            abort(403, 'You do not have permission to access the admin dashboard.');
        }

        return view('central.dashboard', compact('user'));
    }

    /**
     * Display a listing of central admins
     */
    public function index()
    {
        $user = Auth::guard('central_admin')->user();

        if (!$user->hasPermission('manage_admins')) {
            abort(403, 'You do not have permission to manage admins.');
        }

        $admins = CentralAdmin::orderBy('created_at', 'desc')->paginate(15);

        return view('central.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new admin
     */
    public function create()
    {
        $user = Auth::guard('central_admin')->user();

        if (!$user->hasPermission('manage_admins')) {
            abort(403, 'You do not have permission to create admins.');
        }

        $roles = ['admin', 'viewer'];
        if ($user->role === 'super_admin') {
            $roles[] = 'super_admin';
        }

        $permissions = $this->getAvailablePermissions();

        return view('central.admins.create', compact('roles', 'permissions'));
    }

    /**
     * Store a newly created admin
     */
    public function store(Request $request)
    {
        $user = Auth::guard('central_admin')->user();

        if (!$user->hasPermission('manage_admins')) {
            abort(403, 'You do not have permission to create admins.');
        }

        $availablePermissions = array_keys($this->getAvailablePermissions());

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:central_admins'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:super_admin,admin,viewer'],
            'permissions' => ['array'],
            'permissions.*' => ['string', 'in:' . implode(',', $availablePermissions)],
        ]);

        // Prevent non-super-admin from creating super-admin
        if ($request->role === 'super_admin' && $user->role !== 'super_admin') {
            abort(403, 'Only super admins can create super admin accounts.');
        }

        CentralAdmin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'permissions' => $request->permissions ?? [],
            'is_active' => true,
        ]);

        return redirect()->route('central.admins.index')
            ->with('success', 'Admin created successfully.');
    }

    /**
     * Display the specified admin
     */
    public function show(CentralAdmin $admin)
    {
        $user = Auth::guard('central_admin')->user();

        if (!$user->hasPermission('manage_admins')) {
            abort(403, 'You do not have permission to view admin details.');
        }

        return view('central.admins.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified admin
     */
    public function edit(CentralAdmin $admin)
    {
        $user = Auth::guard('central_admin')->user();

        if (!$user->hasPermission('manage_admins')) {
            abort(403, 'You do not have permission to edit admins.');
        }

        $roles = ['admin', 'viewer'];
        if ($user->role === 'super_admin') {
            $roles[] = 'super_admin';
        }

        $permissions = $this->getAvailablePermissions();

        return view('central.admins.edit', compact('admin', 'roles', 'permissions'));
    }

    /**
     * Update the specified admin
     */
    public function update(Request $request, CentralAdmin $admin)
    {
        $user = Auth::guard('central_admin')->user();

        if (!$user->hasPermission('manage_admins')) {
            abort(403, 'You do not have permission to update admins.');
        }

        $availablePermissions = array_keys($this->getAvailablePermissions());

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:central_admins,email,' . $admin->id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:super_admin,admin,viewer'],
            'permissions' => ['array'],
            'permissions.*' => ['string', 'in:' . implode(',', $availablePermissions)],
            'is_active' => ['boolean'],
        ]);

        // Prevent non-super-admin from editing super-admin or setting super-admin role
        if (($admin->role === 'super_admin' || $request->role === 'super_admin') && $user->role !== 'super_admin') {
            abort(403, 'Only super admins can edit super admin accounts.');
        }

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'permissions' => $request->permissions ?? [],
            'is_active' => $request->boolean('is_active', true),
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $admin->update($updateData);

        return redirect()->route('central.admins.index')
            ->with('success', 'Admin updated successfully.');
    }

    /**
     * Remove the specified admin
     */
    public function destroy(CentralAdmin $admin)
    {
        $user = Auth::guard('central_admin')->user();

        if (!$user->hasPermission('manage_admins')) {
            abort(403, 'You do not have permission to delete admins.');
        }

        // Prevent deleting super admin or self
        if ($admin->role === 'super_admin' || $admin->id === $user->id) {
            return back()->with('error', 'Cannot delete this admin account.');
        }

        $admin->delete();

        return redirect()->route('central.admins.index')
            ->with('success', 'Admin deleted successfully.');
    }

    public function permissions()
    {
        $user = Auth::guard('central_admin')->user();

        if (!$user->hasPermission('view_permissions')) {
            abort(403, 'You do not have permission to view permissions.');
        }

        $permissions = Permission::all()->pluck('name')->toArray();
        // count
        $permissionsCount = count($permissions);
        // $permissionsAll = Permission::pluck('name');

        $permissionsAll = Permission::all()->pluck('name');
        $rolesAll = Role::all()->pluck('name');
        $permissionsWithRoles = Permission::with('roles')->get();

        return view('central.permissions.index', compact('permissions', 'permissionsCount', 'permissionsAll', 'rolesAll', 'permissionsWithRoles'));
    }

    public function permissionsCreate(Request $request)
    {
        $user = Auth::guard('central_admin')->user();
        if (!$user->hasPermission('create_permissions') && $user->role !== 'super_admin') {
            abort(403, 'You do not have permission to create permissions.');
        }

        $request->validate([
            'name' => 'required|string|max:150',
        ]);
        // convert to lowercase
        $permissionName = strtolower($request->name);

        // Use firstOrCreate to avoid duplicate permission errors and specify the guard
        $permissions = Permission::firstOrCreate([
            'name' => $permissionName,
            'guard_name' => 'central_admin'
        ]);

        return redirect()->route('central.permissions.index')->with('success', 'Permission created successfully.');
    }
}

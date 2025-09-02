<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\Announcement;
use App\Models\TenantStudents;
use App\Models\TenantClasses;
use App\Models\TenantTeacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class TenantController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get the current tenant using the tenant() helper function
        $tenant = tenant();

        // Check if tenancy is initialized
        if (!tenancy()->initialized || !$tenant) {
            abort(404, 'Tenant not found');
        }



        // Access various tenant properties
        $tenantData = [
            'id' => $tenant->id,
            'name' => $tenant->name,
            'email' => $tenant->email,
            'phone' => $tenant->phone,
            'alt_phone' => $tenant->alt_phone,
            'logo' => $tenant->logo,
            'website' => $tenant->website,
            'address' => $tenant->address,
            'status' => $tenant->status,
            'plan' => $tenant->plan,
            'trial_ends_at' => $tenant->trial_ends_at,
            'payment_method' => $tenant->payment_method,
            'language' => $tenant->language,
            'school_type' => $tenant->school_type,
            'timezone' => $tenant->timezone,
            'color_scheme' => $tenant->color_scheme,
        ];

        // If user is already authenticated, redirect to dashboard
        if (\Illuminate\Support\Facades\Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('tenants.index', compact('tenant', 'tenantData'));
    }

    // Dashboard view
    public function dashboard()
    {
        // Get the current tenant
        $tenant = tenant();

        // Get user's announcements
        $user = Auth::user();
        $userRoles = $user->getRoleNames()->toArray();

        $recentAnnouncements = Announcement::active()
            ->forRoles($userRoles)
            ->with('creator')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        // Get real dashboard data
        $dashboardData = [
            'total_students' => $this->getTotalStudents(),
            'active_courses' => $this->getActiveCourses(),
            'total_teachers' => $this->getTotalTeachers(),
            'attendance_rate' => $this->getAttendanceRate(),
            'recent_activities' => $this->getRecentActivities(),
            'upcoming_events' => $this->getUpcomingEvents(),
            'announcements' => $recentAnnouncements
        ];

        return view('tenants.dashboard', compact('tenant', 'dashboardData'));
    }

    public function settings()
    {
        // Get the current tenant
        $tenant = tenant();

        return view('tenants.settings.index', compact('tenant'));
    }

    public function updateSettings(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'alt_phone' => 'nullable|string|max:20',
            'website' => 'nullable|url|max:255',
            'address' => 'nullable|string|max:500',
            'status' => 'nullable|in:active,inactive,suspended',
            'plan' => 'nullable|string|max:100',
            'trial_ends_at' => 'nullable|date',
            'payment_method' => 'nullable|string|max:100',
            'language' => 'required|string|max:50',
            'school_type' => 'nullable|string|max:100',
            'timezone' => 'required|string|max:100',
            'color_scheme' => 'nullable|string|max:50',
        ]);

        // Get the current tenant
        $tenant = tenant();

        // Remove logo from validated data for mass assignment
        $updateData = collect($validatedData)->except('logo')->toArray();

        // Handle logo upload if present
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $updateData['logo'] = $logoPath;
        }

        // Update tenant details
        $tenant->update($updateData);

        return redirect()->route('settings')->with('success', 'Settings updated successfully.');
    }

    public function serveFile($path)
    {
        $tenant = tenant();
        $filePath = storage_path("app/public/{$path}");

        if (!file_exists($filePath)) {
            abort(404);
        }

        return response()->file($filePath);
    }

    public function listUsers()
    {
        // Get the current tenant
        $tenant = tenant();

        // Fetch all users from the current tenant database
        // In a multi-tenant setup, users exist within each tenant's context
        $users = \App\Models\User::all();

        return view('tenants.users.index', compact('tenant', 'users'));
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
    }

    /**
     * Display the specified resource.
     */
    public function show(Tenant $tenant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tenant $tenant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tenant $tenant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant)
    {
        //
    }

    /**
     * Get total number of students
     */
    private function getTotalStudents()
    {
        return TenantStudents::count();
    }

    /**
     * Get number of active courses/classes
     */
    private function getActiveCourses()
    {
        return TenantClasses::count();
    }

    /**
     * Get total number of teachers
     */
    private function getTotalTeachers()
    {
        return TenantTeacher::count();
    }

    /**
     * Get attendance rate (placeholder - implement based on attendance system)
     */
    private function getAttendanceRate()
    {
        // Placeholder calculation - implement based on your attendance model
        return 94; // Return a sample value for now
    }

    /**
     * Get recent activities from various sources
     */
    private function getRecentActivities()
    {
        $activities = collect();

        // Recent student enrollments
        $recentStudents = TenantStudents::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        foreach ($recentStudents as $student) {
            $activities->push([
                'activity' => "New student enrolled: {$student->user->name}",
                'time' => $student->created_at->diffForHumans(),
                'type' => 'enrollment',
                'created_at' => $student->created_at
            ]);
        }

        // Recent teacher additions
        $recentTeachers = TenantTeacher::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(2)
            ->get();

        foreach ($recentTeachers as $teacher) {
            $activities->push([
                'activity' => "New teacher added: {$teacher->user->name}",
                'time' => $teacher->created_at->diffForHumans(),
                'type' => 'staff',
                'created_at' => $teacher->created_at
            ]);
        }

        // Recent announcements
        $recentAnnouncements = Announcement::with('creator')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        foreach ($recentAnnouncements as $announcement) {
            $activities->push([
                'activity' => "New announcement: {$announcement->title}",
                'time' => $announcement->created_at->diffForHumans(),
                'type' => 'announcement',
                'created_at' => $announcement->created_at
            ]);
        }

        // Recent classes created
        $recentClasses = TenantClasses::orderBy('created_at', 'desc')
            ->limit(2)
            ->get();

        foreach ($recentClasses as $class) {
            $activities->push([
                'activity' => "New class created: {$class->class_name}",
                'time' => $class->created_at->diffForHumans(),
                'type' => 'class',
                'created_at' => $class->created_at
            ]);
        }

        // If no real activities, add some sample data for testing
        if ($activities->isEmpty()) {
            $activities->push([
                'activity' => 'New student enrolled: John Doe',
                'time' => '2 hours ago',
                'type' => 'enrollment',
                'created_at' => now()->subHours(2)
            ]);
            $activities->push([
                'activity' => 'New announcement: Welcome to the new semester',
                'time' => '1 day ago',
                'type' => 'announcement',
                'created_at' => now()->subDay()
            ]);
            $activities->push([
                'activity' => 'New class created: Mathematics 101',
                'time' => '3 days ago',
                'type' => 'class',
                'created_at' => now()->subDays(3)
            ]);
        }

        // Sort by creation date and return top 8
        return $activities->sortByDesc('created_at')->take(8)->values()->all();
    }

    /**
     * Get upcoming events (placeholder data)
     */
    private function getUpcomingEvents()
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return [];
            }
            $roles = $user->getRoleNames()->toArray();
            $events = \App\Models\CalendarEvent::published()
                ->forRoles($roles)
                ->upcoming()
                ->limit(3)
                ->get();
            if ($events->isEmpty()) {
                return [];
            }
            return $events->map(function ($e) {
                return [
                    'title' => $e->title,
                    'date' => $e->start_at->format('M d, Y'),
                    'time' => $e->all_day ? null : $e->start_at->format('g:i A'),
                ];
            })->toArray();
        } catch (\Throwable $e) {
            return [];
        }
    }

    /**
     * Get activities for API
     */
    public function getActivities()
    {
        $activities = $this->getRecentActivities();
        return response()->json([
            'status' => 'success',
            'data' => $activities
        ]);
    }

    /**
     * Clear a specific activity
     */
    public function clearActivity($index)
    {
        // In a real application, you would track which activities the user has cleared
        // For now, we'll just return success and let the frontend handle the removal
        return response()->json([
            'status' => 'success',
            'message' => 'Activity cleared successfully'
        ]);
    }

    /**
     * Clear all activities for the current user
     */
    public function clearAllActivities()
    {
        // In a real application, you would mark all activities as read/cleared for the current user
        // For now, we'll just return success and let the frontend handle the removal
        return response()->json([
            'status' => 'success',
            'message' => 'All activities cleared successfully'
        ]);
    }
}

<?php

namespace App\Http\Controllers\Tenants;

use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Models\TenantClasses;
use App\Http\Controllers\Controller;
use App\Models\ReviewTicket;
use Illuminate\Support\Facades\Auth;

class TenantClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $tenant = tenant();
        $teachers = \App\Models\TenantTeacher::all();

        // If user is tenant_admin, show all classes
        if ($user->hasRole('tenant_admin')) {
            $classes = TenantClasses::withCount('students')->get();
        } else if ($user->hasRole('teacher') && $user->teacher) {
            // For teachers, only show classes they are assigned to
            $classes = TenantClasses::withCount('students')
                ->where('teacher_id', $user->teacher->id)
                ->get();
        } else {
            // For other roles, show no classes
            $classes = collect();
        }

        return view('tenants.classes.index', compact('tenant', 'classes', 'teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $tenant = tenant();

        // If user is tenant_admin, show all teachers
        if ($user->hasRole('tenant_admin')) {
            $teachers = \App\Models\TenantTeacher::all();
        } else if ($user->hasRole('teacher') && $user->teacher) {
            // For teachers, only allow them to select themselves
            $teachers = collect([$user->teacher]);
        } else {
            // For other roles, show no teachers
            $teachers = collect();
        }

        return view('tenants.classes.create', compact('tenant', 'teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'teacher_id' => 'required|exists:tenant_teachers,id',
            'name' => 'required|string|max:255',
            'subject' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'room' => 'nullable|string|max:50',
            'schedule' => 'nullable|json',
            'is_active' => 'sometimes|boolean',
        ]);

        // If user is a teacher, ensure they can only assign the class to themselves
        if ($user->hasRole('teacher') && !$user->hasRole('tenant_admin')) {
            $validated['teacher_id'] = $user->teacher->id;
        }

        TenantClasses::create([
            'teacher_id' => $validated['teacher_id'],
            'name' => $validated['name'],
            'subject' => $validated['subject'],
            'description' => $validated['description'],
            'room' => $validated['room'],
            'schedule' => $validated['schedule'],
            'is_active' => $validated['is_active'] ?? true,
        ]);

        return redirect()->route('tenant.classes')->with('success', 'Class created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TenantClasses $class)
    {
        $user = Auth::user();

        // Check if user has permission to view this class
        if (
            !$user->hasRole('tenant_admin') &&
            (!$user->hasRole('teacher') || !$user->teacher || $class->teacher_id !== $user->teacher->id)
        ) {
            abort(403, 'You do not have permission to view this class.');
        }

        // Load the class with its students
        $class->load('students');

        // Get review tickets for this class
        $reviewTickets = ReviewTicket::with('student', 'teacher')
            ->where('class_id', $class->id)
            ->get();

        // Get all students not enrolled in this specific class
        $enrolledStudentIds = $class->students->pluck('id')->toArray();
        $availableStudents = \App\Models\TenantStudents::whereNotIn('id', $enrolledStudentIds)->get();

        return view('tenants.classes.show', compact('class', 'availableStudents', 'reviewTickets'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TenantClasses $class)
    {
        $user = Auth::user();

        // Check if user has permission to edit this class
        if (
            !$user->hasRole('tenant_admin') &&
            (!$user->hasRole('teacher') || !$user->teacher || $class->teacher_id !== $user->teacher->id)
        ) {
            abort(403, 'You do not have permission to edit this class.');
        }

        // If user is tenant_admin, show all teachers
        if ($user->hasRole('tenant_admin')) {
            $teachers = \App\Models\TenantTeacher::all();
        } else if ($user->hasRole('teacher') && $user->teacher) {
            // For teachers, only allow them to select themselves
            $teachers = collect([$user->teacher]);
        } else {
            $teachers = collect();
        }

        return view('tenants.classes.edit', compact('class', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TenantClasses $class)
    {
        $user = Auth::user();

        // Check if user has permission to update this class
        if (
            !$user->hasRole('tenant_admin') &&
            (!$user->hasRole('teacher') || !$user->teacher || $class->teacher_id !== $user->teacher->id)
        ) {
            abort(403, 'You do not have permission to update this class.');
        }

        $validated = $request->validate([
            'teacher_id' => 'required|exists:tenant_teachers,id',
            'name' => 'required|string|max:255',
            'subject' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'room' => 'nullable|string|max:50',
            'schedule' => 'nullable|json',
            'is_active' => 'sometimes|boolean',
        ]);

        // If user is a teacher, ensure they can only assign the class to themselves
        if ($user->hasRole('teacher') && !$user->hasRole('tenant_admin')) {
            $validated['teacher_id'] = $user->teacher->id;
        }

        $class->update($validated);

        return redirect()->route('tenant.classes')->with('success', 'Class updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TenantClasses $class)
    {
        $user = Auth::user();

        // Check if user has permission to delete this class
        if (
            !$user->hasRole('tenant_admin') &&
            (!$user->hasRole('teacher') || !$user->teacher || $class->teacher_id !== $user->teacher->id)
        ) {
            abort(403, 'You do not have permission to delete this class.');
        }

        $class->delete();

        return redirect()->route('tenant.classes')->with('success', 'Class deleted successfully.');
    }

    /**
     * Add a student to the class.
     */
    public function addStudent(Request $request, TenantClasses $class)
    {
        $user = Auth::user();

        // Check if user has permission to add students to this class
        if (
            !$user->hasRole('tenant_admin') &&
            (!$user->hasRole('teacher') || !$user->teacher || $class->teacher_id !== $user->teacher->id)
        ) {
            abort(403, 'You do not have permission to add students to this class.');
        }

        $validated = $request->validate([
            'student_id' => 'required|exists:tenant_students,id',
        ]);

        $student = \App\Models\TenantStudents::find($validated['student_id']);

        // Check if student is already enrolled in this class
        if ($student->classes()->where('tenant_class_id', $class->id)->exists()) {
            return back()->with('error', 'Student is already enrolled in this class.');
        }

        // Enroll the student in the class
        $student->classes()->attach($class->id, [
            'enrolled_at' => now(),
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Student added to class successfully.');
    }

    /**
     * Remove a student from the class.
     */
    public function removeStudent(TenantClasses $class, \App\Models\TenantStudents $student)
    {
        $user = Auth::user();

        // Check if user has permission to remove students from this class
        if (
            !$user->hasRole('tenant_admin') &&
            (!$user->hasRole('teacher') || !$user->teacher || $class->teacher_id !== $user->teacher->id)
        ) {
            abort(403, 'You do not have permission to remove students from this class.');
        }

        // Check if student is enrolled in this class
        if (!$student->classes()->where('tenant_class_id', $class->id)->exists()) {
            return back()->with('error', 'Student is not enrolled in this class.');
        }

        // Remove the student from the class
        $student->classes()->detach($class->id);

        return back()->with('success', 'Student removed from class successfully.');
    }

    /**
     * Update the teacher for the class.
     */
    public function updateTeacher(Request $request, TenantClasses $class)
    {
        $user = Auth::user();

        // Check if user has permission to update the teacher for this class
        if (
            !$user->hasRole('tenant_admin') &&
            (!$user->hasRole('teacher') || !$user->teacher || $class->teacher_id !== $user->teacher->id)
        ) {
            abort(403, 'You do not have permission to update the teacher for this class.');
        }

        $validated = $request->validate([
            'teacher_id' => 'required|exists:tenant_teachers,id',
        ]);

        $class->update($validated);

        return back()->with('success', 'Class teacher updated successfully.');
    }
}

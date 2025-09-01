<?php

namespace App\Http\Controllers\Tenants;

use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Models\TenantClasses;
use App\Http\Controllers\Controller;

class TenantClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Load classes with their students count
        $classes = TenantClasses::withCount('students')->get();
        $tenant = tenant();

        return view('tenants.classes.index', compact('tenant', 'classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $teachers = \App\Models\TenantTeacher::all();
        $tenant = tenant();
        return view('tenants.classes.create', compact('tenant', 'teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'teacher_id' => 'required|exists:tenant_teachers,id',
            'name' => 'required|string|max:255',
            'subject' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'room' => 'nullable|string|max:50',
            'schedule' => 'nullable|json',
            'is_active' => 'sometimes|boolean',
        ]);
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
        // Load the class with its students
        $class->load('students');

        // Get all students not enrolled in this specific class
        $enrolledStudentIds = $class->students->pluck('id')->toArray();
        $availableStudents = \App\Models\TenantStudents::whereNotIn('id', $enrolledStudentIds)->get();

        return view('tenants.classes.show', compact('class', 'availableStudents'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TenantClasses $class)
    {
        $teachers = \App\Models\TenantTeacher::all();
        return view('tenants.classes.edit', compact('class', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TenantClasses $class)
    {
        $validated = $request->validate([
            'teacher_id' => 'required|exists:tenant_teachers,id',
            'name' => 'required|string|max:255',
            'subject' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'room' => 'nullable|string|max:50',
            'schedule' => 'nullable|json',
            'is_active' => 'sometimes|boolean',
        ]);

        $class->update($validated);

        return redirect()->route('tenant.classes')->with('success', 'Class updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TenantClasses $class)
    {
        $class->delete();

        return redirect()->route('tenant.classes')->with('success', 'Class deleted successfully.');
    }

    /**
     * Add a student to the class.
     */
    public function addStudent(Request $request, TenantClasses $class)
    {
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
        // Check if student is enrolled in this class
        if (!$student->classes()->where('tenant_class_id', $class->id)->exists()) {
            return back()->with('error', 'Student is not enrolled in this class.');
        }

        // Remove the student from the class
        $student->classes()->detach($class->id);

        return back()->with('success', 'Student removed from class successfully.');
    }
}

<?php

namespace App\Http\Controllers\Tenants;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TenantStudents;
use App\Models\TenantParents;
use App\Mail\WelcomeStudentMail;
use App\Mail\WelcomeParentMail;
use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class TenantStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $tenant = tenant();

        // If user is tenant_admin, show all students
        if ($user->hasRole('tenant_admin')) {
            $students = TenantStudents::with(['classes', 'parents'])->get();
            // Get users who have student role or have a student record
            $users = \App\Models\User::with('student')
                ->where(function ($query) {
                    $query->whereHas('roles', function ($q) {
                        $q->where('name', 'student');
                    })->orWhereHas('student');
                })
                ->get();
        } else if ($user->hasRole('teacher') && $user->teacher) {
            // For teachers, only show students from their assigned classes
            $teacherClassIds = $user->teacher->classes->pluck('id')->toArray();

            if (empty($teacherClassIds)) {
                // Teacher has no classes assigned, show empty results
                $students = collect();
                $users = collect();
            } else {
                // Get students enrolled in teacher's classes
                $students = TenantStudents::with(['classes', 'parents'])
                    ->whereHas('classes', function ($query) use ($teacherClassIds) {
                        $query->whereIn('tenant_classes.id', $teacherClassIds);
                    })
                    ->get();

                // Get users who have student role and are enrolled in teacher's classes
                $users = \App\Models\User::with('student')
                    ->where(function ($query) {
                        $query->whereHas('roles', function ($q) {
                            $q->where('name', 'student');
                        })->orWhereHas('student');
                    })
                    ->whereHas('student.classes', function ($query) use ($teacherClassIds) {
                        $query->whereIn('tenant_classes.id', $teacherClassIds);
                    })
                    ->get();
            }
        } else {
            // For other roles or teachers without teacher record, show empty results
            $students = collect();
            $users = collect();
        }

        return view('tenants.students.index', compact('tenant', 'users', 'students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('tenants.students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],
            'class_id' => 'nullable|exists:tenant_classes,id',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|string|in:male,female,other',
            'guardian_name' => 'nullable|string|max:255',
            'guardian_contact' => 'nullable|string|max:20',
            'enrollment_date' => 'required|date',
            'is_active' => 'boolean',
            // Parent validation
            'parent1_name' => 'nullable|string|max:255',
            'parent1_email' => [
                'nullable',
                'email',
                'max:255',
                'unique:users,email',
            ],
            'parent1_phone' => 'nullable|string|max:20',
            'parent1_address' => 'nullable|string|max:255',
            'parent2_name' => 'nullable|string|max:255',
            'parent2_email' => [
                'nullable',
                'email',
                'max:255',
                'unique:users,email',
            ],
            'parent2_phone' => 'nullable|string|max:20',
            'parent2_address' => 'nullable|string|max:255',
        ]);

        // Create student user
        $password = Str::random(8);
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($password),
        ]);
        $user->assignRole('student');

        // Create student record
        $student = TenantStudents::create([
            'user_id' => $user->id,
            'class_id' => $validated['class_id'] ?? null,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'date_of_birth' => $validated['date_of_birth'],
            'gender' => $validated['gender'],
            'guardian_name' => $validated['guardian_name'],
            'guardian_contact' => $validated['guardian_contact'],
            'enrollment_date' => $validated['enrollment_date'],
            'is_active' => $validated['is_active'] ?? true,
        ]);

        // Send welcome email to student
        try {
            Mail::to($user->email)->send(new WelcomeStudentMail($user, $password));
        } catch (\Exception $e) {
            Log::warning('Failed to send welcome email to student: ' . $e->getMessage());
        }

        // Create parent 1 if provided
        if (!empty($validated['parent1_name']) && !empty($validated['parent1_email'])) {
            $parent1Password = Str::random(8);
            $parent1User = User::create([
                'name' => $validated['parent1_name'],
                'email' => $validated['parent1_email'],
                'password' => Hash::make($parent1Password),
            ]);
            $parent1User->assignRole('parent');

            TenantParents::create([
                'user_id' => $parent1User->id,
                'tenant_student_id' => $student->id,
                'name' => $validated['parent1_name'],
                'email' => $validated['parent1_email'],
                'phone' => $validated['parent1_phone'],
                'address' => $validated['parent1_address'],
            ]);

            // Send welcome email to parent 1
            try {
                Mail::to($parent1User->email)->send(new WelcomeParentMail($parent1User, $parent1Password, $student));
            } catch (\Exception $e) {
                Log::warning('Failed to send welcome email to parent 1: ' . $e->getMessage());
            }
        }

        // Create parent 2 if provided
        if (!empty($validated['parent2_name']) && !empty($validated['parent2_email'])) {
            $parent2Password = Str::random(8);
            $parent2User = User::create([
                'name' => $validated['parent2_name'],
                'email' => $validated['parent2_email'],
                'password' => Hash::make($parent2Password),
            ]);
            $parent2User->assignRole('parent');

            TenantParents::create([
                'user_id' => $parent2User->id,
                'tenant_student_id' => $student->id,
                'name' => $validated['parent2_name'],
                'email' => $validated['parent2_email'],
                'phone' => $validated['parent2_phone'],
                'address' => $validated['parent2_address'],
            ]);

            // Send welcome email to parent 2
            try {
                Mail::to($parent2User->email)->send(new WelcomeParentMail($parent2User, $parent2Password, $student));
            } catch (\Exception $e) {
                Log::warning('Failed to send welcome email to parent 2: ' . $e->getMessage());
            }
        }

        return redirect()->route('tenant.students')->with('status', 'Student and parent(s) created successfully. Welcome emails have been queued for delivery (check logs if emails are not received).');
    }

    /**
     * Display the specified resource.
     */
    public function show(TenantStudents $student)
    {
        // Load the relationships
        $student->load(['user', 'classes', 'parents']);

        // Get available classes that the student is not enrolled in
        $enrolledClassIds = $student->classes->pluck('id')->toArray();
        $availableClasses = \App\Models\TenantClasses::whereNotIn('id', $enrolledClassIds)
            ->where('is_active', true)
            ->get();

        return view('tenants.students.show', compact('student', 'availableClasses'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TenantStudents $student)
    {
        $student->load('parents');
        return view('tenants.students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TenantStudents $student)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $student->user_id,
            ],
            'class_id' => 'nullable|exists:tenant_classes,id',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|string|in:male,female,other',
            'guardian_name' => 'nullable|string|max:255',
            'guardian_contact' => 'nullable|string|max:20',
            'enrollment_date' => 'required|date',
            'is_active' => 'boolean',
            // Parent validation
            'parent1_id' => 'nullable|exists:tenant_parents,id',
            'parent1_name' => 'nullable|string|max:255',
            'parent1_email' => [
                'nullable',
                'email',
                'max:255',
                function ($attribute, $value, $fail) use ($request, $student) {
                    if (!empty($value)) {
                        $existingUser = User::where('email', $value)
                            ->when($request->parent1_id, function ($query) use ($request) {
                                $parent = TenantParents::find($request->parent1_id);
                                if ($parent) {
                                    $query->where('id', '!=', $parent->user_id);
                                }
                            })
                            ->first();
                        if ($existingUser) {
                            $fail('The email has already been taken.');
                        }
                    }
                },
            ],
            'parent1_phone' => 'nullable|string|max:20',
            'parent1_address' => 'nullable|string|max:255',
            'parent2_id' => 'nullable|exists:tenant_parents,id',
            'parent2_name' => 'nullable|string|max:255',
            'parent2_email' => [
                'nullable',
                'email',
                'max:255',
                function ($attribute, $value, $fail) use ($request, $student) {
                    if (!empty($value)) {
                        $existingUser = User::where('email', $value)
                            ->when($request->parent2_id, function ($query) use ($request) {
                                $parent = TenantParents::find($request->parent2_id);
                                if ($parent) {
                                    $query->where('id', '!=', $parent->user_id);
                                }
                            })
                            ->first();
                        if ($existingUser) {
                            $fail('The email has already been taken.');
                        }
                    }
                },
            ],
            'parent2_phone' => 'nullable|string|max:20',
            'parent2_address' => 'nullable|string|max:255',
        ]);

        // Update student
        $student->update($validated);
        // Update associated user
        $student->user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        // Handle Parent 1
        if ($request->parent1_id) {
            // Update existing parent 1
            $parent1 = TenantParents::find($request->parent1_id);
            if ($parent1) {
                $parent1->update([
                    'name' => $validated['parent1_name'],
                    'email' => $validated['parent1_email'],
                    'phone' => $validated['parent1_phone'],
                    'address' => $validated['parent1_address'],
                ]);

                // Update parent's user record
                $parent1->user->update([
                    'name' => $validated['parent1_name'],
                    'email' => $validated['parent1_email'],
                ]);
            }
        } else if (!empty($validated['parent1_name']) && !empty($validated['parent1_email'])) {
            // Create new parent 1
            $parent1Password = Str::random(8);
            $parent1User = User::create([
                'name' => $validated['parent1_name'],
                'email' => $validated['parent1_email'],
                'password' => Hash::make($parent1Password),
            ]);
            $parent1User->assignRole('parent');

            TenantParents::create([
                'user_id' => $parent1User->id,
                'tenant_student_id' => $student->id,
                'name' => $validated['parent1_name'],
                'email' => $validated['parent1_email'],
                'phone' => $validated['parent1_phone'],
                'address' => $validated['parent1_address'],
            ]);

            // Send welcome email to new parent 1
            Mail::to($parent1User->email)->send(new WelcomeParentMail($parent1User, $parent1Password, $student));
        }

        // Handle Parent 2
        if ($request->parent2_id) {
            // Update existing parent 2
            $parent2 = TenantParents::find($request->parent2_id);
            if ($parent2) {
                $parent2->update([
                    'name' => $validated['parent2_name'],
                    'email' => $validated['parent2_email'],
                    'phone' => $validated['parent2_phone'],
                    'address' => $validated['parent2_address'],
                ]);

                // Update parent's user record
                $parent2->user->update([
                    'name' => $validated['parent2_name'],
                    'email' => $validated['parent2_email'],
                ]);
            }
        } else if (!empty($validated['parent2_name']) && !empty($validated['parent2_email'])) {
            // Create new parent 2
            $parent2Password = Str::random(8);
            $parent2User = User::create([
                'name' => $validated['parent2_name'],
                'email' => $validated['parent2_email'],
                'password' => Hash::make($parent2Password),
            ]);
            $parent2User->assignRole('parent');

            TenantParents::create([
                'user_id' => $parent2User->id,
                'tenant_student_id' => $student->id,
                'name' => $validated['parent2_name'],
                'email' => $validated['parent2_email'],
                'phone' => $validated['parent2_phone'],
                'address' => $validated['parent2_address'],
            ]);

            // Send welcome email to new parent 2
            Mail::to($parent2User->email)->send(new WelcomeParentMail($parent2User, $parent2Password, $student));
        }

        return redirect()->route('tenant.students')->with('status', 'Student and parent details updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TenantStudents $student)
    {
        // Delete the associated user as well
        if ($student->user) {
            $student->user->delete();
        }

        $student->delete();

        return redirect()->route('tenant.students')->with('status', 'Student deleted successfully.');
    }

    /**
     * Enroll a student in a class.
     */
    public function enrollInClass(Request $request, TenantStudents $student)
    {
        $validated = $request->validate([
            'class_id' => 'required|exists:tenant_classes,id',
        ]);

        $class = \App\Models\TenantClasses::find($validated['class_id']);

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

        return back()->with('success', "Student enrolled in {$class->name} successfully.");
    }

    /**
     * Unenroll a student from a class.
     */
    public function unenrollFromClass(TenantStudents $student, \App\Models\TenantClasses $class)
    {
        // Check if student is enrolled in this class
        if (!$student->classes()->where('tenant_class_id', $class->id)->exists()) {
            return back()->with('error', 'Student is not enrolled in this class.');
        }

        // Remove the student from the class
        $student->classes()->detach($class->id);

        return back()->with('success', "Student unenrolled from {$class->name} successfully.");
    }

    /**
     * Reset a student's password.
     */
    public function resetPassword(TenantStudents $student)
    {
        $user = Auth::user();

        // Check if user has permission to reset passwords
        if (!$user->hasRole(['tenant_admin', 'teacher'])) {
            return back()->with('error', 'You do not have permission to reset student passwords.');
        }

        // For teachers, check if they have access to this student
        if ($user->hasRole('teacher') && $user->teacher) {
            $teacherClassIds = $user->teacher->classes->pluck('id')->toArray();
            $studentClassIds = $student->classes->pluck('id')->toArray();

            // Check if student is in any of the teacher's classes
            if (empty($teacherClassIds) || empty(array_intersect($teacherClassIds, $studentClassIds))) {
                return back()->with('error', 'You can only reset passwords for students in your classes.');
            }
        }

        if (!$student->user) {
            return back()->with('error', 'Student does not have an associated user account.');
        }

        // Generate a new random password
        $newPassword = Str::random(8);

        // Update the user's password
        $student->user->update([
            'password' => Hash::make($newPassword),
        ]);

        // Send email with new password to student
        try {
            Mail::to($student->user->email)->send(new WelcomeStudentMail($student->user, $newPassword));
            $message = 'Password has been reset successfully. New password has been sent to the student\'s email address.';
        } catch (\Exception $e) {
            Log::warning('Failed to send password reset email to student: ' . $e->getMessage());
            $message = 'Password has been reset successfully, but email could not be sent. New password is: ' . $newPassword;
        }

        return back()->with('status', $message);
    }
}

<?php

namespace App\Http\Controllers\Tenants;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\TenantTeacher;
use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class TenantTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $teachers = TenantTeacher::all();
        $tenant = tenant();
        // Get users who have teacher role or have a teacher record
        $users = \App\Models\User::with('teacher')
            ->where(function ($query) {
                $query->whereHas('roles', function ($q) {
                    $q->where('name', 'teacher');
                })->orWhereHas('teacher');
            })
            ->get();
        return view('tenants.teachers.index', compact('tenant', 'users', 'teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $teachers = TenantTeacher::all();
        return view('tenants.teachers.create', compact('teachers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * Expected request fields:
     * - name: required|string|max:255
     * - email: required|email|max:255|unique:users,email (scoped to tenant)
     * - subject: required|string|max:255
     * - bio: nullable|string|max:1000
     * - phone: nullable|string|max:20
     * - address: nullable|string|max:255
     * - hire_date: required|date
     * - is_active: boolean
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],
            'subject' => 'required|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'hire_date' => 'required|date',
            'is_active' => 'boolean',
        ]);
        $password = \Illuminate\Support\Str::random(8); // Default password if not provided

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($password),
        ]);
        $user->assignRole('teacher');
        TenantTeacher::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'subject' => $request->input('subject'),
            'bio' => $request->input('bio'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'hire_date' => $request->input('hire_date'),
            'is_active' => $request->input('is_active', true),
        ]);

        // Send email to user with their credentials
        Mail::to($user->email)->send(new \App\Mail\TeacherWelcomeMail($user, $password));

        return redirect()->route('tenant.teachers')->with('status', 'Teacher created successfully and credentials emailed.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TenantTeacher $teacher)
    {
        // Load the user relationship
        $teacher->load('user');

        return view('tenants.teachers.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TenantTeacher $teacher)
    {
        //
        return view('tenants.teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TenantTeacher $teacher)
    {
        //
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $teacher->user_id,
            ],
            'subject' => 'required|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'hire_date' => 'required|date',
            'is_active' => 'boolean',
        ]);

        $teacher->update($validated);

        return redirect()->route('tenant.teachers')->with('status', 'Teacher updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TenantTeacher $teacher)
    {
        // Delete the associated user as well
        if ($teacher->user) {
            $teacher->user->delete();
        }

        $teacher->delete();

        return redirect()->route('tenant.teachers')->with('status', 'Teacher deleted successfully.');
    }
}

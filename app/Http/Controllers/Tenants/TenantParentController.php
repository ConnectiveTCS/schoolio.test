<?php

namespace App\Http\Controllers\Tenants;

use Illuminate\Http\Request;
use App\Models\TenantParents;
use App\Models\TenantStudents;
use App\Http\Controllers\Controller;
use App\Models\Tenant;

class TenantParentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $parents = TenantParents::with('students')->get();
        return view('tenants.parents.index', compact('parents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $parents = TenantParents::all();
        $students = TenantStudents::all();
        return view('tenants.parents.create', compact('parents', 'students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'tenant_student_id' => 'required|exists:tenant_students,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:tenant_parents,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        TenantParents::create([
            'tenant_student_id' => $validatedData['tenant_student_id'],
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'address' => $validatedData['address'],
        ]);

        return redirect()->route('tenant.parents.index')->with('success', 'Parent created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TenantParents $parent)
    {
        //
        return view('tenants.parents.show', compact('parent'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TenantParents $parent)
    {
        $students = TenantStudents::all();
        return view('tenants.parents.edit', compact('parent', 'students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TenantParents $parent)
    {
        $validatedData = $request->validate([
            'tenant_student_id' => 'required|exists:tenant_students,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:tenant_parents,email,' . $parent->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $parent->update($validatedData);

        return redirect()->route('tenant.parents.index')->with('success', 'Parent updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TenantParents $parent)
    {
        $parent->delete();
        return redirect()->route('tenant.parents.index')->with('success', 'Parent deleted successfully.');
    }
}

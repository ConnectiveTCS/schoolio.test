<?php

namespace App\Http\Controllers\Tenants;

use App\Models\Class;
use App\Models\Student;
use App\Models\ReviewTicket;
use Illuminate\Http\Request;
use App\Models\TenantClasses;
use App\Models\TenantStudents;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReviewTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $reviewTickets = \App\Models\ReviewTicket::with(['teacher', 'student', 'class'])->get();
        $tenant = tenant();
        return view('tenants.review_tickets.index', compact('tenant', 'reviewTickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        if ($user->hasRole('teacher') && $user->teacher) {
            // For teachers, only show classes they are assigned to
            $classes = TenantClasses::withCount('students')
                ->where('teacher_id', $user->teacher->id)
                ->get();
        } else {
            // For other roles, show no classes
            $classes = collect();
        }
        $students = TenantStudents::all();
        return view('tenants.review_tickets.create', compact('classes', 'students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'class_id' => 'required|exists:tenant_classes,id',
            'title' => 'nullable|string|max:255',
            'questions' => 'nullable|array',
            'questions.*' => 'nullable|string|max:255',
            'comments' => 'nullable|string',
        ]);
        $teacher = Auth::user()->teacher;
        // Get students enrolled in the selected class using the many-to-many relationship
        $students = TenantStudents::whereHas('classes', function ($query) use ($request) {
            $query->where('tenant_classes.id', $request->class_id);
        })->get();

        $questions = array_filter($request->input('questions', [])); // Remove empty questions

        foreach ($students as $student) {
            ReviewTicket::create([
                'teacher_id' => $teacher->id,
                'class_id' => $request->class_id,
                'student_id' => $student->id,
                'title' => $request->title,
                'questions' => $questions,
                'comments' => $request->comments,
                'status' => 'pending',
            ]);
        }

        return redirect()->route('tenant.review-tickets.index')->with('success', 'Review ticket created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ReviewTicket $reviewTicket)
    {
        return view('tenants.review_tickets.show', compact('reviewTicket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ReviewTicket $reviewTicket)
    {
        $classes = TenantClasses::all();
        $students = TenantStudents::all();
        return view('tenants.review_tickets.edit', compact('reviewTicket', 'classes', 'students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ReviewTicket $reviewTicket)
    {
        $request->validate([
            'teacher_id' => 'required|exists:tenant_teachers,id',
            'class_id' => 'required|exists:tenant_classes,id',
            'student_id' => 'required|exists:tenant_students,id',
            'title' => 'nullable|string|max:255',
            'questions' => 'nullable|array',
            'comments' => 'nullable|string',
            'status' => 'required|in:pending,in_review,completed',
        ]);

        $reviewTicket->update([
            'teacher_id' => $request->teacher_id,
            'class_id' => $request->class_id,
            'student_id' => $request->student_id,
            'title' => $request->title,
            'questions' => $request->questions,
            'comments' => $request->comments,
            'status' => $request->status,
        ]);

        return redirect()->route('tenant.review-tickets.index')->with('success', 'Review ticket updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReviewTicket $reviewTicket)
    {
        $reviewTicket->delete();
        return redirect()->route('tenant.review-tickets.index')->with('success', 'Review ticket deleted successfully.');
    }
}

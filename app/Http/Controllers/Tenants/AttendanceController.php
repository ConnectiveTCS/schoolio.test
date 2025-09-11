<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\TenantClasses;
use App\Models\TenantStudents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AttendanceController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of attendance records with filtering options.
     */
    public function index(Request $request)
    {
        $this->authorize('view attendance');

        $query = Attendance::with(['student.user', 'tenantClass', 'markedBy']);

        // Filter by class
        if ($request->filled('class_id')) {
            $query->byClass($request->class_id);
        }

        // Filter by date range
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->betweenDates($request->start_date, $request->end_date);
        } else {
            // Default to current month
            $query->betweenDates(
                Carbon::now()->startOfMonth(),
                Carbon::now()->endOfMonth()
            );
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->byStatus($request->status);
        }

        $attendances = $query->orderBy('date', 'desc')
            ->orderBy('tenant_class_id')
            ->paginate(20);

        // Filter classes based on user role
        $user = Auth::user();
        if ($user->hasRole('tenant_admin')) {
            // Tenant admin can see all classes
            $classes = TenantClasses::all();
        } elseif ($user->hasRole('teacher') && $user->teacher) {
            // Teachers can only see their assigned classes
            $classes = TenantClasses::where('teacher_id', $user->teacher->id)->get();
        } else {
            // Other roles get empty collection
            $classes = collect();
        }

        $statusOptions = Attendance::getStatusOptions();

        return view('tenants.attendance.index', compact('attendances', 'classes', 'statusOptions'));
    }

    /**
     * Show the form for taking attendance for a specific class.
     */
    public function create(Request $request)
    {
        $this->authorize('create attendance');

        $class = null;
        $date = $request->input('date', Carbon::today()->format('Y-m-d'));

        if ($request->filled('class_id')) {
            $class = TenantClasses::with(['students.user'])->findOrFail($request->class_id);

            // Get existing attendance for this class and date
            $existingAttendance = Attendance::where('tenant_class_id', $class->id)
                ->where('date', $date)
                ->get()
                ->keyBy('tenant_student_id');
        } else {
            $existingAttendance = collect();
        }

        // Filter classes based on user role
        $user = Auth::user();
        if ($user->hasRole('tenant_admin')) {
            // Tenant admin can see all classes
            $classes = TenantClasses::all();
        } elseif ($user->hasRole('teacher') && $user->teacher) {
            // Teachers can only see their assigned classes
            $classes = TenantClasses::where('teacher_id', $user->teacher->id)->get();
        } else {
            // Other roles get empty collection
            $classes = collect();
        }

        $statusOptions = Attendance::getStatusOptions();

        return view('tenants.attendance.create', compact('class', 'classes', 'date', 'existingAttendance', 'statusOptions'));
    }

    /**
     * Store attendance records for a class.
     */
    public function store(Request $request)
    {
        $this->authorize('create attendance');

        $request->validate([
            'class_id' => 'required|exists:tenant_classes,id',
            'date' => 'required|date',
            'attendance' => 'required|array',
            'attendance.*.student_id' => 'required|exists:tenant_students,id',
            'attendance.*.status' => 'required|in:present,absent,late,excused',
            'attendance.*.notes' => 'nullable|string|max:500',
        ]);

        $class = TenantClasses::findOrFail($request->class_id);
        $user = Auth::user();

        // Check if user has permission to create attendance for this class
        if (
            !$user->hasRole('tenant_admin') &&
            (!$user->hasRole('teacher') || !$user->teacher || $class->teacher_id !== $user->teacher->id)
        ) {
            abort(403, 'You do not have permission to create attendance for this class.');
        }

        $date = $request->date;

        foreach ($request->attendance as $attendanceData) {
            Attendance::updateOrCreate(
                [
                    'tenant_student_id' => $attendanceData['student_id'],
                    'tenant_class_id' => $class->id,
                    'date' => $date,
                ],
                [
                    'status' => $attendanceData['status'],
                    'notes' => $attendanceData['notes'] ?? null,
                    'marked_by' => Auth::id(),
                ]
            );
        }

        return redirect()->route('tenant.attendance.index')
            ->with('status', 'Attendance recorded successfully for ' . $class->name . ' on ' . Carbon::parse($date)->format('M d, Y'));
    }

    /**
     * Display attendance statistics for a specific class.
     */
    public function show(TenantClasses $class)
    {
        $this->authorize('view attendance');

        $user = Auth::user();

        // Check if user has permission to access this class
        if (
            !$user->hasRole('tenant_admin') &&
            (!$user->hasRole('teacher') || !$user->teacher || $class->teacher_id !== $user->teacher->id)
        ) {
            abort(403, 'You do not have permission to access this class.');
        }

        $startDate = request('start_date', Carbon::now()->startOfMonth());
        $endDate = request('end_date', Carbon::now()->endOfMonth());

        $attendances = Attendance::with(['student.user'])
            ->where('tenant_class_id', $class->id)
            ->betweenDates($startDate, $endDate)
            ->orderBy('date', 'desc')
            ->get();

        // Calculate statistics
        $stats = [
            'total_days' => $attendances->pluck('date')->unique()->count(),
            'total_students' => $class->students->count(),
            'present_count' => $attendances->where('status', 'present')->count(),
            'absent_count' => $attendances->where('status', 'absent')->count(),
            'late_count' => $attendances->where('status', 'late')->count(),
            'excused_count' => $attendances->where('status', 'excused')->count(),
        ];

        if ($stats['total_days'] > 0 && $stats['total_students'] > 0) {
            $stats['attendance_rate'] = round(($stats['present_count'] + $stats['late_count']) /
                ($stats['total_days'] * $stats['total_students']) * 100, 1);
        } else {
            $stats['attendance_rate'] = 0;
        }

        return view('tenants.attendance.show', compact('class', 'attendances', 'stats', 'startDate', 'endDate'));
    }

    /**
     * Show the form for editing attendance.
     */
    public function edit(Attendance $attendance)
    {
        $this->authorize('edit attendance');

        $user = Auth::user();

        // Check if user has permission to edit attendance for this class
        if (
            !$user->hasRole('tenant_admin') &&
            (!$user->hasRole('teacher') || !$user->teacher || $attendance->tenantClass->teacher_id !== $user->teacher->id)
        ) {
            abort(403, 'You do not have permission to edit attendance for this class.');
        }

        $statusOptions = Attendance::getStatusOptions();

        return view('tenants.attendance.edit', compact('attendance', 'statusOptions'));
    }

    /**
     * Update the specified attendance record.
     */
    public function update(Request $request, Attendance $attendance)
    {
        $this->authorize('edit attendance');

        $user = Auth::user();

        // Check if user has permission to edit attendance for this class
        if (
            !$user->hasRole('tenant_admin') &&
            (!$user->hasRole('teacher') || !$user->teacher || $attendance->tenantClass->teacher_id !== $user->teacher->id)
        ) {
            abort(403, 'You do not have permission to edit attendance for this class.');
        }

        $request->validate([
            'status' => 'required|in:present,absent,late,excused',
            'notes' => 'nullable|string|max:500',
        ]);

        $attendance->update([
            'status' => $request->status,
            'notes' => $request->notes,
            'marked_by' => Auth::id(),
        ]);

        return redirect()->route('tenant.attendance.index')
            ->with('status', 'Attendance updated successfully.');
    }

    /**
     * Remove the specified attendance record.
     */
    public function destroy(Attendance $attendance)
    {
        $this->authorize('manage attendance');

        $user = Auth::user();

        // Check if user has permission to delete attendance for this class
        if (
            !$user->hasRole('tenant_admin') &&
            (!$user->hasRole('teacher') || !$user->teacher || $attendance->tenantClass->teacher_id !== $user->teacher->id)
        ) {
            abort(403, 'You do not have permission to delete attendance for this class.');
        }

        $attendance->delete();

        return redirect()->route('tenant.attendance.index')
            ->with('status', 'Attendance record deleted successfully.');
    }

    /**
     * Get attendance data for AJAX requests.
     */
    public function getData(Request $request)
    {
        $this->authorize('view attendance');

        $user = Auth::user();
        $class = TenantClasses::with(['students.user'])->findOrFail($request->class_id);

        // Check if user has permission to access this class
        if (
            !$user->hasRole('tenant_admin') &&
            (!$user->hasRole('teacher') || !$user->teacher || $class->teacher_id !== $user->teacher->id)
        ) {
            abort(403, 'You do not have permission to access this class.');
        }

        $date = $request->input('date', Carbon::today()->format('Y-m-d'));

        $existingAttendance = Attendance::where('tenant_class_id', $class->id)
            ->where('date', $date)
            ->get()
            ->keyBy('tenant_student_id');

        return response()->json([
            'students' => $class->students->map(function ($student) use ($existingAttendance) {
                $attendance = $existingAttendance->get($student->id);
                return [
                    'id' => $student->id,
                    'name' => $student->user->name,
                    'status' => $attendance ? $attendance->status : 'present',
                    'notes' => $attendance ? $attendance->notes : '',
                ];
            }),
            'class_name' => $class->name,
        ]);
    }
}

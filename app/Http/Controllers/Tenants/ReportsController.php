<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\TenantClasses;
use App\Models\TenantStudents;
use App\Models\TenantTeacher;
use App\Models\Announcement;
use App\Models\CalendarEvent;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Response;

class ReportsController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display the reports dashboard.
     */
    public function index()
    {
        $this->authorize('view reports');

        $reportTypes = [
            'attendance' => [
                'title' => 'Attendance Reports',
                'description' => 'Generate attendance reports by class, student, or date range',
                'icon' => 'fas fa-clipboard-check',
                'color' => 'blue',
            ],
            'enrollment' => [
                'title' => 'Enrollment Reports',
                'description' => 'View student enrollment statistics and trends',
                'icon' => 'fas fa-user-graduate',
                'color' => 'green',
            ],
            'class_summary' => [
                'title' => 'Class Summary Reports',
                'description' => 'Overview of all classes, teachers, and student counts',
                'icon' => 'fas fa-chalkboard-teacher',
                'color' => 'purple',
            ],
            'activity' => [
                'title' => 'Activity Reports',
                'description' => 'Recent system activities and announcements',
                'icon' => 'fas fa-chart-line',
                'color' => 'orange',
            ],
        ];

        return view('tenants.reports.index', compact('reportTypes'));
    }

    /**
     * Generate attendance report.
     */
    public function attendance(Request $request)
    {
        $this->authorize('view reports');

        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth()->format('Y-m-d'));
        $classId = $request->input('class_id');
        $studentId = $request->input('student_id');

        $query = Attendance::with(['student.user', 'tenantClass', 'markedBy'])
            ->betweenDates($startDate, $endDate);

        if ($classId) {
            $query->byClass($classId);
        }

        if ($studentId) {
            $query->byStudent($studentId);
        }

        $attendances = $query->orderBy('date', 'desc')->get();

        // Calculate statistics
        $stats = [
            'total_records' => $attendances->count(),
            'present_count' => $attendances->where('status', 'present')->count(),
            'absent_count' => $attendances->where('status', 'absent')->count(),
            'late_count' => $attendances->where('status', 'late')->count(),
            'excused_count' => $attendances->where('status', 'excused')->count(),
        ];

        if ($stats['total_records'] > 0) {
            $stats['attendance_rate'] = round(($stats['present_count'] + $stats['late_count']) / $stats['total_records'] * 100, 1);
        } else {
            $stats['attendance_rate'] = 0;
        }

        $classes = TenantClasses::all();
        $students = TenantStudents::with('user')->get();

        if ($request->input('format') === 'csv') {
            return $this->exportAttendanceCsv($attendances, $startDate, $endDate);
        }

        return view('tenants.reports.attendance', compact('attendances', 'stats', 'classes', 'students', 'startDate', 'endDate', 'classId', 'studentId'));
    }

    /**
     * Generate enrollment report.
     */
    public function enrollment(Request $request)
    {
        $this->authorize('view reports');

        $students = TenantStudents::with(['user', 'classes', 'parents'])->get();
        $classes = TenantClasses::with(['students', 'teacher.user'])->get();

        // Calculate enrollment statistics
        $stats = [
            'total_students' => $students->count(),
            'total_classes' => $classes->count(),
            'average_class_size' => $classes->count() > 0 ? round($students->count() / $classes->count(), 1) : 0,
            'students_with_parents' => $students->filter(function ($student) {
                return $student->parents->count() > 0;
            })->count(),
        ];

        // Class enrollment breakdown
        $classEnrollment = $classes->map(function ($class) {
            return [
                'name' => $class->name,
                'description' => $class->description,
                'teacher' => $class->teacher ? $class->teacher->user->name : 'No teacher assigned',
                'student_count' => $class->students->count(),
                'capacity' => $class->capacity,
                'utilization' => $class->capacity > 0 ? round($class->students->count() / $class->capacity * 100, 1) : 0,
            ];
        });

        if ($request->input('format') === 'csv') {
            return $this->exportEnrollmentCsv($students, $classes);
        }

        return view('tenants.reports.enrollment', compact('students', 'classes', 'stats', 'classEnrollment'));
    }

    /**
     * Generate class summary report.
     */
    public function classSummary(Request $request)
    {
        $this->authorize('view reports');

        $classes = TenantClasses::with(['students.user', 'teacher.user'])->get();
        $teachers = TenantTeacher::with('user')->get();

        $summary = $classes->map(function ($class) {
            $attendanceRate = 0;
            if ($class->students->count() > 0) {
                $totalAttendance = Attendance::where('tenant_class_id', $class->id)
                    ->whereBetween('date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
                    ->count();
                $presentAttendance = Attendance::where('tenant_class_id', $class->id)
                    ->whereBetween('date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
                    ->whereIn('status', ['present', 'late'])
                    ->count();

                if ($totalAttendance > 0) {
                    $attendanceRate = round($presentAttendance / $totalAttendance * 100, 1);
                }
            }

            return [
                'id' => $class->id,
                'name' => $class->name,
                'description' => $class->description,
                'teacher' => $class->teacher ? $class->teacher->user->name : 'No teacher assigned',
                'student_count' => $class->students->count(),
                'capacity' => $class->capacity,
                'schedule' => $class->schedule,
                'room' => $class->room,
                'attendance_rate' => $attendanceRate,
                'created_at' => $class->created_at->format('M d, Y'),
            ];
        });

        if ($request->input('format') === 'csv') {
            return $this->exportClassSummaryCsv($summary);
        }

        return view('tenants.reports.class-summary', compact('summary', 'classes', 'teachers'));
    }

    /**
     * Generate activity report.
     */
    public function activity(Request $request)
    {
        $this->authorize('view reports');

        $startDate = $request->input('start_date', Carbon::now()->subDays(30)->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->format('Y-m-d'));

        // Get recent activities
        $activities = collect();

        // Recent student enrollments
        $recentStudents = TenantStudents::with('user')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($recentStudents as $student) {
            $activities->push([
                'type' => 'student_enrollment',
                'title' => 'New Student Enrolled',
                'description' => $student->user->name . ' was enrolled',
                'date' => $student->created_at,
                'icon' => 'fas fa-user-plus',
                'color' => 'green',
            ]);
        }

        // Recent announcements
        $recentAnnouncements = Announcement::with('creator')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($recentAnnouncements as $announcement) {
            $activities->push([
                'type' => 'announcement',
                'title' => 'New Announcement',
                'description' => $announcement->title,
                'date' => $announcement->created_at,
                'icon' => 'fas fa-bullhorn',
                'color' => 'blue',
            ]);
        }

        // Recent calendar events
        $recentEvents = CalendarEvent::whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($recentEvents as $event) {
            $activities->push([
                'type' => 'calendar_event',
                'title' => 'New Calendar Event',
                'description' => $event->title,
                'date' => $event->created_at,
                'icon' => 'fas fa-calendar',
                'color' => 'purple',
            ]);
        }

        // Recent classes created
        $recentClasses = TenantClasses::with('teacher.user')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($recentClasses as $class) {
            $activities->push([
                'type' => 'class_created',
                'title' => 'New Class Created',
                'description' => $class->name . ' was created',
                'date' => $class->created_at,
                'icon' => 'fas fa-chalkboard',
                'color' => 'orange',
            ]);
        }

        // Sort activities by date
        $activities = $activities->sortByDesc('date');

        // Calculate statistics
        $stats = [
            'total_activities' => $activities->count(),
            'students_enrolled' => $recentStudents->count(),
            'announcements_made' => $recentAnnouncements->count(),
            'events_created' => $recentEvents->count(),
            'classes_created' => $recentClasses->count(),
        ];

        if ($request->input('format') === 'csv') {
            return $this->exportActivityCsv($activities, $startDate, $endDate);
        }

        return view('tenants.reports.activity', compact('activities', 'stats', 'startDate', 'endDate'));
    }

    /**
     * Export attendance report as CSV.
     */
    private function exportAttendanceCsv($attendances, $startDate, $endDate)
    {
        $filename = 'attendance_report_' . $startDate . '_to_' . $endDate . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($attendances) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Date', 'Student Name', 'Class', 'Status', 'Notes', 'Marked By']);

            foreach ($attendances as $attendance) {
                fputcsv($file, [
                    $attendance->date->format('Y-m-d'),
                    $attendance->student->user->name,
                    $attendance->tenantClass->name,
                    ucfirst($attendance->status),
                    $attendance->notes,
                    $attendance->markedBy->name,
                ]);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    /**
     * Export enrollment report as CSV.
     */
    private function exportEnrollmentCsv($students, $classes)
    {
        $filename = 'enrollment_report_' . Carbon::now()->format('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($students, $classes) {
            $file = fopen('php://output', 'w');

            // Students section
            fputcsv($file, ['=== STUDENTS ===']);
            fputcsv($file, ['Student Name', 'Email', 'Enrolled Classes', 'Parents Count', 'Registration Date']);

            foreach ($students as $student) {
                fputcsv($file, [
                    $student->user->name,
                    $student->user->email,
                    $student->classes->pluck('name')->implode(', '),
                    $student->parents->count(),
                    $student->created_at->format('Y-m-d'),
                ]);
            }

            // Classes section
            fputcsv($file, []);
            fputcsv($file, ['=== CLASSES ===']);
            fputcsv($file, ['Class Name', 'Teacher', 'Student Count', 'Capacity', 'Utilization %']);

            foreach ($classes as $class) {
                $utilization = $class->capacity > 0 ? round($class->students->count() / $class->capacity * 100, 1) : 0;
                fputcsv($file, [
                    $class->name,
                    $class->teacher ? $class->teacher->user->name : 'No teacher assigned',
                    $class->students->count(),
                    $class->capacity,
                    $utilization . '%',
                ]);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    /**
     * Export class summary report as CSV.
     */
    private function exportClassSummaryCsv($summary)
    {
        $filename = 'class_summary_report_' . Carbon::now()->format('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($summary) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Class Name', 'Description', 'Teacher', 'Student Count', 'Capacity', 'Schedule', 'Room', 'Attendance Rate %', 'Created Date']);

            foreach ($summary as $class) {
                fputcsv($file, [
                    $class['name'],
                    $class['description'],
                    $class['teacher'],
                    $class['student_count'],
                    $class['capacity'],
                    $class['schedule'],
                    $class['room'],
                    $class['attendance_rate'] . '%',
                    $class['created_at'],
                ]);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    /**
     * Export activity report as CSV.
     */
    private function exportActivityCsv($activities, $startDate, $endDate)
    {
        $filename = 'activity_report_' . $startDate . '_to_' . $endDate . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($activities) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Date', 'Type', 'Title', 'Description']);

            foreach ($activities as $activity) {
                fputcsv($file, [
                    $activity['date']->format('Y-m-d H:i:s'),
                    ucfirst(str_replace('_', ' ', $activity['type'])),
                    $activity['title'],
                    $activity['description'],
                ]);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }
}

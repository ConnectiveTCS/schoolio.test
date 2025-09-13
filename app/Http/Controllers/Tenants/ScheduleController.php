<?php

namespace App\Http\Controllers\Tenants;

use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Models\TenantClasses;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    /**
     * Display a listing of all class schedules.
     */
    public function index()
    {
        // Check if user has permission to view classes
        $user = Auth::user();
        if (!$user->can('view classes')) {
            abort(403, 'You do not have permission to view class schedules.');
        }

        $tenant = tenant();

        // Get classes based on user role
        if ($user->hasRole('tenant_admin')) {
            $classes = TenantClasses::with(['teacher.user', 'students'])
                ->where('is_active', true)
                ->get();
        } else if ($user->hasRole('teacher') && $user->teacher) {
            $classes = TenantClasses::with(['teacher.user', 'students'])
                ->where('teacher_id', $user->teacher->id)
                ->where('is_active', true)
                ->get();
        } else if ($user->hasRole('student') && $user->student) {
            $classes = $user->student->classes()
                ->with(['teacher.user'])
                ->where('is_active', true)
                ->get();
        } else {
            $classes = collect();
        }

        // Process schedule data for better display
        $processedClasses = $classes->map(function ($class) {
            $schedule = $class->schedule;
            $processedSchedule = null;

            // Handle both array and string schedule data
            if (is_string($schedule)) {
                $schedule = json_decode($schedule, true);
            }

            if (is_array($schedule)) {
                // Check if it's the new format (with 'days' array) or old format (individual day keys)
                if (isset($schedule['days']) && is_array($schedule['days'])) {
                    // New format: unified schedule with days array
                    $processedSchedule = [
                        'days' => $schedule['days'],
                        'start_time' => $schedule['start_time'] ?? null,
                        'end_time' => $schedule['end_time'] ?? null,
                        'time_display' => isset($schedule['start_time'], $schedule['end_time'])
                            ? $schedule['start_time'] . ' - ' . $schedule['end_time']
                            : null,
                        'notes' => $schedule['notes'] ?? null,
                        'format' => 'unified'
                    ];
                } else {
                    // Old format: individual day schedules
                    $dayKeys = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
                    $dayLabels = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                    $days = [];
                    $individualSchedules = [];

                    foreach ($dayKeys as $index => $dayKey) {
                        if (isset($schedule[$dayKey]) && $schedule[$dayKey]) {
                            $days[] = $dayLabels[$index];
                            $individualSchedules[$dayLabels[$index]] = $schedule[$dayKey];
                        }
                    }

                    $processedSchedule = [
                        'days' => $days,
                        'individual_schedules' => $individualSchedules,
                        'time_display' => count($days) === 1 ? $individualSchedules[array_keys($individualSchedules)[0]] : count($days) . ' days',
                        'format' => 'individual'
                    ];
                }
            }

            return [
                'id' => $class->id,
                'name' => $class->name,
                'subject' => $class->subject,
                'room' => $class->room,
                'teacher_name' => $class->teacher->user->name ?? 'Unknown',
                'student_count' => $class->students->count(),
                'schedule' => $processedSchedule,
                'is_active' => $class->is_active,
            ];
        });

        // Group classes by days for better organization
        $scheduleByDay = [
            'Monday' => [],
            'Tuesday' => [],
            'Wednesday' => [],
            'Thursday' => [],
            'Friday' => [],
            'Saturday' => [],
            'Sunday' => [],
        ];

        foreach ($processedClasses as $class) {
            if ($class['schedule'] && isset($class['schedule']['days'])) {
                foreach ($class['schedule']['days'] as $day) {
                    if (isset($scheduleByDay[$day])) {
                        $scheduleByDay[$day][] = $class;
                    }
                }
            }
        }

        // Sort classes by time within each day
        foreach ($scheduleByDay as $day => $dayClasses) {
            usort($scheduleByDay[$day], function ($a, $b) {
                $timeA = $a['schedule']['start_time'] ?? '99:99';
                $timeB = $b['schedule']['start_time'] ?? '99:99';
                return strcmp($timeA, $timeB);
            });
        }

        return view('tenants.schedule.index', compact('tenant', 'processedClasses', 'scheduleByDay'));
    }

    /**
     * Get schedule data for a specific week (API endpoint for AJAX requests)
     */
    public function getWeekSchedule(Request $request)
    {
        $user = Auth::user();
        if (!$user->can('view classes')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $startDate = Carbon::parse($request->input('start_date', Carbon::now()->startOfWeek()));
        $endDate = $startDate->copy()->endOfWeek();

        // Get classes based on user role (same logic as index)
        if ($user->hasRole('tenant_admin')) {
            $classes = TenantClasses::with(['teacher.user', 'students'])
                ->where('is_active', true)
                ->get();
        } else if ($user->hasRole('teacher') && $user->teacher) {
            $classes = TenantClasses::with(['teacher.user', 'students'])
                ->where('teacher_id', $user->teacher->id)
                ->where('is_active', true)
                ->get();
        } else if ($user->hasRole('student') && $user->student) {
            $classes = $user->student->classes()
                ->with(['teacher.user'])
                ->where('is_active', true)
                ->get();
        } else {
            $classes = collect();
        }

        // Process schedule data
        $weekSchedule = [];
        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
            $dayName = $date->format('l'); // Monday, Tuesday, etc.
            $weekSchedule[$date->format('Y-m-d')] = [
                'date' => $date->format('Y-m-d'),
                'day_name' => $dayName,
                'classes' => []
            ];

            foreach ($classes as $class) {
                $schedule = $class->schedule;

                // Handle both array and string schedule data
                if (is_string($schedule)) {
                    $schedule = json_decode($schedule, true);
                }

                $shouldAddClass = false;
                $timeDisplay = 'Time TBD';
                $startTime = null;
                $endTime = null;

                if (is_array($schedule)) {
                    // Check if it's the new format (with 'days' array)
                    if (isset($schedule['days']) && in_array($dayName, $schedule['days'])) {
                        $shouldAddClass = true;
                        $startTime = $schedule['start_time'] ?? null;
                        $endTime = $schedule['end_time'] ?? null;
                        if ($startTime && $endTime) {
                            $timeDisplay = $startTime . ' - ' . $endTime;
                        }
                    } else {
                        // Check old format (individual day keys)
                        $dayKey = strtolower($dayName);
                        if (isset($schedule[$dayKey]) && $schedule[$dayKey]) {
                            $shouldAddClass = true;
                            $timeDisplay = $schedule[$dayKey];
                            // Extract start and end times from format like "09:00-10:00"
                            if (strpos($timeDisplay, '-') !== false) {
                                [$startTime, $endTime] = explode('-', $timeDisplay, 2);
                            }
                        }
                    }
                }

                if ($shouldAddClass) {
                    $weekSchedule[$date->format('Y-m-d')]['classes'][] = [
                        'id' => $class->id,
                        'name' => $class->name,
                        'subject' => $class->subject,
                        'room' => $class->room,
                        'teacher_name' => $class->teacher->user->name ?? 'Unknown',
                        'start_time' => $startTime,
                        'end_time' => $endTime,
                        'time_display' => $timeDisplay,
                    ];
                }
            }            // Sort classes by time
            usort($weekSchedule[$date->format('Y-m-d')]['classes'], function ($a, $b) {
                $timeA = $a['start_time'] ?? '99:99';
                $timeB = $b['start_time'] ?? '99:99';
                return strcmp($timeA, $timeB);
            });
        }

        return response()->json($weekSchedule);
    }
}

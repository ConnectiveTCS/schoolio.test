<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\CalendarEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarEventController extends Controller
{
    use AuthorizesRequests;
    /**
     * Management index (requires manage permission).
     */
    public function index()
    {
        $this->authorize('manage calendar events');

        $events = CalendarEvent::with('creator')
            ->orderBy('start_at', 'desc')
            ->paginate(15);

        return view('tenants.calendar_events.index', compact('events'));
    }

    /**
     * List events visible to the current user (no manage permission required).
     */
    public function userEvents()
    {
        $user = Auth::user();
        $roles = $user->getRoleNames()->toArray();

        $upcoming = CalendarEvent::published()
            ->forRoles($roles)
            ->upcoming()
            ->limit(50)
            ->get();

        return view('tenants.calendar_events.user-events', [
            'events' => $upcoming,
        ]);
    }

    public function create()
    {
        $this->authorize('create calendar events');
        $availableRoles = $this->availableRoles();
        return view('tenants.calendar_events.create', compact('availableRoles'));
    }

    public function store(Request $request)
    {
        $this->authorize('create calendar events');

        $validated = $this->validateEvent($request);

        $event = CalendarEvent::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'type' => $validated['type'],
            'start_at' => $validated['start_at'],
            'end_at' => $validated['end_at'] ?? null,
            'all_day' => $validated['all_day'] ?? false,
            'target_roles' => $validated['target_roles'] ?? null,
            'is_published' => $validated['is_published'] ?? true,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('tenant.calendar-events.index')
            ->with('success', 'Event created successfully.');
    }

    public function edit(CalendarEvent $calendar_event)
    {
        $this->authorize('edit calendar events');
        $availableRoles = $this->availableRoles();
        return view('tenants.calendar_events.edit', [
            'event' => $calendar_event,
            'availableRoles' => $availableRoles,
        ]);
    }

    public function update(Request $request, CalendarEvent $calendar_event)
    {
        $this->authorize('edit calendar events');
        $validated = $this->validateEvent($request);

        $calendar_event->update([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'type' => $validated['type'],
            'start_at' => $validated['start_at'],
            'end_at' => $validated['end_at'] ?? null,
            'all_day' => $validated['all_day'] ?? false,
            'target_roles' => $validated['target_roles'] ?? null,
            'is_published' => $validated['is_published'] ?? true,
        ]);

        return redirect()->route('tenant.calendar-events.index')
            ->with('success', 'Event updated successfully.');
    }

    public function destroy(CalendarEvent $calendar_event)
    {
        $this->authorize('delete calendar events');
        $calendar_event->delete();
        return redirect()->route('tenant.calendar-events.index')
            ->with('success', 'Event deleted successfully.');
    }

    public function togglePublish(CalendarEvent $calendar_event)
    {
        $this->authorize('edit calendar events');
        $calendar_event->update(['is_published' => !$calendar_event->is_published]);
        return back()->with('success', 'Event status updated.');
    }

    /**
     * Display a single event (read-only if user has visibility).
     */
    public function show(CalendarEvent $calendar_event)
    {
        $user = Auth::user();
        if (!$user || !$calendar_event->isVisibleToUser($user)) {
            $this->authorize('manage calendar events'); // fall back to allowing managers
        }
        return view('tenants.calendar_events.show', [
            'event' => $calendar_event,
        ]);
    }

    /**
     * JSON feed of upcoming events for current user roles (optionally filtered by date range & type).
     */
    public function feed(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['data' => []]);
        }

        $roles = $user->getRoleNames()->toArray();
        $query = CalendarEvent::published()->forRoles($roles);

        if ($request->filled('type')) {
            $types = array_intersect(explode(',', $request->string('type')), ['event', 'exam', 'holiday']);
            if ($types) {
                $query->whereIn('type', $types);
            }
        }

        $from = $request->date('from');
        $to = $request->date('to');
        if ($from && $to) {
            $query->between($from, $to);
        } else {
            $query->upcoming();
        }

        $events = $query->limit(200)->get()->map(fn($e) => [
            'id' => $e->id,
            'title' => $e->title,
            'type' => $e->type,
            'start' => $e->start_at->toIso8601String(),
            'end' => $e->end_at?->toIso8601String(),
            'all_day' => $e->all_day,
            'is_published' => $e->is_published,
        ]);

        return response()->json(['data' => $events]);
    }

    private function validateEvent(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:event,exam,holiday',
            'start_at' => 'required|date',
            'end_at' => 'nullable|date|after_or_equal:start_at',
            'all_day' => 'sometimes|boolean',
            'target_roles' => 'nullable|array',
            'target_roles.*' => 'in:tenant_admin,teacher,student,parent',
            'is_published' => 'sometimes|boolean',
        ]);
    }

    private function availableRoles(): array
    {
        return [
            'tenant_admin' => 'Tenant Admin',
            'teacher' => 'Teacher',
            'student' => 'Student',
            'parent' => 'Parent',
        ];
    }
}

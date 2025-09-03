<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SlaPolicy extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'is_active',
        'priority_order',
        'applies_to_priorities',
        'applies_to_categories',
        'applies_to_tenant_ids',
        'first_response_hours',
        'resolution_hours',
        'escalation_hours',
        'warning_threshold_percent',
        'critical_threshold_percent',
        'business_hours',
        'exclude_weekends',
        'exclude_holidays',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'applies_to_priorities' => 'array',
        'applies_to_categories' => 'array',
        'applies_to_tenant_ids' => 'array',
        'business_hours' => 'array',
        'exclude_weekends' => 'boolean',
        'exclude_holidays' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('priority_order', 'asc');
    }

    public function appliesTo(SupportTicket $ticket): bool
    {
        // Check priorities
        if ($this->applies_to_priorities && !in_array($ticket->priority, $this->applies_to_priorities)) {
            return false;
        }

        // Check categories
        if ($this->applies_to_categories && !in_array($ticket->category, $this->applies_to_categories)) {
            return false;
        }

        // Check tenant IDs
        if ($this->applies_to_tenant_ids && !in_array($ticket->tenant_id, $this->applies_to_tenant_ids)) {
            return false;
        }

        return true;
    }

    public function calculateSlaDeadline(SupportTicket $ticket, string $type = 'resolution'): ?Carbon
    {
        $hours = match ($type) {
            'first_response' => $this->first_response_hours,
            'resolution' => $this->resolution_hours,
            'escalation' => $this->escalation_hours,
            default => null
        };

        if (!$hours) {
            return null;
        }

        $startTime = $ticket->created_at;

        if ($this->business_hours || $this->exclude_weekends) {
            return $this->addBusinessHours($startTime, $hours);
        }

        return $startTime->copy()->addHours($hours);
    }

    public function getSlaStatus(SupportTicket $ticket, string $type = 'resolution'): string
    {
        $deadline = $this->calculateSlaDeadline($ticket, $type);

        if (!$deadline) {
            return 'on_track';
        }

        $now = now();
        $totalTime = $ticket->created_at->diffInMinutes($deadline);
        $elapsedTime = $ticket->created_at->diffInMinutes($now);

        if ($now > $deadline) {
            return 'breached';
        }

        $percentageElapsed = ($elapsedTime / $totalTime) * 100;

        if ($percentageElapsed >= $this->critical_threshold_percent) {
            return 'critical';
        }

        if ($percentageElapsed >= $this->warning_threshold_percent) {
            return 'warning';
        }

        return 'on_track';
    }

    private function addBusinessHours(Carbon $startTime, int $hours): Carbon
    {
        $workingTime = $startTime->copy();
        $hoursToAdd = $hours;

        $businessHours = $this->business_hours ?? [
            'start' => '09:00',
            'end' => '17:00',
            'days' => [1, 2, 3, 4, 5], // Monday to Friday
            'timezone' => 'UTC'
        ];

        $dailyHours = Carbon::parse($businessHours['end'])->diffInHours(Carbon::parse($businessHours['start']));

        while ($hoursToAdd > 0) {
            // Skip weekends if configured
            if ($this->exclude_weekends && in_array($workingTime->dayOfWeek, [0, 6])) {
                $workingTime->addDay();
                continue;
            }

            // Skip non-business days
            if (!in_array($workingTime->dayOfWeek, $businessHours['days'])) {
                $workingTime->addDay();
                continue;
            }

            // If before business hours, move to start of business day
            $dayStart = $workingTime->copy()->setTimeFromTimeString($businessHours['start']);
            $dayEnd = $workingTime->copy()->setTimeFromTimeString($businessHours['end']);

            if ($workingTime->lt($dayStart)) {
                $workingTime = $dayStart;
            }

            // If after business hours, move to next business day
            if ($workingTime->gte($dayEnd)) {
                $workingTime->addDay()->setTimeFromTimeString($businessHours['start']);
                continue;
            }

            // Calculate hours remaining in this business day
            $hoursLeftInDay = $workingTime->diffInHours($dayEnd, false);

            if ($hoursLeftInDay <= 0) {
                $workingTime->addDay()->setTimeFromTimeString($businessHours['start']);
                continue;
            }

            if ($hoursToAdd <= $hoursLeftInDay) {
                // Can finish within this business day
                $workingTime->addHours($hoursToAdd);
                $hoursToAdd = 0;
            } else {
                // Need to continue to next business day
                $hoursToAdd -= $hoursLeftInDay;
                $workingTime->addDay()->setTimeFromTimeString($businessHours['start']);
            }
        }

        return $workingTime;
    }
}

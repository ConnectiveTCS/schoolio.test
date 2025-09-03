<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AutoAssignmentRule extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'is_active',
        'priority_order',
        'categories',
        'priorities',
        'tenant_ids',
        'keywords',
        'assigned_admin_id',
        'assignment_strategy',
        'business_hours',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'categories' => 'array',
        'priorities' => 'array',
        'tenant_ids' => 'array',
        'keywords' => 'array',
        'business_hours' => 'array',
    ];

    public function assignedAdmin(): BelongsTo
    {
        return $this->belongsTo(CentralAdmin::class, 'assigned_admin_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('priority_order', 'asc');
    }

    public function matches(SupportTicket $ticket): bool
    {
        // Check categories
        if ($this->categories && !in_array($ticket->category, $this->categories)) {
            return false;
        }

        // Check priorities
        if ($this->priorities && !in_array($ticket->priority, $this->priorities)) {
            return false;
        }

        // Check tenant IDs
        if ($this->tenant_ids && !in_array($ticket->tenant_id, $this->tenant_ids)) {
            return false;
        }

        // Check keywords
        if ($this->keywords) {
            $content = strtolower($ticket->title . ' ' . $ticket->description);
            $hasKeyword = false;

            foreach ($this->keywords as $keyword) {
                if (str_contains($content, strtolower($keyword))) {
                    $hasKeyword = true;
                    break;
                }
            }

            if (!$hasKeyword) {
                return false;
            }
        }

        // Check business hours
        if ($this->business_hours && !$this->isWithinBusinessHours()) {
            return false;
        }

        return true;
    }

    private function isWithinBusinessHours(): bool
    {
        if (!$this->business_hours) {
            return true;
        }

        $now = now();
        $currentDay = $now->dayOfWeek; // 0 = Sunday, 6 = Saturday
        $currentTime = $now->format('H:i');

        $businessHours = $this->business_hours;

        // Check if current day is a business day
        if (isset($businessHours['days']) && !in_array($currentDay, $businessHours['days'])) {
            return false;
        }

        // Check if current time is within business hours
        if (isset($businessHours['start']) && isset($businessHours['end'])) {
            return $currentTime >= $businessHours['start'] && $currentTime <= $businessHours['end'];
        }

        return true;
    }
}

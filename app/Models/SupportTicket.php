<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SupportTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_number',
        'tenant_id',
        'title',
        'description',
        'priority',
        'status',
        'category',
        'tenant_user_details',
        'assigned_admin_id',
        'resolved_at',
        'resolution_notes',
        'attachments',
        'first_response_at',
        'sla_policy_id',
        'sla_due_at',
        'sla_status',
        'last_escalated_at',
        'escalation_level',
    ];

    protected $casts = [
        'tenant_user_details' => 'array',
        'attachments' => 'array',
        'resolved_at' => 'datetime',
        'first_response_at' => 'datetime',
        'sla_due_at' => 'datetime',
        'last_escalated_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($ticket) {
            if (!$ticket->ticket_number) {
                $ticket->ticket_number = 'TKT-' . strtoupper(uniqid());
            }
        });
    }

    public function assignedAdmin(): BelongsTo
    {
        return $this->belongsTo(CentralAdmin::class, 'assigned_admin_id');
    }

    public function replies(): HasMany
    {
        return $this->hasMany(SupportTicketReply::class)->orderBy('created_at', 'asc');
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }

    public function slaPolicy(): BelongsTo
    {
        return $this->belongsTo(SlaPolicy::class, 'sla_policy_id');
    }

    public function followUpReminders(): HasMany
    {
        return $this->hasMany(FollowUpReminder::class);
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeByPriority($query, $priority)
    {
        return $query->where('priority', $priority);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function getStatusColorAttribute()
    {
        return match ($this->status) {
            'open' => 'red',
            'in_progress' => 'yellow',
            'resolved' => 'green',
            'closed' => 'gray',
            default => 'gray'
        };
    }

    public function getPriorityColorAttribute()
    {
        return match ($this->priority) {
            'low' => 'green',
            'medium' => 'yellow',
            'high' => 'orange',
            'critical' => 'red',
            default => 'gray'
        };
    }

    public function getSlaStatusColorAttribute()
    {
        return match ($this->sla_status) {
            'on_track' => 'green',
            'warning' => 'yellow',
            'critical' => 'red',
            'breached' => 'red',
            default => 'gray'
        };
    }

    public function getSlaStatusTextAttribute()
    {
        return match ($this->sla_status) {
            'on_track' => 'On Track',
            'warning' => 'SLA Warning',
            'critical' => 'SLA Critical',
            'breached' => 'SLA Breached',
            default => 'Unknown'
        };
    }

    public function isOverdue(): bool
    {
        return $this->sla_due_at && now() > $this->sla_due_at;
    }

    public function isEscalated(): bool
    {
        return $this->escalation_level > 0;
    }

    public function hasFirstResponse(): bool
    {
        return !is_null($this->first_response_at);
    }

    public function applySlaPolicy(): void
    {
        $slaPolicy = SlaPolicy::active()
            ->ordered()
            ->get()
            ->first(function ($policy) {
                return $policy->appliesTo($this);
            });

        if ($slaPolicy) {
            $this->update([
                'sla_policy_id' => $slaPolicy->id,
                'sla_due_at' => $slaPolicy->calculateSlaDeadline($this, 'resolution'),
                'sla_status' => 'on_track',
            ]);
        }
    }

    public function updateSlaStatus(): void
    {
        if ($this->slaPolicy) {
            $newStatus = $this->slaPolicy->getSlaStatus($this, 'resolution');

            if ($newStatus !== $this->sla_status) {
                $this->update(['sla_status' => $newStatus]);
            }
        }
    }
}

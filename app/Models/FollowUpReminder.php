<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FollowUpReminder extends Model
{
    use HasFactory;

    protected $fillable = [
        'support_ticket_id',
        'admin_id',
        'reminder_type',
        'scheduled_at',
        'sent_at',
        'is_sent',
        'message',
        'metadata',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'sent_at' => 'datetime',
        'is_sent' => 'boolean',
        'metadata' => 'array',
    ];

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(SupportTicket::class, 'support_ticket_id');
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(CentralAdmin::class, 'admin_id');
    }

    public function scopePending($query)
    {
        return $query->where('is_sent', false);
    }

    public function scopeDue($query)
    {
        return $query->where('scheduled_at', '<=', now());
    }

    public function scopeByType($query, string $type)
    {
        return $query->where('reminder_type', $type);
    }

    public function markAsSent(): void
    {
        $this->update([
            'is_sent' => true,
            'sent_at' => now(),
        ]);
    }

    public static function scheduleFollowUp(
        SupportTicket $ticket,
        CentralAdmin $admin,
        int $hoursFromNow,
        string $message = null
    ): self {
        return self::create([
            'support_ticket_id' => $ticket->id,
            'admin_id' => $admin->id,
            'reminder_type' => 'follow_up',
            'scheduled_at' => now()->addHours($hoursFromNow),
            'message' => $message ?? "Follow up required for ticket {$ticket->ticket_number}",
        ]);
    }

    public static function scheduleSlaWarning(
        SupportTicket $ticket,
        CentralAdmin $admin,
        \DateTime $warningTime,
        string $slaType = 'resolution'
    ): self {
        return self::create([
            'support_ticket_id' => $ticket->id,
            'admin_id' => $admin->id,
            'reminder_type' => 'sla_warning',
            'scheduled_at' => $warningTime,
            'message' => "SLA warning: Ticket {$ticket->ticket_number} approaching {$slaType} deadline",
            'metadata' => [
                'sla_type' => $slaType,
                'ticket_priority' => $ticket->priority,
            ],
        ]);
    }

    public static function scheduleEscalation(
        SupportTicket $ticket,
        CentralAdmin $admin,
        \DateTime $escalationTime
    ): self {
        return self::create([
            'support_ticket_id' => $ticket->id,
            'admin_id' => $admin->id,
            'reminder_type' => 'escalation',
            'scheduled_at' => $escalationTime,
            'message' => "Escalation required for ticket {$ticket->ticket_number}",
            'metadata' => [
                'current_priority' => $ticket->priority,
                'escalation_level' => $ticket->escalation_level,
            ],
        ]);
    }
}

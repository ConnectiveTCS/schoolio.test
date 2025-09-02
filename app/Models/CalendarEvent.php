<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CalendarEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'type',
        'start_at',
        'end_at',
        'all_day',
        'target_roles',
        'is_published',
        'created_by',
    ];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'all_day' => 'boolean',
        'is_published' => 'boolean',
        'target_roles' => 'array',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function scopeUpcoming(Builder $query): Builder
    {
        return $query->where('start_at', '>=', now())->orderBy('start_at', 'asc');
    }

    public function scopeForRoles(Builder $query, array $roles): Builder
    {
        return $query->where(function ($q) use ($roles) {
            $q->whereNull('target_roles')
                ->orWhereJsonContains('target_roles', $roles);
        });
    }

    public function scopeBetween(Builder $query, $from, $to): Builder
    {
        return $query->where(function ($q) use ($from, $to) {
            $q->whereBetween('start_at', [$from, $to])
                ->orWhere(function ($q2) use ($from, $to) {
                    // Event starts before window but ends within/after window
                    $q2->where('start_at', '<', $from)
                        ->where(function ($q3) use ($from) {
                            $q3->whereNull('end_at')->orWhere('end_at', '>=', $from);
                        });
                });
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */
    public function isVisibleToUser(User $user): bool
    {
        if (!$this->is_published) {
            return false;
        }

        $roles = $user->getRoleNames()->toArray();
        $targets = $this->target_roles ?? [];
        if (empty($targets)) {
            return true; // global event
        }
        return !empty(array_intersect($targets, $roles));
    }

    public function getDurationDaysAttribute(): int
    {
        if (!$this->end_at) {
            return 1;
        }
        return $this->start_at->startOfDay()->diffInDays($this->end_at->endOfDay()) + 1;
    }
}

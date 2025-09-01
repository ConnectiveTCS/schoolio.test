<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'target_roles',
        'created_by',
        'is_active',
        'expires_at',
        'attachments',
    ];

    protected $casts = [
        'target_roles' => 'array',
        'attachments' => 'array',
        'is_active' => 'boolean',
        'expires_at' => 'datetime',
    ];

    /**
     * Get the user who created the announcement.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Scope to get active announcements that haven't expired.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            });
    }

    /**
     * Scope to get announcements for a specific role.
     */
    public function scopeForRole(Builder $query, string $role): Builder
    {
        return $query->whereJsonContains('target_roles', $role);
    }

    /**
     * Scope to get announcements for multiple roles.
     */
    public function scopeForRoles(Builder $query, array $roles): Builder
    {
        return $query->where(function ($q) use ($roles) {
            foreach ($roles as $role) {
                $q->orWhereJsonContains('target_roles', $role);
            }
        });
    }

    /**
     * Check if the announcement is visible to a specific user.
     */
    public function isVisibleToUser(User $user): bool
    {
        if (!$this->is_active) {
            return false;
        }

        if ($this->expires_at && $this->expires_at->isPast()) {
            return false;
        }

        $userRoles = $user->getRoleNames()->toArray();
        return !empty(array_intersect($this->target_roles, $userRoles));
    }

    /**
     * Get formatted target roles for display.
     */
    public function getFormattedTargetRolesAttribute(): string
    {
        $roleLabels = [
            'tenant_admin' => 'Tenant Admin',
            'teacher' => 'Teacher',
            'student' => 'Student',
            'parent' => 'Parent',
            'admin' => 'System Admin',
            'multi_admin' => 'Multi Admin',
        ];

        return collect($this->target_roles)
            ->map(fn($role) => $roleLabels[$role] ?? ucfirst(str_replace('_', ' ', $role)))
            ->join(', ');
    }

    /**
     * Check if the announcement has attachments.
     */
    public function hasAttachments(): bool
    {
        return !empty($this->attachments);
    }

    /**
     * Get the number of attachments.
     */
    public function getAttachmentCountAttribute(): int
    {
        return count($this->attachments ?? []);
    }

    /**
     * Get attachment URL for a specific attachment.
     */
    public function getAttachmentUrl(string $filename): string
    {
        return route('tenant.file', 'announcements/' . $filename);
    }

    /**
     * Get formatted file size.
     */
    public function formatFileSize(int $bytes): string
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= pow(1024, $pow);

        return round($bytes, 2) . ' ' . $units[$pow];
    }
}

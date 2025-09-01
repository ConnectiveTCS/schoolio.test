<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class ImpersonationToken extends Model
{
    /**
     * The connection name for the model.
     * This ensures it always uses the central database.
     */
    protected $connection = 'mysql';

    protected $fillable = [
        'token',
        'tenant_id',
        'central_admin_id',
        'expires_at',
        'used_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'used_at' => 'datetime',
    ];

    /**
     * Generate a new impersonation token
     */
    public static function generate(string $tenantId, int $centralAdminId): self
    {
        return self::create([
            'token' => Str::random(64),
            'tenant_id' => $tenantId,
            'central_admin_id' => $centralAdminId,
            'expires_at' => now()->addMinutes(15), // Token expires in 15 minutes
        ]);
    }

    /**
     * Check if the token is valid
     */
    public function isValid(): bool
    {
        return $this->expires_at->isFuture() && is_null($this->used_at);
    }

    /**
     * Mark token as used
     */
    public function markAsUsed(): void
    {
        $this->update(['used_at' => now()]);
    }

    /**
     * Get the central admin that created this token
     */
    public function centralAdmin(): BelongsTo
    {
        return $this->belongsTo(CentralAdmin::class, 'central_admin_id');
    }

    /**
     * Clean up expired tokens
     */
    public static function cleanExpired(): void
    {
        self::where('expires_at', '<', now())->delete();
    }
}

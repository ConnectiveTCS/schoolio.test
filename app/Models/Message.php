<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'content',
        'sender_id',
        'recipient_id',
        'read_at',
        'sender_deleted',
        'recipient_deleted',
        'message_type',
        'priority',
    ];

    protected $casts = [
        'read_at' => 'datetime',
        'sender_deleted' => 'boolean',
        'recipient_deleted' => 'boolean',
    ];

    /**
     * Get the sender of the message.
     */
    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Get the recipient of the message.
     */
    public function recipient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): HasMany
    {
        return $this->hasMany(MessageAttachment::class);
    }

    /**
     * Mark the message as read.
     */
    public function markAsRead(): void
    {
        if (!$this->read_at) {
            $this->update(['read_at' => now()]);
        }
    }

    /**
     * Check if the message is read.
     */
    public function isRead(): bool
    {
        return !is_null($this->read_at);
    }

    /**
     * Check if the message is unread.
     */
    public function isUnread(): bool
    {
        return is_null($this->read_at);
    }

    /**
     * Soft delete for sender.
     */
    public function deleteBySender(): void
    {
        $this->update(['sender_deleted' => true]);
    }

    /**
     * Soft delete for recipient.
     */
    public function deleteByRecipient(): void
    {
        $this->update(['recipient_deleted' => true]);
    }

    /**
     * Scope to get messages for a specific user (sent or received).
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where(function ($q) use ($userId) {
            $q->where('sender_id', $userId)
                ->orWhere('recipient_id', $userId);
        });
    }

    /**
     * Scope to get inbox messages for a user.
     */
    public function scopeInbox($query, $userId)
    {
        return $query->where('recipient_id', $userId)
            ->where('recipient_deleted', false);
    }

    /**
     * Scope to get sent messages for a user.
     */
    public function scopeSent($query, $userId)
    {
        return $query->where('sender_id', $userId)
            ->where('sender_deleted', false);
    }

    /**
     * Scope to get unread messages for a user.
     */
    public function scopeUnread($query, $userId)
    {
        return $query->where('recipient_id', $userId)
            ->whereNull('read_at')
            ->where('recipient_deleted', false);
    }

    /**
     * Get the other participant in the conversation for a given user.
     */
    public function getOtherParticipant($userId)
    {
        return $this->sender_id == $userId ? $this->recipient : $this->sender;
    }
}

<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'department',
        'position',
        'allow_messages',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'allow_messages' => 'boolean',
        ];
    }

    public function teacher()
    {
        return $this->hasOne(TenantTeacher::class, 'user_id');
    }

    public function student()
    {
        return $this->hasOne(TenantStudents::class, 'user_id');
    }

    /**
     * Get messages sent by this user.
     */
    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    /**
     * Get messages received by this user.
     */
    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'recipient_id');
    }

    /**
     * Get all messages for this user (sent and received).
     */
    public function messages()
    {
        return Message::forUser($this->id);
    }

    /**
     * Get unread messages count for this user.
     */
    public function getUnreadMessagesCountAttribute()
    {
        try {
            // Check if messages table exists
            if (!Schema::hasTable('messages')) {
                return 0;
            }
            return Message::unread($this->id)->count();
        } catch (\Exception $e) {
            // Return 0 if there's any database error
            return 0;
        }
    }

    /**
     * Check if user can receive messages.
     */
    public function canReceiveMessages(): bool
    {
        return $this->allow_messages ?? true;
    }

    /**
     * Get user's contact information for display.
     */
    public function getContactInfoAttribute(): array
    {
        return [
            'phone' => $this->phone,
            'address' => $this->address,
            'department' => $this->department,
            'position' => $this->position,
        ];
    }

    /**
     * Get parent relationship (if user is a parent).
     */
    public function parent()
    {
        return $this->hasOne(TenantParents::class, 'user_id');
    }
}

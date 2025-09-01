<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\TenantTeacher
 *
 * @property int $id
 * @property int $tenant_id
 * @property int $user_id
 * @property string $name
 * @property string $email
 * @property string|null $subject
 * @property string|null $bio
 * @property string|null $phone
 * @property string|null $address
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
class TenantTeacher extends Model
{
    use HasFactory;

    protected $table = 'tenant_teachers';

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'subject',
        'bio',
        'phone',
        'address',
        'profile_picture',
        'hire_date',
        'is_active',
    ];

    /**
     * Get the user associated with the teacher.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the classes taught by the teacher.
     */
    public function classes()
    {
        return $this->hasMany(TenantClasses::class, 'teacher_id');
    }
}

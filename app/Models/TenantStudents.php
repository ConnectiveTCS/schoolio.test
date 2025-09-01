<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TenantStudents
 *
 * @property int $id
 * @property int $tenant_id
 * @property int $user_id
 * @property string $name
 * @property string $email
 * @property string|null $phone
 * @property string|null $address
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
class TenantStudents extends Model
{
    use HasFactory;
    protected $table = 'tenant_students';

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'address',
        'date_of_birth',
        'gender',
        'enrollment_date',
        'guardian_name',
        'guardian_contact',
        'is_active',
    ];

    /**
     * Get the user associated with the student.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the parents associated with the student.
     */
    public function parents()
    {
        return $this->hasMany(TenantParents::class, 'tenant_student_id');
    }

    /**
     * Get the classes the student is enrolled in.
     */
    public function classes()
    {
        return $this->belongsToMany(TenantClasses::class, 'student_class_enrollments', 'tenant_student_id', 'tenant_class_id')
            ->withPivot('enrolled_at', 'is_active')
            ->withTimestamps();
    }

    /**
     * Get active classes only.
     */
    public function activeClasses()
    {
        return $this->classes()->wherePivot('is_active', true);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TenantClasses
 *
 * @property int $id
 * @property int $tenant_id
 * @property int $teacher_id
 * @property string $name
 * @property string|null $subject
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
class TenantClasses extends Model
{
    use HasFactory;
    protected $table = 'tenant_classes';

    protected $fillable = [
        'teacher_id',
        'name',
        'subject',
        'description',
        'room',
        'schedule',
        'is_active',
    ];

    protected $casts = [
        'schedule' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Get the teacher for the class.
     */
    public function teacher()
    {
        return $this->belongsTo(TenantTeacher::class, 'teacher_id');
    }

    /**
     * Get the students enrolled in the class.
     */
    public function students()
    {
        return $this->belongsToMany(TenantStudents::class, 'student_class_enrollments', 'tenant_class_id', 'tenant_student_id')
            ->withPivot('enrolled_at', 'is_active')
            ->withTimestamps();
    }

    /**
     * Get active students only.
     */
    public function activeStudents()
    {
        return $this->students()->wherePivot('is_active', true);
    }
}

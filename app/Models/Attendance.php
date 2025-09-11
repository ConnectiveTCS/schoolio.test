<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'tenant_student_id',
        'tenant_class_id',
        'date',
        'status',
        'marked_by',
        'notes',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    // Status constants
    const STATUS_PRESENT = 'present';
    const STATUS_ABSENT = 'absent';
    const STATUS_LATE = 'late';
    const STATUS_EXCUSED = 'excused';

    public static function getStatusOptions()
    {
        return [
            self::STATUS_PRESENT => 'Present',
            self::STATUS_ABSENT => 'Absent',
            self::STATUS_LATE => 'Late',
            self::STATUS_EXCUSED => 'Excused',
        ];
    }

    /**
     * Get the student that this attendance record belongs to.
     */
    public function student()
    {
        return $this->belongsTo(TenantStudents::class, 'tenant_student_id');
    }

    /**
     * Get the class that this attendance record belongs to.
     */
    public function tenantClass()
    {
        return $this->belongsTo(TenantClasses::class, 'tenant_class_id');
    }

    /**
     * Get the user who marked this attendance.
     */
    public function markedBy()
    {
        return $this->belongsTo(User::class, 'marked_by');
    }

    /**
     * Scope to filter attendance by date range.
     */
    public function scopeBetweenDates($query, $startDate, $endDate)
    {
        return $query->whereBetween('date', [$startDate, $endDate]);
    }

    /**
     * Scope to filter attendance by status.
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope to filter attendance by class.
     */
    public function scopeByClass($query, $classId)
    {
        return $query->where('tenant_class_id', $classId);
    }

    /**
     * Scope to filter attendance by student.
     */
    public function scopeByStudent($query, $studentId)
    {
        return $query->where('tenant_student_id', $studentId);
    }
}

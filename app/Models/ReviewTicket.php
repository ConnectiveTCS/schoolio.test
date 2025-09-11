<?php

namespace App\Models;

use App\Models\TenantTeacher;
use App\Models\TenantStudents;
use App\Models\TenantClasses;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReviewTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'class_id',
        'student_id',
        'title',
        'questions',
        'comments',
        'status',
    ];

    protected $casts = [
        'questions' => 'array',
    ];

    public function teacher()
    {
        return $this->belongsTo(TenantTeacher::class, 'teacher_id');
    }

    public function student()
    {
        return $this->belongsTo(TenantStudents::class, 'student_id');
    }

    public function class()
    {
        return $this->belongsTo(TenantClasses::class, 'class_id');
    }
}

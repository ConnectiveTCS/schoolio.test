<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TenantParents extends Model
{
    //
    protected $table = 'tenant_parents';

    protected $fillable = [
        'user_id',
        'tenant_student_id',
        'name',
        'email',
        'phone',
        'address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function student()
    {
        return $this->belongsTo(TenantStudents::class, 'tenant_student_id');
    }

    public function students()
    {
        return $this->hasMany(TenantStudents::class, 'tenant_parent_id');
    }
}

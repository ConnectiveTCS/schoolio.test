<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains, HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'alt_phone',
        'logo',
        'website',
        'address',
        'status',
        'plan',
        'trial_ends_at',
        'payment_method',
        'language',
        'school_type',
        'timezone',
        'color_scheme',
        'data',
    ];

    protected $casts = [
        'color_scheme' => 'array',
        'data' => 'array',
        'trial_ends_at' => 'date',
    ];

    public static function getCustomColumns(): array
    {
        return [
            'id',
            'name',
            'email',
            'phone',
            'alt_phone',
            'logo',
            'website',
            'address',
            'status',
            'plan',
            'trial_ends_at',
            'payment_method',
            'language',
            'school_type',
            'timezone',
            'color_scheme',
            'data',
        ];
    }
}

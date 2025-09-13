<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    //
    protected $fillable = [
        // 'tenant_id',
        'asset_name',
        'asset_model',
        'manufacturer',
        'vendor',
        'warranty_period',
        'warranty_expiry_date',
        'asset_image',
        'additional_images',
        'asset_type',
        'serial_number',
        'purchase_date',
        'purchase_price',
        'condition',
        'notes',
        'location',
    ];
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    protected $casts = [
        'purchase_date' => 'date',
        'warranty_expiry_date' => 'date',
        'purchase_price' => 'decimal:2',
        'additional_images' => 'array',
    ];

    public function scopeCondition($query, $condition)
    {
        return $query->where('condition', $condition);
    }
}

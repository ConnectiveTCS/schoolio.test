<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'type',
        'description'
    ];

    protected $casts = [
        'value' => 'string',
    ];

    /**
     * Get a setting value by key
     */
    public static function get($key, $default = null)
    {
        $setting = static::where('key', $key)->first();

        if (!$setting) {
            return $default;
        }

        return static::castValue($setting->value, $setting->type);
    }

    /**
     * Set a setting value
     */
    public static function set($key, $value, $type = 'string', $description = null)
    {
        return static::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'type' => $type,
                'description' => $description
            ]
        );
    }

    /**
     * Cast value based on type
     */
    private static function castValue($value, $type)
    {
        switch ($type) {
            case 'boolean':
                return (bool) $value;
            case 'integer':
                return (int) $value;
            case 'json':
                return json_decode($value, true);
            default:
                return $value;
        }
    }

    /**
     * Get all email settings
     */
    public static function getEmailSettings()
    {
        return [
            'mail_mailer' => static::get('mail_mailer', config('mail.default')),
            'mail_host' => static::get('mail_host', config('mail.mailers.smtp.host')),
            'mail_port' => static::get('mail_port', config('mail.mailers.smtp.port')),
            'mail_username' => static::get('mail_username', config('mail.mailers.smtp.username')),
            'mail_password' => static::get('mail_password', ''),
            'mail_encryption' => static::get('mail_encryption', 'tls'),
            'mail_from_address' => static::get('mail_from_address', config('mail.from.address')),
            'mail_from_name' => static::get('mail_from_name', config('mail.from.name')),
        ];
    }
}

<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmailSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $emailSettings = [
            [
                'key' => 'mail_mailer',
                'value' => env('MAIL_MAILER', 'smtp'),
                'type' => 'string',
                'description' => 'Mail driver/mailer'
            ],
            [
                'key' => 'mail_host',
                'value' => env('MAIL_HOST', '127.0.0.1'),
                'type' => 'string',
                'description' => 'SMTP server host'
            ],
            [
                'key' => 'mail_port',
                'value' => env('MAIL_PORT', '587'),
                'type' => 'integer',
                'description' => 'SMTP server port'
            ],
            [
                'key' => 'mail_username',
                'value' => env('MAIL_USERNAME', ''),
                'type' => 'string',
                'description' => 'SMTP username'
            ],
            [
                'key' => 'mail_password',
                'value' => env('MAIL_PASSWORD', ''),
                'type' => 'string',
                'description' => 'SMTP password'
            ],
            [
                'key' => 'mail_encryption',
                'value' => env('MAIL_ENCRYPTION', 'tls'),
                'type' => 'string',
                'description' => 'Mail encryption method'
            ],
            [
                'key' => 'mail_from_address',
                'value' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
                'type' => 'string',
                'description' => 'Default from email address'
            ],
            [
                'key' => 'mail_from_name',
                'value' => env('MAIL_FROM_NAME', 'Example'),
                'type' => 'string',
                'description' => 'Default from name'
            ],
        ];

        foreach ($emailSettings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}

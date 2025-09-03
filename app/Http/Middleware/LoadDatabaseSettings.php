<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\Response;

class LoadDatabaseSettings
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Load settings if the database and settings table exist
        if (Schema::hasTable('settings')) {
            try {
                $emailSettings = Setting::getEmailSettings();

                // Update mail configuration with database settings
                Config::set('mail.default', $emailSettings['mail_mailer']);
                Config::set('mail.mailers.smtp.host', $emailSettings['mail_host']);
                Config::set('mail.mailers.smtp.port', $emailSettings['mail_port']);
                Config::set('mail.mailers.smtp.username', $emailSettings['mail_username']);
                Config::set('mail.mailers.smtp.password', $emailSettings['mail_password']);
                Config::set('mail.mailers.smtp.encryption', $emailSettings['mail_encryption']);
                Config::set('mail.from.address', $emailSettings['mail_from_address']);
                Config::set('mail.from.name', $emailSettings['mail_from_name']);
            } catch (\Exception $e) {
                // Silently fail if there's an issue loading settings
            }
        }

        return $next($request);
    }
}

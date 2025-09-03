<?php

namespace App\Http\Controllers\Central;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;

class SettingsController extends Controller
{
    /**
     * Display the settings page
     */
    public function index()
    {
        $emailSettings = Setting::getEmailSettings();

        return view('central.settings.index', compact('emailSettings'));
    }

    /**
     * Update email configuration
     */
    public function updateEmailConfig(Request $request)
    {
        $request->validate([
            'mail_mailer' => 'required|string|in:smtp,sendmail,mailgun,ses,postmark,log',
            'mail_host' => 'required_if:mail_mailer,smtp|string|max:255',
            'mail_port' => 'required_if:mail_mailer,smtp|integer|min:1|max:65535',
            'mail_username' => 'nullable|string|max:255',
            'mail_password' => 'nullable|string|max:255',
            'mail_encryption' => 'nullable|string|in:tls,ssl',
            'mail_from_address' => 'required|email|max:255',
            'mail_from_name' => 'required|string|max:255',
        ]);

        try {
            // Store settings in database
            Setting::set('mail_mailer', $request->mail_mailer, 'string', 'Mail driver/mailer');
            Setting::set('mail_host', $request->mail_host, 'string', 'SMTP server host');
            Setting::set('mail_port', $request->mail_port, 'integer', 'SMTP server port');
            Setting::set('mail_username', $request->mail_username, 'string', 'SMTP username');

            // Only update password if provided
            if ($request->filled('mail_password')) {
                Setting::set('mail_password', $request->mail_password, 'string', 'SMTP password');
            }

            Setting::set('mail_encryption', $request->mail_encryption, 'string', 'Mail encryption method');
            Setting::set('mail_from_address', $request->mail_from_address, 'string', 'Default from email address');
            Setting::set('mail_from_name', $request->mail_from_name, 'string', 'Default from name');

            // Update runtime configuration
            $this->updateMailConfig($request);

            return redirect()->back()->with('success', 'Email configuration updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update email configuration: ' . $e->getMessage());
        }
    }

    /**
     * Test email configuration
     */
    public function testEmail(Request $request)
    {
        $request->validate([
            'test_email' => 'required|email'
        ]);

        try {
            // Update mail config with current settings
            $emailSettings = Setting::getEmailSettings();
            $this->updateMailConfigFromSettings($emailSettings);

            // Send test email
            Mail::raw('This is a test email from Schoolio system. If you received this, your email configuration is working correctly.', function ($message) use ($request) {
                $message->to($request->test_email)
                    ->subject('Schoolio - Test Email Configuration');
            });

            return redirect()->back()->with('success', 'Test email sent successfully to ' . $request->test_email);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to send test email: ' . $e->getMessage());
        }
    }

    /**
     * Update mail configuration at runtime
     */
    private function updateMailConfig(Request $request)
    {
        Config::set('mail.default', $request->mail_mailer);
        Config::set('mail.mailers.smtp.host', $request->mail_host);
        Config::set('mail.mailers.smtp.port', $request->mail_port);
        Config::set('mail.mailers.smtp.username', $request->mail_username);

        if ($request->filled('mail_password')) {
            Config::set('mail.mailers.smtp.password', $request->mail_password);
        }

        Config::set('mail.mailers.smtp.encryption', $request->mail_encryption);
        Config::set('mail.from.address', $request->mail_from_address);
        Config::set('mail.from.name', $request->mail_from_name);
    }

    /**
     * Update mail configuration from settings
     */
    private function updateMailConfigFromSettings($settings)
    {
        Config::set('mail.default', $settings['mail_mailer']);
        Config::set('mail.mailers.smtp.host', $settings['mail_host']);
        Config::set('mail.mailers.smtp.port', $settings['mail_port']);
        Config::set('mail.mailers.smtp.username', $settings['mail_username']);
        Config::set('mail.mailers.smtp.password', $settings['mail_password']);
        Config::set('mail.mailers.smtp.encryption', $settings['mail_encryption']);
        Config::set('mail.from.address', $settings['mail_from_address']);
        Config::set('mail.from.name', $settings['mail_from_name']);
    }
}

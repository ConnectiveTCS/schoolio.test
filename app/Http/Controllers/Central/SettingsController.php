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
        $backupSettings = Setting::getBackupSettings();

        return view('central.settings.index', compact('emailSettings', 'backupSettings'));
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

    /**
     * Update backup and maintenance configuration
     */
    public function updateBackupConfig(Request $request)
    {
        $request->validate([
            'backup_enabled' => 'boolean',
            'backup_frequency' => 'required|string|in:daily,weekly,monthly',
            'backup_time' => 'required|string',
            'backup_retention_days' => 'required|integer|min:1|max:365',
            'backup_storage_path' => 'required|string|max:255',
            'maintenance_enabled' => 'boolean',
            'maintenance_frequency' => 'required|string|in:weekly,monthly,quarterly',
            'maintenance_time' => 'required|string',
            'maintenance_duration' => 'required|string|in:1,2,4,6',
            'maintenance_message' => 'required|string|max:500',
        ]);

        try {
            // Store backup settings
            Setting::set('backup_enabled', $request->has('backup_enabled'), 'boolean', 'Enable automatic backups');
            Setting::set('backup_frequency', $request->backup_frequency, 'string', 'Backup frequency');
            Setting::set('backup_time', $request->backup_time, 'string', 'Backup time');
            Setting::set('backup_retention_days', $request->backup_retention_days, 'integer', 'Backup retention days');
            Setting::set('backup_storage_path', $request->backup_storage_path, 'string', 'Backup storage path');

            // Store maintenance settings
            Setting::set('maintenance_enabled', $request->has('maintenance_enabled'), 'boolean', 'Enable scheduled maintenance');
            Setting::set('maintenance_frequency', $request->maintenance_frequency, 'string', 'Maintenance frequency');
            Setting::set('maintenance_time', $request->maintenance_time, 'string', 'Maintenance time');
            Setting::set('maintenance_duration', $request->maintenance_duration, 'string', 'Maintenance duration in hours');
            Setting::set('maintenance_message', $request->maintenance_message, 'string', 'Maintenance message for users');

            return redirect()->back()->with('backup_success', 'Backup and maintenance settings updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('backup_error', 'Failed to update backup settings: ' . $e->getMessage());
        }
    }

    /**
     * Create a manual backup
     */
    public function createBackup()
    {
        try {
            // Run backup command
            Artisan::call('backup:run');

            return redirect()->back()->with('backup_success', 'Manual backup created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('backup_error', 'Failed to create backup: ' . $e->getMessage());
        }
    }

    /**
     * Toggle maintenance mode
     */
    public function toggleMaintenance()
    {
        try {
            if (app()->isDownForMaintenance()) {
                Artisan::call('up');
                $message = 'Maintenance mode disabled successfully.';
            } else {
                $maintenanceMessage = Setting::get('maintenance_message', 'We are currently performing scheduled maintenance. Please check back later.');
                Artisan::call('down', [
                    '--message' => $maintenanceMessage,
                    '--retry' => 60,
                ]);
                $message = 'Maintenance mode enabled successfully.';
            }

            return redirect()->back()->with('backup_success', $message);
        } catch (\Exception $e) {
            return redirect()->back()->with('backup_error', 'Failed to toggle maintenance mode: ' . $e->getMessage());
        }
    }

    /**
     * List backup files
     */
    public function listBackups()
    {
        try {
            $backupPath = Setting::get('backup_storage_path', 'storage/app/backups');
            $fullPath = base_path($backupPath);

            $backups = [];
            if (is_dir($fullPath)) {
                $files = glob($fullPath . '/*.zip');
                foreach ($files as $file) {
                    $backups[] = [
                        'name' => basename($file),
                        'size' => filesize($file),
                        'date' => filemtime($file),
                        'path' => $file
                    ];
                }
                // Sort by date, newest first
                usort($backups, function ($a, $b) {
                    return $b['date'] - $a['date'];
                });
            }

            return view('central.settings.backup-list', compact('backups'));
        } catch (\Exception $e) {
            return redirect()->back()->with('backup_error', 'Failed to list backups: ' . $e->getMessage());
        }
    }
}

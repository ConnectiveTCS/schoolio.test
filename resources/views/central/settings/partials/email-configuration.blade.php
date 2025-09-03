<div class="space-y-6">
    @if (session('success'))
        <div class="rounded-md bg-green-50 p-4 transition-colors duration-200 dark:bg-green-900/20">
            <div class="flex">
                <div class="flex-shrink-0">
                    {{-- <x-heroicon-s-check-circle class="h-5 w-5 text-green-400" /> --}}
                    <i class="fas fa-check h-5 w-5 text-green-400"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800 transition-colors duration-200 dark:text-green-300">
                        {{ session('success') }}
                    </p>
                </div>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="rounded-md bg-red-50 p-4 transition-colors duration-200 dark:bg-red-900/20">
            <div class="flex">
                <div class="flex-shrink-0">
                    {{-- <x-heroicon-s-x-circle class="h-5 w-5 text-red-400" /> --}}
                    <i class="fas fa-times h-5 w-5 text-red-400"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-red-800 transition-colors duration-200 dark:text-red-300">
                        {{ session('error') }}
                    </p>
                </div>
            </div>
        </div>
    @endif

    <form action="{{ route('central.settings.email.update') }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        <h2
            class="border-light-castleton-green block pb-4 border-b-2 text-xl font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
            Mail Settings
        </h2>
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <!-- Mail Driver -->
            <div>
                <label for="mail_mailer"
                    class="block text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                    Mail Driver
                </label>
                <select id="mail_mailer" name="mail_mailer" required
                    class="mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-3 py-2 text-[color:var(--color-dark-green)] shadow-sm transition-colors duration-200 focus:border-[color:var(--color-brunswick-green)] focus:outline-none focus:ring-1 focus:ring-[color:var(--color-brunswick-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)] dark:focus:border-[color:var(--color-light-brunswick-green)]">
                    <option value="smtp"
                        {{ old('mail_mailer', $emailSettings['mail_mailer'] ?? 'smtp') === 'smtp' ? 'selected' : '' }}>
                        SMTP</option>
                    <option value="sendmail"
                        {{ old('mail_mailer', $emailSettings['mail_mailer'] ?? '') === 'sendmail' ? 'selected' : '' }}>
                        Sendmail</option>
                    <option value="mailgun"
                        {{ old('mail_mailer', $emailSettings['mail_mailer'] ?? '') === 'mailgun' ? 'selected' : '' }}>
                        Mailgun</option>
                    <option value="ses"
                        {{ old('mail_mailer', $emailSettings['mail_mailer'] ?? '') === 'ses' ? 'selected' : '' }}>
                        Amazon SES</option>
                    <option value="postmark"
                        {{ old('mail_mailer', $emailSettings['mail_mailer'] ?? '') === 'postmark' ? 'selected' : '' }}>
                        Postmark</option>
                    <option value="log"
                        {{ old('mail_mailer', $emailSettings['mail_mailer'] ?? '') === 'log' ? 'selected' : '' }}>Log
                        (Testing)</option>
                </select>
                @error('mail_mailer')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Mail Encryption -->
            <div>
                <label for="mail_encryption"
                    class="block text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                    Encryption
                </label>
                <select id="mail_encryption" name="mail_encryption"
                    class="mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-3 py-2 text-[color:var(--color-dark-green)] shadow-sm transition-colors duration-200 focus:border-[color:var(--color-brunswick-green)] focus:outline-none focus:ring-1 focus:ring-[color:var(--color-brunswick-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)] dark:focus:border-[color:var(--color-light-brunswick-green)]">
                    <option value="">None</option>
                    <option value="tls"
                        {{ old('mail_encryption', $emailSettings['mail_encryption'] ?? 'tls') === 'tls' ? 'selected' : '' }}>
                        TLS</option>
                    <option value="ssl"
                        {{ old('mail_encryption', $emailSettings['mail_encryption'] ?? '') === 'ssl' ? 'selected' : '' }}>
                        SSL</option>
                </select>
                @error('mail_encryption')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div id="smtp-fields" class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <!-- SMTP Host -->
            <div>
                <label for="mail_host"
                    class="block text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                    SMTP Host
                </label>
                <input type="text" id="mail_host" name="mail_host"
                    value="{{ old('mail_host', $emailSettings['mail_host'] ?? '') }}"
                    class="mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-3 py-2 text-[color:var(--color-dark-green)] shadow-sm transition-colors duration-200 focus:border-[color:var(--color-brunswick-green)] focus:outline-none focus:ring-1 focus:ring-[color:var(--color-brunswick-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)] dark:focus:border-[color:var(--color-light-brunswick-green)]"
                    placeholder="mail.example.com">
                @error('mail_host')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- SMTP Port -->
            <div>
                <label for="mail_port"
                    class="block text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                    SMTP Port
                </label>
                <input type="number" id="mail_port" name="mail_port"
                    value="{{ old('mail_port', $emailSettings['mail_port'] ?? '587') }}" min="1" max="65535"
                    class="mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-3 py-2 text-[color:var(--color-dark-green)] shadow-sm transition-colors duration-200 focus:border-[color:var(--color-brunswick-green)] focus:outline-none focus:ring-1 focus:ring-[color:var(--color-brunswick-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)] dark:focus:border-[color:var(--color-light-brunswick-green)]"
                    placeholder="587">
                @error('mail_port')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <!-- SMTP Username -->
            <div>
                <label for="mail_username"
                    class="block text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                    SMTP Username
                </label>
                <input type="text" id="mail_username" name="mail_username"
                    value="{{ old('mail_username', $emailSettings['mail_username'] ?? '') }}"
                    class="mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-3 py-2 text-[color:var(--color-dark-green)] shadow-sm transition-colors duration-200 focus:border-[color:var(--color-brunswick-green)] focus:outline-none focus:ring-1 focus:ring-[color:var(--color-brunswick-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)] dark:focus:border-[color:var(--color-light-brunswick-green)]"
                    placeholder="your-email@example.com">
                @error('mail_username')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- SMTP Password -->
            <div>
                <label for="mail_password"
                    class="block text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                    SMTP Password
                </label>
                <input type="password" id="mail_password" name="mail_password"
                    class="mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-3 py-2 text-[color:var(--color-dark-green)] shadow-sm transition-colors duration-200 focus:border-[color:var(--color-brunswick-green)] focus:outline-none focus:ring-1 focus:ring-[color:var(--color-brunswick-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)] dark:focus:border-[color:var(--color-light-brunswick-green)]"
                    placeholder="Leave empty to keep current password">
                @error('mail_password')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
                <p
                    class="mt-1 text-xs text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                    Leave empty to keep the current password
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <!-- From Email Address -->
            <div>
                <label for="mail_from_address"
                    class="block text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                    From Email Address
                </label>
                <input type="email" id="mail_from_address" name="mail_from_address" required
                    value="{{ old('mail_from_address', $emailSettings['mail_from_address'] ?? '') }}"
                    class="mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-3 py-2 text-[color:var(--color-dark-green)] shadow-sm transition-colors duration-200 focus:border-[color:var(--color-brunswick-green)] focus:outline-none focus:ring-1 focus:ring-[color:var(--color-brunswick-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)] dark:focus:border-[color:var(--color-light-brunswick-green)]"
                    placeholder="noreply@example.com">
                @error('mail_from_address')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- From Name -->
            <div>
                <label for="mail_from_name"
                    class="block text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                    From Name
                </label>
                <input type="text" id="mail_from_name" name="mail_from_name" required
                    value="{{ old('mail_from_name', $emailSettings['mail_from_name'] ?? '') }}"
                    class="mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-3 py-2 text-[color:var(--color-dark-green)] shadow-sm transition-colors duration-200 focus:border-[color:var(--color-brunswick-green)] focus:outline-none focus:ring-1 focus:ring-[color:var(--color-brunswick-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)] dark:focus:border-[color:var(--color-light-brunswick-green)]"
                    placeholder="Schoolio">
                @error('mail_from_name')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit"
                class="inline-flex justify-center rounded-md border border-transparent bg-[color:var(--color-brunswick-green)] px-4 py-2 text-sm font-medium text-white shadow-sm transition-colors duration-200 hover:bg-[color:var(--color-dark-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-brunswick-green)] focus:ring-offset-2 dark:bg-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-brunswick-green)]">
                Update Email Configuration
            </button>
        </div>
    </form>

    <!-- Test Email Section -->
    <div
        class="mt-8 border-t border-[color:var(--color-light-brunswick-green)] pt-6 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)]">
        <h4
            class="text-lg font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
            Test Email Configuration
        </h4>
        <p
            class="mt-1 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
            Send a test email to verify your email configuration is working correctly.
        </p>

        <form action="{{ route('central.settings.email.test') }}" method="POST" class="mt-4">
            @csrf
            <div class="flex space-x-4">
                <div class="flex-1">
                    <label for="test_email" class="sr-only">Test email address</label>
                    <input type="email" id="test_email" name="test_email" required
                        placeholder="Enter email address to test"
                        class="block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-3 py-2 text-[color:var(--color-dark-green)] shadow-sm transition-colors duration-200 focus:border-[color:var(--color-brunswick-green)] focus:outline-none focus:ring-1 focus:ring-[color:var(--color-brunswick-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)] dark:focus:border-[color:var(--color-light-brunswick-green)]">
                    @error('test_email')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit"
                    class="inline-flex justify-center rounded-md border border-[color:var(--color-brunswick-green)] bg-transparent px-4 py-2 text-sm font-medium text-[color:var(--color-brunswick-green)] shadow-sm transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] hover:text-white focus:outline-none focus:ring-2 focus:ring-[color:var(--color-brunswick-green)] focus:ring-offset-2 dark:border-[color:var(--color-light-brunswick-green)] dark:text-[color:var(--color-light-brunswick-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)] dark:hover:text-[color:var(--color-dark-green)]">
                    Send Test Email
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mailDriverSelect = document.getElementById('mail_mailer');
        const smtpFields = document.getElementById('smtp-fields');
        const hostField = document.getElementById('mail_host');
        const portField = document.getElementById('mail_port');

        function toggleSmtpFields() {
            const isSmtp = mailDriverSelect.value === 'smtp';

            if (isSmtp) {
                smtpFields.style.display = 'grid';
                hostField.required = true;
                portField.required = true;
            } else {
                smtpFields.style.display = 'none';
                hostField.required = false;
                portField.required = false;
            }
        }

        mailDriverSelect.addEventListener('change', toggleSmtpFields);
        toggleSmtpFields(); // Initialize on page load
    });
</script>

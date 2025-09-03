<div class="space-y-6">
    @if (session('backup_success'))
        <div class="rounded-md bg-green-50 p-4 transition-colors duration-200 dark:bg-green-900/20">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-check h-5 w-5 text-green-400"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800 transition-colors duration-200 dark:text-green-300">
                        {{ session('backup_success') }}
                    </p>
                </div>
            </div>
        </div>
    @endif

    @if (session('backup_error'))
        <div class="rounded-md bg-red-50 p-4 transition-colors duration-200 dark:bg-red-900/20">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-times h-5 w-5 text-red-400"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-red-800 transition-colors duration-200 dark:text-red-300">
                        {{ session('backup_error') }}
                    </p>
                </div>
            </div>
        </div>
    @endif

    <form action="{{ route('central.settings.backup.update') }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        <h2
            class="border-light-castleton-green block border-b-2 pb-4 text-xl font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
            Backup & Maintenance Settings
        </h2>

        <!-- Backup Configuration -->
        <div class="space-y-6">
            <h3
                class="text-lg font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                Backup Configuration
            </h3>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <!-- Backup Enabled -->
                <div>
                    <label class="flex items-center">
                        <input type="checkbox" name="backup_enabled" value="1"
                            {{ old('backup_enabled', $backupSettings['backup_enabled'] ?? false) ? 'checked' : '' }}
                            class="rounded border-[color:var(--color-light-brunswick-green)] text-[color:var(--color-brunswick-green)] shadow-sm transition-colors duration-200 focus:border-[color:var(--color-brunswick-green)] focus:ring-[color:var(--color-brunswick-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                        <span
                            class="ml-2 text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                            Enable Automatic Backups
                        </span>
                    </label>
                    @error('backup_enabled')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Backup Frequency -->
                <div>
                    <label for="backup_frequency"
                        class="block text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                        Backup Frequency
                    </label>
                    <select id="backup_frequency" name="backup_frequency"
                        class="mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-3 py-2 text-[color:var(--color-dark-green)] shadow-sm transition-colors duration-200 focus:border-[color:var(--color-brunswick-green)] focus:outline-none focus:ring-1 focus:ring-[color:var(--color-brunswick-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)] dark:focus:border-[color:var(--color-light-brunswick-green)]">
                        <option value="daily"
                            {{ old('backup_frequency', $backupSettings['backup_frequency'] ?? 'daily') === 'daily' ? 'selected' : '' }}>
                            Daily</option>
                        <option value="weekly"
                            {{ old('backup_frequency', $backupSettings['backup_frequency'] ?? '') === 'weekly' ? 'selected' : '' }}>
                            Weekly</option>
                        <option value="monthly"
                            {{ old('backup_frequency', $backupSettings['backup_frequency'] ?? '') === 'monthly' ? 'selected' : '' }}>
                            Monthly</option>
                    </select>
                    @error('backup_frequency')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <!-- Backup Time -->
                <div>
                    <label for="backup_time"
                        class="block text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                        Backup Time
                    </label>
                    <input type="time" id="backup_time" name="backup_time"
                        value="{{ old('backup_time', $backupSettings['backup_time'] ?? '02:00') }}"
                        class="mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-3 py-2 text-[color:var(--color-dark-green)] shadow-sm transition-colors duration-200 focus:border-[color:var(--color-brunswick-green)] focus:outline-none focus:ring-1 focus:ring-[color:var(--color-brunswick-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)] dark:focus:border-[color:var(--color-light-brunswick-green)]">
                    @error('backup_time')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                    <p
                        class="mt-1 text-xs text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                        Recommended: Schedule during low-traffic hours (e.g., 2:00 AM)
                    </p>
                </div>

                <!-- Retention Days -->
                <div>
                    <label for="backup_retention_days"
                        class="block text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                        Retention Period (Days)
                    </label>
                    <input type="number" id="backup_retention_days" name="backup_retention_days"
                        value="{{ old('backup_retention_days', $backupSettings['backup_retention_days'] ?? '30') }}"
                        min="1" max="365"
                        class="mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-3 py-2 text-[color:var(--color-dark-green)] shadow-sm transition-colors duration-200 focus:border-[color:var(--color-brunswick-green)] focus:outline-none focus:ring-1 focus:ring-[color:var(--color-brunswick-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)] dark:focus:border-[color:var(--color-light-brunswick-green)]"
                        placeholder="30">
                    @error('backup_retention_days')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                    <p
                        class="mt-1 text-xs text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                        How long to keep backup files before automatic deletion
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6">
                <!-- Backup Storage Path -->
                <div>
                    <label for="backup_storage_path"
                        class="block text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                        Backup Storage Path
                    </label>
                    <input type="text" id="backup_storage_path" name="backup_storage_path"
                        value="{{ old('backup_storage_path', $backupSettings['backup_storage_path'] ?? 'storage/app/backups') }}"
                        class="mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-3 py-2 text-[color:var(--color-dark-green)] shadow-sm transition-colors duration-200 focus:border-[color:var(--color-brunswick-green)] focus:outline-none focus:ring-1 focus:ring-[color:var(--color-brunswick-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)] dark:focus:border-[color:var(--color-light-brunswick-green)]"
                        placeholder="storage/app/backups">
                    @error('backup_storage_path')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                    <p
                        class="mt-1 text-xs text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                        Local path where backup files will be stored
                    </p>
                </div>
            </div>
        </div>

        <!-- Maintenance Configuration -->
        <div
            class="space-y-6 border-t border-[color:var(--color-light-brunswick-green)] pt-6 dark:border-[color:var(--color-castleton-green)]">
            <h3
                class="text-lg font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                Maintenance Configuration
            </h3>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <!-- Maintenance Mode Enabled -->
                <div>
                    <label class="flex items-center">
                        <input type="checkbox" name="maintenance_enabled" value="1"
                            {{ old('maintenance_enabled', $backupSettings['maintenance_enabled'] ?? false) ? 'checked' : '' }}
                            class="rounded border-[color:var(--color-light-brunswick-green)] text-[color:var(--color-brunswick-green)] shadow-sm transition-colors duration-200 focus:border-[color:var(--color-brunswick-green)] focus:ring-[color:var(--color-brunswick-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                        <span
                            class="ml-2 text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                            Enable Scheduled Maintenance
                        </span>
                    </label>
                    @error('maintenance_enabled')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Maintenance Frequency -->
                <div>
                    <label for="maintenance_frequency"
                        class="block text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                        Maintenance Frequency
                    </label>
                    <select id="maintenance_frequency" name="maintenance_frequency"
                        class="mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-3 py-2 text-[color:var(--color-dark-green)] shadow-sm transition-colors duration-200 focus:border-[color:var(--color-brunswick-green)] focus:outline-none focus:ring-1 focus:ring-[color:var(--color-brunswick-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)] dark:focus:border-[color:var(--color-light-brunswick-green)]">
                        <option value="weekly"
                            {{ old('maintenance_frequency', $backupSettings['maintenance_frequency'] ?? 'weekly') === 'weekly' ? 'selected' : '' }}>
                            Weekly</option>
                        <option value="monthly"
                            {{ old('maintenance_frequency', $backupSettings['maintenance_frequency'] ?? '') === 'monthly' ? 'selected' : '' }}>
                            Monthly</option>
                        <option value="quarterly"
                            {{ old('maintenance_frequency', $backupSettings['maintenance_frequency'] ?? '') === 'quarterly' ? 'selected' : '' }}>
                            Quarterly</option>
                    </select>
                    @error('maintenance_frequency')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <!-- Maintenance Time -->
                <div>
                    <label for="maintenance_time"
                        class="block text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                        Maintenance Time
                    </label>
                    <input type="time" id="maintenance_time" name="maintenance_time"
                        value="{{ old('maintenance_time', $backupSettings['maintenance_time'] ?? '03:00') }}"
                        class="mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-3 py-2 text-[color:var(--color-dark-green)] shadow-sm transition-colors duration-200 focus:border-[color:var(--color-brunswick-green)] focus:outline-none focus:ring-1 focus:ring-[color:var(--color-brunswick-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)] dark:focus:border-[color:var(--color-light-brunswick-green)]">
                    @error('maintenance_time')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                    <p
                        class="mt-1 text-xs text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                        When to run scheduled maintenance tasks
                    </p>
                </div>

                <!-- Maintenance Duration -->
                <div>
                    <label for="maintenance_duration"
                        class="block text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                        Maintenance Duration (Hours)
                    </label>
                    <select id="maintenance_duration" name="maintenance_duration"
                        class="mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-3 py-2 text-[color:var(--color-dark-green)] shadow-sm transition-colors duration-200 focus:border-[color:var(--color-brunswick-green)] focus:outline-none focus:ring-1 focus:ring-[color:var(--color-brunswick-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)] dark:focus:border-[color:var(--color-light-brunswick-green)]">
                        <option value="1"
                            {{ old('maintenance_duration', $backupSettings['maintenance_duration'] ?? '2') === '1' ? 'selected' : '' }}>
                            1 Hour</option>
                        <option value="2"
                            {{ old('maintenance_duration', $backupSettings['maintenance_duration'] ?? '2') === '2' ? 'selected' : '' }}>
                            2 Hours</option>
                        <option value="4"
                            {{ old('maintenance_duration', $backupSettings['maintenance_duration'] ?? '') === '4' ? 'selected' : '' }}>
                            4 Hours</option>
                        <option value="6"
                            {{ old('maintenance_duration', $backupSettings['maintenance_duration'] ?? '') === '6' ? 'selected' : '' }}>
                            6 Hours</option>
                    </select>
                    @error('maintenance_duration')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6">
                <!-- Maintenance Message -->
                <div>
                    <label for="maintenance_message"
                        class="block text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                        Maintenance Message
                    </label>
                    <textarea id="maintenance_message" name="maintenance_message" rows="3"
                        class="mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-3 py-2 text-[color:var(--color-dark-green)] shadow-sm transition-colors duration-200 focus:border-[color:var(--color-brunswick-green)] focus:outline-none focus:ring-1 focus:ring-[color:var(--color-brunswick-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)] dark:focus:border-[color:var(--color-light-brunswick-green)]"
                        placeholder="We are currently performing scheduled maintenance. Please check back later.">{{ old('maintenance_message', $backupSettings['maintenance_message'] ?? 'We are currently performing scheduled maintenance. Please check back later.') }}</textarea>
                    @error('maintenance_message')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                    <p
                        class="mt-1 text-xs text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                        Message displayed to users during maintenance mode
                    </p>
                </div>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit"
                class="inline-flex justify-center rounded-md border border-transparent bg-[color:var(--color-brunswick-green)] px-4 py-2 text-sm font-medium text-white shadow-sm transition-colors duration-200 hover:bg-[color:var(--color-dark-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-brunswick-green)] focus:ring-offset-2 dark:bg-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-brunswick-green)]">
                Update Backup & Maintenance Settings
            </button>
        </div>
    </form>

    <!-- Manual Actions Section -->
    <div
        class="mt-8 border-t border-[color:var(--color-light-brunswick-green)] pt-6 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)]">
        <h4
            class="text-lg font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
            Manual Actions
        </h4>
        <p
            class="mt-1 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
            Perform immediate backup or maintenance tasks.
        </p>

        <div class="mt-4 flex flex-wrap gap-4">
            <form action="{{ route('central.settings.backup.create') }}" method="POST" class="inline">
                @csrf
                <button type="submit"
                    class="inline-flex justify-center rounded-md border border-[color:var(--color-brunswick-green)] bg-transparent px-4 py-2 text-sm font-medium text-[color:var(--color-brunswick-green)] shadow-sm transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] hover:text-white focus:outline-none focus:ring-2 focus:ring-[color:var(--color-brunswick-green)] focus:ring-offset-2 dark:border-[color:var(--color-light-brunswick-green)] dark:text-[color:var(--color-light-brunswick-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)] dark:hover:text-[color:var(--color-dark-green)]">
                    <i class="fas fa-database mr-2"></i>
                    Create Backup Now
                </button>
            </form>

            <form action="{{ route('central.settings.maintenance.toggle') }}" method="POST" class="inline">
                @csrf
                <button type="submit"
                    class="inline-flex justify-center rounded-md border border-[color:var(--color-brunswick-green)] bg-transparent px-4 py-2 text-sm font-medium text-[color:var(--color-brunswick-green)] shadow-sm transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] hover:text-white focus:outline-none focus:ring-2 focus:ring-[color:var(--color-brunswick-green)] focus:ring-offset-2 dark:border-[color:var(--color-light-brunswick-green)] dark:text-[color:var(--color-light-brunswick-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)] dark:hover:text-[color:var(--color-dark-green)]">
                    <i class="fas fa-tools mr-2"></i>
                    {{ app()->isDownForMaintenance() ? 'Disable' : 'Enable' }} Maintenance Mode
                </button>
            </form>

            <a href="{{ route('central.settings.backup.list') }}"
                class="inline-flex justify-center rounded-md border border-[color:var(--color-brunswick-green)] bg-transparent px-4 py-2 text-sm font-medium text-[color:var(--color-brunswick-green)] shadow-sm transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] hover:text-white focus:outline-none focus:ring-2 focus:ring-[color:var(--color-brunswick-green)] focus:ring-offset-2 dark:border-[color:var(--color-light-brunswick-green)] dark:text-[color:var(--color-light-brunswick-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)] dark:hover:text-[color:var(--color-dark-green)]">
                <i class="fas fa-list mr-2"></i>
                View Backup History
            </a>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const backupEnabled = document.querySelector('input[name="backup_enabled"]');
        const maintenanceEnabled = document.querySelector('input[name="maintenance_enabled"]');
        const backupFields = document.querySelectorAll(
            '#backup_frequency, #backup_time, #backup_retention_days, #backup_storage_path');
        const maintenanceFields = document.querySelectorAll(
            '#maintenance_frequency, #maintenance_time, #maintenance_duration, #maintenance_message');

        function toggleBackupFields() {
            const isEnabled = backupEnabled.checked;
            backupFields.forEach(field => {
                field.disabled = !isEnabled;
                field.closest('div').style.opacity = isEnabled ? '1' : '0.5';
            });
        }

        function toggleMaintenanceFields() {
            const isEnabled = maintenanceEnabled.checked;
            maintenanceFields.forEach(field => {
                field.disabled = !isEnabled;
                field.closest('div').style.opacity = isEnabled ? '1' : '0.5';
            });
        }

        backupEnabled.addEventListener('change', toggleBackupFields);
        maintenanceEnabled.addEventListener('change', toggleMaintenanceFields);

        // Initialize on page load
        toggleBackupFields();
        toggleMaintenanceFields();
    });
</script>

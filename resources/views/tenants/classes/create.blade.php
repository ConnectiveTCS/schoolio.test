<x-tenant-dash-component>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Classes
            </h2>
        </div>
    </x-slot>

    <div class="min-w-full p-6">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <div class="mx-auto max-w-3xl rounded-lg bg-white p-6 shadow-sm dark:bg-gray-800">
            <h3 class="mb-4 text-lg font-medium text-gray-900 dark:text-gray-100">Add New Class</h3>
            <form method="POST" action="{{ route('tenant.classes.store') }}">
                @csrf

                <!-- Basic Information -->
                <div class="mb-6">
                    <h4 class="text-md mb-3 font-medium text-gray-800 dark:text-gray-200">Basic Information</h4>

                    <div class="mb-4">
                        <x-input-label for="name" :value="__('Class Name')" />
                        <x-text-input id="name" class="mt-1 block w-full" type="text" name="name"
                            :value="old('name')" required autofocus maxlength="255" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="subject" :value="__('Subject')" />
                        <x-text-input id="subject" class="mt-1 block w-full" type="text" name="subject"
                            :value="old('subject')" maxlength="255" />
                        <x-input-error class="mt-2" :messages="$errors->get('subject')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="teacher_id" :value="__('Teacher')" />
                        <select id="teacher_id" name="teacher_id"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600">
                            <option value="">Select Teacher</option>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}"
                                    {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                    {{ $teacher->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('teacher_id')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="room" :value="__('Room')" />
                        <x-text-input id="room" class="mt-1 block w-full" type="text" name="room"
                            :value="old('room')" maxlength="50" />
                        <x-input-error class="mt-2" :messages="$errors->get('room')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="description" :value="__('Description')" />
                        <textarea id="description" name="description" rows="4"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600">{{ old('description') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>
                </div>

                <!-- Schedule Information -->
                <div class="mb-6">
                    <h4 class="text-md mb-3 font-medium text-gray-800 dark:text-gray-200">Schedule Information</h4>

                    <div class="mb-4">
                        <x-input-label for="schedule" :value="__('Schedule (JSON format - optional)')" />
                        <textarea id="schedule" name="schedule" rows="3"
                            placeholder='{"days": ["Monday", "Wednesday", "Friday"], "time": "09:00-10:30"}'
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600">{{ old('schedule') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('schedule')" />
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Enter schedule data in JSON format
                            (optional)</p>
                    </div>

                    <div class="mb-4">
                        <div class="flex items-center">
                            <input id="is_active" type="checkbox" name="is_active" value="1"
                                {{ old('is_active', true) ? 'checked' : '' }}
                                class="mr-2 h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                            <x-input-label for="is_active" :value="__('Active Class')" class="cursor-pointer" />
                        </div>
                        <x-input-error class="mt-2" :messages="$errors->get('is_active')" />
                    </div>
                </div>

                <div class="flex items-center justify-end space-x-4">
                    <a href="{{ route('tenant.classes') }}"
                        class="rounded-md border border-gray-300 bg-gray-200 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:border-gray-500 dark:bg-gray-600 dark:text-gray-200 dark:hover:bg-gray-500">
                        Cancel
                    </a>
                    <x-primary-button>Create Class</x-primary-button>
                </div>
            </form>
        </div>

    </div>
</x-tenant-dash-component>

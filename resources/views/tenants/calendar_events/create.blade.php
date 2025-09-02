<x-tenant-dash-component>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">{{ __('Create Event') }}</h2>
    </x-slot>
    <div class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">
        <div
            class="overflow-hidden rounded-lg bg-white shadow ring-1 ring-black ring-opacity-5 dark:bg-gray-800 dark:ring-gray-700">
            <div class="px-6 py-8">
                <form method="POST" action="{{ route('tenant.calendar-events.store') }}">
                    @csrf
                    <div class="mb-6">
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" type="text" name="title" class="mt-1 block w-full"
                            :value="old('title')" required />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>
                    <div class="mb-6">
                        <x-input-label for="description" :value="__('Description')" />
                        <textarea id="description" name="description" rows="4"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">{{ old('description') }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>
                    <div class="mb-6">
                        <x-input-label for="type" :value="__('Type')" />
                        <select id="type" name="type"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
                            @foreach (['event' => 'Event', 'exam' => 'Exam', 'holiday' => 'Holiday'] as $val => $label)
                                <option value="{{ $val }}" @selected(old('type') === $val)>{{ $label }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('type')" class="mt-2" />
                    </div>
                    <div class="mb-6 grid gap-6 md:grid-cols-2">
                        <div>
                            <x-input-label for="start_at" :value="__('Start')" />
                            <x-text-input id="start_at" type="datetime-local" name="start_at" class="mt-1 block w-full"
                                :value="old('start_at')" required />
                            <x-input-error :messages="$errors->get('start_at')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="end_at" :value="__('End (optional)')" />
                            <x-text-input id="end_at" type="datetime-local" name="end_at" class="mt-1 block w-full"
                                :value="old('end_at')" />
                            <x-input-error :messages="$errors->get('end_at')" class="mt-2" />
                        </div>
                    </div>
                    <div class="mb-6">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="all_day" value="1"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900"
                                {{ old('all_day', true) ? 'checked' : '' }}>
                            <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">All Day</span>
                        </label>
                        <x-input-error :messages="$errors->get('all_day')" class="mt-2" />
                    </div>
                    <div class="mb-6">
                        <x-input-label for="target_roles" :value="__('Target Roles (optional)')" />
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">If none selected, event is visible to
                            all roles.</p>
                        <div class="mt-3 space-y-2">
                            @foreach ($availableRoles as $roleKey => $roleLabel)
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="target_roles[]" value="{{ $roleKey }}"
                                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900"
                                        {{ in_array($roleKey, old('target_roles', [])) ? 'checked' : '' }}>
                                    <span
                                        class="ml-2 text-sm text-gray-700 dark:text-gray-300">{{ $roleLabel }}</span>
                                </label>
                            @endforeach
                        </div>
                        <x-input-error :messages="$errors->get('target_roles')" class="mt-2" />
                    </div>
                    <div class="mb-6">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="is_published" value="1"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900"
                                {{ old('is_published', true) ? 'checked' : '' }}>
                            <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Published (visible
                                immediately)</span>
                        </label>
                        <x-input-error :messages="$errors->get('is_published')" class="mt-2" />
                    </div>
                    <div class="flex items-center justify-end gap-4">
                        <a href="{{ route('tenant.calendar-events.index') }}"
                            class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 hover:bg-gray-50 dark:border-gray-500 dark:bg-gray-800 dark:text-gray-300">Cancel</a>
                        <x-primary-button>{{ __('Create Event') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-tenant-dash-component>

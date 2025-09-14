---
applyTo: '*blade.php'
---
Provide project context and coding guidelines that AI should follow when generating code, answering questions, or reviewing changes.

1. **Project Structure**: Understand the overall structure of the project, including key directories and files. This will help in navigating the codebase and making informed suggestions.

2. **Coding Standards**: Follow the established coding standards and best practices for the project. This includes naming conventions, file organization, and code formatting.

3. **Context Awareness**: Maintain awareness of the current context in which code is being written or modified. This includes understanding the purpose of the code, its dependencies, and its interactions with other parts of the system.

4. **Testing and Validation**: Emphasize the importance of testing and validation. Encourage the use of automated tests and other validation techniques to ensure code quality and correctness.

5. **Documentation**: Highlight the need for clear and concise documentation. This includes inline comments, function/method docstrings, and external documentation as needed.

6. **Collaboration**: Foster a collaborative environment by encouraging open communication and knowledge sharing among team members. This includes code reviews, pair programming, and other collaborative practices.

7. **Continuous Improvement**: Promote a culture of continuous improvement by encouraging experimentation, learning, and adaptation. This includes being open to feedback and making iterative changes to improve the codebase.

8. **Security and Privacy**: Ensure that security and privacy considerations are integrated into the development process. This includes following best practices for data handling, authentication, and authorization.

9. **Branding and Style**: Adhere to the project's branding and style guidelines, ensuring consistency in visual and functional elements across the application. Review other parts of the codebase to ensure alignment with these guidelines. 

# Schoolio Tenant View Styling Guidelines

This document provides comprehensive styling guidelines for Schoolio's tenant view files. All AI agents must follow these guidelines when modifying or creating tenant view files to ensure brand consistency and visual coherence across the application.

## Core Brand Colors & CSS Variables

### Light Mode Colors
- `--color-light-dark-green`: #e8f2f0 (Primary background)
- `--color-light-brunswick-green`: #d2e6e2 (Secondary background)
- `--color-light-castleton-green`: #cee8df (Card backgrounds)
- `--color-light-gunmetal`: #d8dfe5 (Muted text)
- `--color-light-prussian-blue`: #d4dce5 (Subtle accents)

### Dark Mode Colors
- `--color-dark-green`: #0d3a32 (Primary backgrounds)
- `--color-brunswick-green`: #224942 (Secondary backgrounds)
- `--color-castleton-green`: #245b47 (Card backgrounds)
- `--color-gunmetal`: #223546 (Muted text)
- `--color-prussian-blue`: #192a3c (Subtle accents)

## Mandatory CSS Variable Usage Pattern

**CRITICAL**: All colors MUST use CSS variables with the exact syntax pattern:
```blade
class="bg-[color:var(--color-variable-name)] text-[color:var(--color-variable-name)]"
```

### Common Color Combinations:

#### Backgrounds
- **Primary container**: `bg-[color:var(--color-light-dark-green)] dark:bg-[color:var(--color-dark-green)]`
- **Card backgrounds**: `bg-[color:var(--color-light-castleton-green)] dark:bg-[color:var(--color-castleton-green)]`
- **Secondary containers**: `bg-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]`
- **Table headers**: `bg-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-gunmetal)]`

#### Text Colors
- **Primary text**: `text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]`
- **Secondary text**: `text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]`

#### Borders
- **Primary borders**: `border-[color:var(--color-light-brunswick-green)] dark:border-[color:var(--color-castleton-green)]`
- **Secondary borders**: `border-[color:var(--color-brunswick-green)] dark:border-[color:var(--color-light-brunswick-green)]`

## Styling Patterns & Components

### 1. Page Headers
**Pattern**: Always use this structure for page headers:
```blade
<x-slot name="header">
    <div class="flex items-center justify-between">
        <h2 class="flex items-center text-xl font-semibold leading-tight text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
            <i class="fas fa-[icon-name] mr-3 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
            {{ __('Page Title') }}
        </h2>
    </div>
</x-slot>
```

### 2. Container Structure
**Pattern**: Main containers should use:
```blade
<div class="mx-auto max-w-7xl px-4 py-8 transition-colors duration-200 sm:px-6 lg:px-8">
```

### 3. Cards & Content Blocks
**Pattern**: Standard card styling:
```blade
<div class="overflow-hidden rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] shadow-lg transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
```

### 4. Buttons & Interactive Elements
**Primary Button Pattern**:
```blade
<a href="#" class="shadow-xs inline-flex items-center gap-2 rounded-lg bg-[color:var(--color-castleton-green)] px-4 py-2.5 text-sm font-semibold text-white transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:bg-[color:var(--color-light-castleton-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)] dark:focus:ring-offset-[color:var(--color-dark-green)]">
    <i class="fas fa-plus h-4 w-4"></i>
    {{ __('Button Text') }}
</a>
```

**Back/Navigation Link Pattern**:
```blade
<a href="#" class="inline-flex items-center font-medium text-[color:var(--color-castleton-green)] transition-colors duration-200 hover:text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-dark-green)]">
    <i class="fas fa-arrow-left mr-2"></i>
    Back to List
</a>
```

### 5. Tables
**Table Container Pattern**:
```blade
<div class="overflow-hidden rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] shadow-sm transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
    <table class="min-w-full divide-y divide-[color:var(--color-light-brunswick-green)] dark:divide-[color:var(--color-castleton-green)]">
```

**Table Header Pattern**:
```blade
<thead class="bg-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-gunmetal)]">
    <tr>
        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
            <i class="fas fa-user mr-2"></i>Name
        </th>
```

### 6. Success/Alert Messages
**Success Message Pattern**:
```blade
@if (session('success'))
    <div class="mb-6 rounded-lg border border-[color:var(--color-castleton-green)] bg-[color:var(--color-light-castleton-green)] p-4 text-[color:var(--color-dark-green)] transition-colors duration-200 dark:border-[color:var(--color-light-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)]">
        <div class="flex items-center">
            <i class="fas fa-check-circle mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
            {{ session('success') }}
        </div>
    </div>
@endif
```

### 7. Form Elements
**Input Label Pattern**:
```blade
<x-input-label for="name" class="flex items-center text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
    <i class="fas fa-user mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
    {{ __('Field Name') }}
</x-input-label>
```

**Text Input Pattern**:
```blade
<x-text-input class="mt-1 block w-full" type="text" name="field_name" :value="old('field_name')" />
```

**IMPORTANT**: Input fields should use the default `class="mt-1 block w-full"` styling and let the component handle brand-specific styling internally. DO NOT override with custom color classes unless specifically required.

## Form Design Guidelines

### Complete Form Structure
All forms MUST follow this exact structure for consistency across the application:

#### 1. Form Container Structure
```blade
<div
    class="min-h-screen min-w-full bg-[color:var(--color-light-dark-green)] px-4 py-8 transition-colors duration-200 sm:px-6 lg:px-8 dark:bg-[color:var(--color-dark-green)]">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Success/Error Messages -->
    @if (session('success'))
        <div
            class="mb-6 rounded-lg border border-[color:var(--color-castleton-green)] bg-[color:var(--color-light-castleton-green)] p-4 text-[color:var(--color-dark-green)] transition-colors duration-200 dark:border-[color:var(--color-light-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)]">
            <div class="flex items-center">
                <i
                    class="fas fa-check-circle mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                {{ session('success') }}
            </div>
        </div>
    @endif

    <div
        class="mx-auto max-w-3xl rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-6 shadow-lg transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
        
        <!-- Form Title -->
        <h3
            class="mb-4 flex items-center text-lg font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
            <i
                class="fas fa-[icon-name] mr-2 text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-brunswick-green)]"></i>
            {{ __('Form Title') }}
        </h3>
        
        <!-- Form Content -->
        <form method="POST" action="{{ route('action.route') }}" aria-label="Form description">
            @csrf
            <!-- Form sections go here -->
        </form>
    </div>
</div>
```

#### 2. Form Section Structure
Each form section MUST be wrapped in this container:

```blade
<div
    class="mb-6 rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-6 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]">
    <h4
        class="text-md mb-4 flex items-center font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
        <i
            class="fas fa-[section-icon] mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
        Section Title
    </h4>

    <!-- Form fields go here -->
</div>
```

#### 3. Form Field Structure
Every form field MUST follow this exact pattern:

```blade
<div class="mb-4">
    <x-input-label for="field_name"
        class="flex items-center text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
        <i
            class="fas fa-[field-icon] mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
        {{ __('Field Label') }}
    </x-input-label>
    <x-text-input id="field_name" class="mt-1 block w-full" type="text" name="field_name"
        :value="old('field_name', $model->field_name ?? '')" maxlength="255" />
    <x-input-error class="mt-2" :messages="$errors->get('field_name')" />
</div>
```

#### 4. Checkbox Pattern
For checkboxes, use this structure:

```blade
<div class="mb-4">
    <div class="flex items-center">
        <input id="checkbox_name" type="checkbox" name="checkbox_name" value="1"
            {{ old('checkbox_name', $model->checkbox_name ?? false) ? 'checked' : '' }}
            class="mr-2 h-4 w-4 rounded-sm border-[color:var(--color-light-brunswick-green)] text-[color:var(--color-castleton-green)] transition-colors duration-200 focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
        <x-input-label for="checkbox_name"
            class="flex cursor-pointer items-center text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
            <i
                class="fas fa-[checkbox-icon] mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
            {{ __('Checkbox Label') }}
        </x-input-label>
    </div>
    <x-input-error class="mt-2" :messages="$errors->get('checkbox_name')" />
</div>
```

#### 5. Select Dropdown Pattern
For select dropdowns, use this structure:

```blade
<div class="mb-4">
    <x-input-label for="select_name"
        class="flex items-center text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
        <i
            class="fas fa-[select-icon] mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
        {{ __('Select Label') }}
    </x-input-label>
    <select id="select_name" name="select_name"
        class="mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] text-[color:var(--color-dark-green)] shadow-sm transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-dark-green)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
        <option value="">Select Option</option>
        <option value="value1" {{ old('select_name', $model->select_name ?? '') == 'value1' ? 'selected' : '' }}>Option 1</option>
        <option value="value2" {{ old('select_name', $model->select_name ?? '') == 'value2' ? 'selected' : '' }}>Option 2</option>
    </select>
    <x-input-error class="mt-2" :messages="$errors->get('select_name')" />
</div>
```

#### 6. Nested Form Sections (Sub-sections)
For nested sections within a form (like Parent 1, Parent 2), use this pattern:

```blade
<!-- Parent Section -->
<div
    class="mb-6 rounded-lg border border-[color:var(--color-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-gunmetal)]">
    <h5
        class="mb-3 flex items-center text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
        <i
            class="fas fa-[subsection-icon] mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
        Subsection Title
    </h5>

    <!-- Subsection fields go here -->
</div>
```

#### 7. Form Actions (Footer)
Every form MUST end with this action structure:

```blade
<div
    class="flex items-center justify-end space-x-4 border-t border-[color:var(--color-light-brunswick-green)] pt-6 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)]">
    <a href="{{ route('back.route') }}"
        class="inline-flex items-center rounded-md border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-4 py-2 text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:bg-[color:var(--color-prussian-blue)]">
        <i class="fas fa-times mr-2"></i>
        Cancel
    </a>
    <button type="submit"
        class="shadow-xs inline-flex items-center gap-2 rounded-lg bg-[color:var(--color-castleton-green)] px-4 py-2.5 text-sm font-semibold text-white transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:bg-[color:var(--color-light-castleton-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)] dark:focus:ring-offset-[color:var(--color-dark-green)]">
        <i class="fas fa-save h-4 w-4"></i>
        {{ __('Submit Text') }}
    </button>
</div>
```

#### 8. Form Enhancement Script
All forms with multiple sections SHOULD include this JavaScript for animations:

```blade
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-populate related fields if needed
        // ... specific form logic here ...

        // Add smooth fade-in animation to form sections
        const formSections = document.querySelectorAll('.rounded-lg.border');
        formSections.forEach((section, index) => {
            section.style.opacity = '0';
            section.style.transform = 'translateY(10px)';
            section.style.transition = 'all 0.3s ease';

            setTimeout(() => {
                section.style.opacity = '1';
                section.style.transform = 'translateY(0)';
            }, index * 100);
        });
    });
</script>
```

### Form Section Icon Guidelines

Use appropriate icons for each form section:
- **Personal Information**: `fas fa-user`
- **Contact Information**: `fas fa-envelope` or `fas fa-phone`
- **Academic Information**: `fas fa-graduation-cap`
- **Parent/Guardian Information**: `fas fa-users`
- **Address Information**: `fas fa-map-marker-alt`
- **Settings/Preferences**: `fas fa-cog`
- **Security**: `fas fa-shield-alt`

### Form Field Icon Guidelines

Use appropriate icons for each field type:
- **Name fields**: `fas fa-user`
- **Email fields**: `fas fa-envelope`
- **Phone fields**: `fas fa-phone`
- **Address fields**: `fas fa-map-marker-alt`
- **Date fields**: `fas fa-calendar-alt`
- **Gender selection**: `fas fa-venus-mars`
- **Active/Status checkboxes**: `fas fa-check-circle`
- **Password fields**: `fas fa-lock`

### Form Validation & Error Handling

1. **Always include**: `<x-input-error class="mt-2" :messages="$errors->get('field_name')" />`
2. **Use old() helper**: Always populate fields with `old('field_name', $model->field_name ?? '')`
3. **Include required attributes**: Add `required` attribute where applicable
4. **Set maxlength**: Always set appropriate `maxlength` attributes

### Form Accessibility Requirements

1. **Form labels**: Always use `aria-label` attribute on forms
2. **Field associations**: Ensure all labels are properly associated with inputs
3. **Tab order**: Maintain logical tab order through form fields
4. **Error announcements**: Error messages should be announced to screen readers
5. **Required field indicators**: Clearly mark required fields

## Index Pages with Tables Guidelines

All index pages with tables MUST follow this consistent structure and styling pattern to ensure uniformity across the application.

### 1. Index Page Container Structure
Every index page MUST use this exact container structure:

```blade
<x-tenant-dash-component>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2
                class="flex items-center text-xl font-semibold leading-tight text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                <i
                    class="fas fa-[icon-name] mr-3 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                {{ __('Page Title') }}
            </h2>
        </div>
    </x-slot>

    <div class="mx-auto max-w-7xl px-4 py-8 transition-colors duration-200 sm:px-6 lg:px-8">
        <!-- Content goes here -->
    </div>
</x-tenant-dash-component>
```

### 2. Success Message Pattern
ALWAYS include this success message pattern after session status:

```blade
<!-- Session Status -->
<x-auth-session-status class="mb-6" :status="session('status')" />

<!-- Success Message -->
@if (session('success'))
    <div
        class="mb-6 rounded-lg border border-[color:var(--color-castleton-green)] bg-[color:var(--color-light-castleton-green)] p-4 text-[color:var(--color-dark-green)] transition-colors duration-200 dark:border-[color:var(--color-light-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)]">
        <div class="flex items-center">
            <i
                class="fas fa-check-circle mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
            {{ session('success') }}
        </div>
    </div>
@endif
```

### 3. Header Actions Section
Use this structure for the header actions section:

```blade
<!-- Header Actions -->
<div class="mb-8 flex items-center justify-between">
    <div>
        <h3
            class="text-lg font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
            Page Subtitle</h3>
        <p class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
            Record count or description
        </p>
    </div>
    <!-- Action buttons go here -->
</div>
```

### 4. Add Button Pattern
All "Add" buttons MUST follow this exact pattern:

```blade
<a href="{{ route('route.create') }}"
    class="shadow-xs focus-visible:outline-solid focus:outline-hidden inline-flex items-center gap-2 rounded-lg bg-[color:var(--color-castleton-green)] px-4 py-2.5 text-sm font-semibold text-white transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-light-castleton-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)] dark:focus:ring-offset-[color:var(--color-dark-green)]">
    <i class="fas fa-plus h-4 w-4"></i>
    {{ __('Add Item') }}
</a>
```

### 5. Table Container Pattern
ALL tables MUST use this exact container structure:

```blade
<!-- Table Container -->
<div
    class="overflow-hidden rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] shadow-sm transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
    <table
        class="min-w-full divide-y divide-[color:var(--color-light-brunswick-green)] dark:divide-[color:var(--color-castleton-green)]">
        <!-- Table content -->
    </table>
</div>
```

### 6. Table Header Pattern
Table headers MUST follow this structure:

```blade
<thead class="bg-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-gunmetal)]">
    <tr>
        <th
            class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
            <i class="fas fa-[icon] mr-2"></i>Column Name
        </th>
        <!-- More columns -->
        <th class="relative px-6 py-4">
            <span class="sr-only">Actions</span>
        </th>
    </tr>
</thead>
```

### 7. Table Body Pattern
Table bodies MUST use this structure:

```blade
<tbody
    class="divide-y divide-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] transition-colors duration-200 dark:divide-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
    @if (isset($items) && $items->count() > 0)
        @foreach ($items as $item)
            <tr
                class="transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] dark:hover:bg-[color:var(--color-gunmetal)]">
                <td class="whitespace-nowrap px-6 py-4">
                    <div
                        class="text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                        {{ $item->name }}
                    </div>
                </td>
                <!-- More columns -->
            </tr>
        @endforeach
    @else
        <!-- Empty state -->
    @endif
</tbody>
```

### 8. Table Row Data Cells
Individual data cells should use:

```blade
<td class="whitespace-nowrap px-6 py-4">
    <div class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
        {{ $item->field }}
    </div>
</td>
```

### 9. Empty State Pattern
ALL empty states MUST follow this consistent structure:

```blade
<tr>
    <td colspan="[column-count]" class="px-6 py-12 text-center">
        <div class="flex flex-col items-center justify-center space-y-4">
            <div
                class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-[color:var(--color-light-brunswick-green)] transition-colors duration-200 dark:bg-[color:var(--color-gunmetal)]">
                <i
                    class="fas fa-[icon] text-2xl text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]"></i>
            </div>
            <div class="text-center">
                <h3
                    class="text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                    No items found
                </h3>
                <p
                    class="mt-1 text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                    Get started by adding your first item.
                </p>
                <div class="mt-6">
                    <a href="{{ route('route.create') }}"
                        class="shadow-xs focus-visible:outline-solid inline-flex items-center rounded-md bg-[color:var(--color-castleton-green)] px-4 py-2 text-sm font-semibold text-white transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-light-castleton-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)]">
                        <i class="fas fa-plus mr-2"></i>Add Item
                    </a>
                </div>
            </div>
        </div>
    </td>
</tr>
```

### 10. Action Buttons in Tables
Action buttons should follow these patterns:

#### View/Edit Actions:
```blade
<td class="whitespace-nowrap px-6 py-4 text-right text-sm">
    <div class="flex items-center justify-end space-x-2">
        <a href="{{ route('route.edit', $item) }}"
            class="rounded-md p-2 text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] hover:text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:bg-[color:var(--color-gunmetal)] dark:hover:text-[color:var(--color-light-dark-green)]"
            title="Edit item">
            <i class="fas fa-edit h-4 w-4"></i>
        </a>
        <a href="{{ route('route.show', $item) }}"
            class="rounded-md p-2 text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] hover:text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:bg-[color:var(--color-gunmetal)] dark:hover:text-[color:var(--color-light-dark-green)]"
            title="View item">
            <i class="fas fa-eye h-4 w-4"></i>
        </a>
    </div>
</td>
```

#### Delete Action:
```blade
<form action="{{ route('route.destroy', $item) }}" method="POST" class="inline">
    @csrf
    @method('DELETE')
    <button type="submit"
        class="rounded-md p-2 text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:bg-red-50 hover:text-red-600 dark:text-[color:var(--color-light-gunmetal)] dark:hover:bg-red-900/20 dark:hover:text-red-400"
        title="Delete item"
        onclick="return confirm('Are you sure you want to delete this item?')">
        <i class="fas fa-trash h-4 w-4"></i>
    </button>
</form>
```

#### Additional Custom Actions:
For any additional custom actions (like password reset, status toggle, etc.), follow this pattern:

```blade
<!-- Custom Action Button (Link) -->
<a href="{{ route('custom.action', $item) }}"
    class="rounded-md p-2 text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] hover:text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:bg-[color:var(--color-gunmetal)] dark:hover:text-[color:var(--color-light-dark-green)]"
    title="Custom action description">
    <i class="fas fa-[custom-icon] h-4 w-4"></i>
</a>

<!-- Custom Action Button (Form) -->
<form action="{{ route('custom.action', $item) }}" method="POST" class="inline">
    @csrf
    <button type="submit"
        onclick="return confirm('Are you sure you want to perform this action?')"
        class="rounded-md p-2 text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] hover:text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:bg-[color:var(--color-gunmetal)] dark:hover:text-[color:var(--color-light-dark-green)]"
        title="Custom action description">
        <i class="fas fa-[custom-icon] h-4 w-4"></i>
    </button>
</form>
```

#### Action Button Guidelines:
1. **Consistent styling**: All action buttons MUST use the same base styling pattern
2. **Icon-only design**: Use only icons (no text) to maintain clean table appearance
3. **Proper tooltips**: Always include meaningful `title` attributes for accessibility
4. **Icon sizing**: Use `h-4 w-4` for all action icons
5. **Spacing**: Use `space-x-2` between action buttons
6. **Hover effects**: Use consistent hover background and text color changes
7. **Confirmations**: Include confirmation dialogs for destructive actions
8. **Permissions**: Wrap actions in appropriate permission checks or role-based conditions

#### Common Action Icons:
- **View**: `fas fa-eye`
- **Edit**: `fas fa-edit`
- **Delete**: `fas fa-trash`
- **Reset Password**: `fas fa-key`
- **Toggle Status**: `fas fa-toggle-on` / `fas fa-toggle-off`
- **Download**: `fas fa-download`
- **Print**: `fas fa-print`
- **Share**: `fas fa-share`
- **Copy**: `fas fa-copy`
- **Settings**: `fas fa-cog`

### 11. Search Functionality (Optional)
If search is needed, use this pattern:

```blade
<!-- Search Box -->
<div class="relative">
    <form method="GET" action="{{ route('route.index') }}" class="flex items-center">
        <div class="relative">
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Search items..."
                class="block w-64 rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] px-3 py-2 pl-10 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
            <i
                class="fas fa-search absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]"></i>
        </div>
        @if (request('search'))
            <a href="{{ route('route.index') }}"
                class="ml-2 inline-flex items-center rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] px-3 py-2 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:bg-[color:var(--color-brunswick-green)]">
                <i class="fas fa-times mr-1"></i>Clear
            </a>
        @endif
    </form>
</div>
```

### 12. Pagination (Optional)
If pagination is needed, use this pattern:

```blade
<!-- Pagination -->
@if (isset($items) && method_exists($items, 'hasPages') && $items->hasPages())
    <div class="mt-6 flex items-center justify-center gap-4">
        <div class="pagination-wrapper">
            {{ $items->appends(request()->query())->links() }}
        </div>
    </div>
@endif
```

### Index Page Icon Guidelines
- **Users/People**: `fas fa-user`, `fas fa-user-graduate`, `fas fa-chalkboard-teacher`
- **Admin pages**: `fas fa-crown`, `fas fa-user-shield`
- **Content pages**: `fas fa-chalkboard`, `fas fa-bullhorn`, `fas fa-book`
- **Settings pages**: `fas fa-cog`, `fas fa-tools`

### Index Page Quality Checklist

Before submitting any index page, ensure:

1. ✅ Container structure follows the exact pattern
2. ✅ Success messages are consistently implemented
3. ✅ Header actions section is properly structured
4. ✅ Table container uses exact styling
5. ✅ Table headers follow the icon + text pattern
6. ✅ Table rows have proper hover effects
7. ✅ Empty state follows the consistent pattern
8. ✅ Action buttons use correct styling and tooltips
9. ✅ Search functionality (if present) follows the pattern
10. ✅ All colors use CSS variables
11. ✅ Dark mode variants are provided
12. ✅ Transition classes are applied consistently

**CRITICAL**: All index pages MUST be visually and functionally consistent. Any deviation from these patterns must be explicitly approved before implementation.

## Icon Usage Guidelines

### FontAwesome Icon Pattern
All icons MUST follow this pattern:
```blade
<i class="fas fa-[icon-name] mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
```

### Common Icon Mappings
- **Users**: `fas fa-user`, `fas fa-user-graduate` (students), `fas fa-chalkboard-teacher` (teachers)
- **Admin**: `fas fa-crown` (tenant admin), `fas fa-user-shield` (system admin)
- **Content**: `fas fa-chalkboard` (classes), `fas fa-bullhorn` (announcements)
- **Actions**: `fas fa-plus` (create), `fas fa-edit` (edit), `fas fa-trash` (delete)
- **Navigation**: `fas fa-arrow-left` (back), `fas fa-home` (home)
- **Info**: `fas fa-info-circle` (information), `fas fa-check-circle` (success)

## Animation & Transition Guidelines

### Mandatory Transition Classes
All color-changing elements MUST include:
```blade
class="transition-colors duration-200"
```

### Hover Effects Pattern
```blade
class="hover:bg-[color:var(--color-light-castleton-green)] dark:hover:bg-[color:var(--color-castleton-green)]"
```

## Layout & Spacing Guidelines

### Container Sizing
- **Full width containers**: `max-w-7xl`
- **Form containers**: `max-w-3xl`
- **Detail views**: `max-w-4xl`

### Standard Padding/Margins
- **Page padding**: `px-4 py-8 sm:px-6 lg:px-8`
- **Card padding**: `p-6`
- **Button padding**: `px-4 py-2.5`

### Grid Systems
- **Stats cards**: `grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4`
- **Content cards**: `grid gap-8 md:grid-cols-2 lg:grid-cols-3`

## Theme Support Requirements

### Dark Mode Implementation
EVERY element that uses colors MUST provide both light and dark mode variants using the pattern:
```blade
class="bg-[color:var(--light-variant)] dark:bg-[color:var(--dark-variant)]"
```

### Theme Toggle Pattern
When implementing theme toggles, use:
```blade
<!-- Theme Toggle Button -->
<button onclick="toggleTheme()" class="focus:outline-hidden rounded-lg p-2 text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] hover:text-[color:var(--color-dark-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:text-[color:var(--color-light-gunmetal)] dark:hover:bg-[color:var(--color-brunswick-green)] dark:hover:text-[color:var(--color-light-dark-green)] dark:focus:ring-offset-[color:var(--color-dark-green)]" title="Toggle theme">
    <i class="fas fa-sun hidden h-6 w-6 dark:block"></i>
    <i class="fas fa-moon block h-6 w-6 dark:hidden"></i>
</button>
```

## Accessibility Guidelines

### Focus States
All interactive elements MUST include proper focus states:
```blade
class="focus:outline-none focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2"
```

### Screen Reader Support
- Use semantic HTML elements
- Include proper ARIA labels
- Ensure sufficient color contrast
- Use descriptive link text

## Component Composition Guidelines

### Dashboard Statistics Cards
Use this exact pattern for dashboard stats:
```blade
<div class="shadow-xs overflow-hidden border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] transition-colors duration-200 sm:rounded-lg dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
    <div class="p-6">
        <div class="flex items-center">
            <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-[color:var(--color-castleton-green)] transition-colors duration-200 dark:bg-[color:var(--color-brunswick-green)]">
                <i class="fas fa-[icon] h-6 w-6 text-[color:var(--color-light-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">Label</p>
                <p class="text-2xl font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">Value</p>
            </div>
        </div>
    </div>
</div>
```

## Quality Assurance Checklist

Before submitting any tenant view file changes, ensure:

1. ✅ All colors use CSS variables with `color:var(--color-variable)` syntax
2. ✅ Both light and dark mode variants are provided for all colored elements
3. ✅ Transition classes are applied (`transition-colors duration-200`)
4. ✅ FontAwesome icons follow the established pattern
5. ✅ Container sizing follows the guidelines
6. ✅ Focus states are properly implemented
7. ✅ Hover effects use consistent patterns
8. ✅ Button styling matches the established patterns
9. ✅ Table structures follow the defined patterns
10. ✅ Form elements use the correct styling patterns

## Implementation Priority

When making any changes to tenant view files, follow this priority order:

1. **First**: Ensure all styling follows brand guidelines
2. **Second**: Verify dark mode compatibility
3. **Third**: Check accessibility compliance
4. **Fourth**: Implement requested functionality
5. **Fifth**: Test responsiveness across different screen sizes

**Remember**: Style consistency is paramount. Any deviation from these guidelines must be explicitly justified and approved before implementation.


10. **Performance Optimization**: Be mindful of performance implications when writing or modifying code. Strive for efficient algorithms and data structures, and consider the impact on system resources.

11. **Error Handling**: Implement robust error handling to gracefully manage unexpected situations. This includes logging errors, providing meaningful error messages, and ensuring the system remains stable.

12. **Areas of Improvement**: Identify and suggest areas for improvement in the codebase. This could include refactoring opportunities, performance enhancements, or better adherence to design patterns. Ask me for approval before proceeding with implementation.

13. **Suggestions for New Features**: When proposing new features, provide a clear rationale, outline the benefits, and consider potential challenges or trade-offs. Ask me for approval before proceeding with implementation.

14. **Controller Optimization**: Ensure that controllers are lean and focused on handling requests and responses. Business logic should be moved to service classes or models to maintain separation of concerns. When I ask "optimize controllers", follow this guideline.

**Controller Optimization Guidelines**:
- Keep controllers thin by offloading business logic to services.
- Use form requests for validation logic.
- Return appropriate response types (e.g., JSON, redirects).
- Avoid using controllers for complex data manipulation.
- Ensure controllers are easy to read and maintain.
- Follow RESTful conventions for resource controllers.
**API Controller Optimization Guidelines**:
- Use resource controllers for standard CRUD operations.
- Implement proper authentication and authorization.
- Return consistent and meaningful HTTP status codes.

15. **Organization of Route Code**: Maintain a well-organized route structure. Group related routes together, use route namespacing, and apply middleware appropriately to ensure clarity and maintainability. Ensure appropriate redirect error handling is in place, by looking at the RedirectController for examples. When I ask "organize route code", follow this guideline.
**Route Organization Guidelines**:
- Group related routes together (e.g., all user-related routes in a `UserController`).
- Use route namespacing to organize routes logically (e.g., `Admin\UsersController` for admin-related user routes).
- Apply middleware to routes as needed for authentication, authorization, and other concerns.
- Keep route definitions clean and concise, using route groups and prefixes where appropriate.
- Document complex route logic or dependencies within the route files.

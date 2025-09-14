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
<x-text-input class="mt-1 block w-full border-[color:var(--color-brunswick-green)] bg-white text-[color:var(--color-gunmetal)] transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]" />
```

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

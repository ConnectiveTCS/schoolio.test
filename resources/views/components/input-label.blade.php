@props(['value'])

<label
    {{ $attributes->merge(['class' => 'block font-medium text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]']) }}>
    {{ $value ?? $slot }}
</label>

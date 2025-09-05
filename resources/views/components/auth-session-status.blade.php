@props(['status'])

@if ($status)
    <div
        {{ $attributes->merge(['class' => 'font-medium text-sm text-[color:var(--color-castleton-green)] transition-colors duration-200 dark:text-[color:var(--color-light-castleton-green)]']) }}>
        {{ $status }}
    </div>
@endif

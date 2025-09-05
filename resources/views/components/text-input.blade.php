@props(['disabled' => false])

<input @disabled($disabled)
    {{ $attributes->merge(['class' => 'border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] text-[color:var(--color-dark-green)] placeholder-[color:var(--color-gunmetal)] transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-dark-green)] dark:placeholder-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)] rounded-md shadow-xs']) }}>

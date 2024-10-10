@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center hover:bg-black-500 px-1 pt-1 border-b-2 border-indigo-400 dark:border-indigo-600 text-xl font-medium leading-5 text-gray-900'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-3xl font-medium leading-5 text-white ';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

@props(['active' => false])

@php
    $classes = 'block text-left px-3 text-sm leading-6 hover:text-white hover:bg-blue-500 focus:text-white focus:bg-gray-100 whitespace-nowrap overflow-hidden max-w-xs';

    if ($active) {
        $classes .= ' bg-blue-500 text-white';
    }

@endphp

<a {{ $attributes(['class' => $classes]) }}>{{ $slot }}</a>

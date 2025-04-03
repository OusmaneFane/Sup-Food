@props(['label', 'route', 'params' => [], 'active' => false])

@php
    $classes = $active ? 'bg-blue-50 border-blue-200 text-blue-600' : 'border-gray-200 text-gray-600';
@endphp

<a href="{{ route($route, $params) }}"
    class="flex items-center px-4 py-2 rounded-full bg-white shadow-xs border hover:shadow-sm transition-all duration-200 {{ $classes }}">
    {{ $label }}
</a>

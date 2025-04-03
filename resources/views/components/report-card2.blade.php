@props(['icon', 'label', 'value', 'color' => 'blue', 'trend' => 'up'])

@php
    $colors = [
        'blue' => 'bg-blue-100 text-blue-600',
        'green' => 'bg-green-100 text-green-600',
        'purple' => 'bg-purple-100 text-purple-600',
        'red' => 'bg-red-100 text-red-600',
        'yellow' => 'bg-yellow-100 text-yellow-600',
    ];
@endphp

<div class="bg-white rounded-xl shadow-sm p-4 flex items-center justify-between">
    <div class="flex items-center gap-4">
        <div class="p-3 rounded-full {{ $colors[$color] ?? 'bg-gray-100 text-gray-600' }}">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path d="{{ $icon }}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
            </svg>
        </div>
        <div>
            <p class="text-sm text-gray-500">{{ $label }}</p>
            <p class="text-lg font-bold text-gray-800">{{ $value }}</p>
        </div>
    </div>
    @if ($trend === 'up')
        <svg class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7 7 7M5 20h14" />
        </svg>
    @elseif ($trend === 'down')
        <svg class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7-7-7M5 4h14" />
        </svg>
    @endif
</div>

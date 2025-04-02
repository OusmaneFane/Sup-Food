@props(['icon', 'label', 'value', 'color' => 'blue', 'trend' => 'up'])

@php
    $colors = [
        'blue' => [
            'bg' => 'bg-blue-50',
            'text' => 'text-blue-600',
            'icon' => 'text-blue-500',
        ],
        'green' => [
            'bg' => 'bg-green-50',
            'text' => 'text-green-600',
            'icon' => 'text-green-500',
        ],
        'purple' => [
            'bg' => 'bg-purple-50',
            'text' => 'text-purple-600',
            'icon' => 'text-purple-500',
        ],
    ];

    $trendIcons = [
        'up' => [
            'icon' => 'M5 10l7-7m0 0l7 7m-7-7v18',
            'color' => 'text-green-500',
        ],
        'down' => [
            'icon' => 'M19 14l-7 7m0 0l-7-7m7 7V3',
            'color' => 'text-red-500',
        ],
        'stable' => [
            'icon' => 'M5 12h14',
            'color' => 'text-yellow-500',
        ],
    ];
@endphp

<div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-all">
    <div class="flex items-start justify-between">
        <div>
            <p class="text-sm font-medium text-gray-500 mb-1">{{ $label }}</p>
            <p class="text-2xl font-bold {{ $colors[$color]['text'] }}">{{ $value }}</p>
            <p class="text-xs mt-2 {{ $trendIcons[$trend]['color'] }} flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="{{ $trendIcons[$trend]['icon'] }}" />
                </svg>
                {{ $trend === 'up' ? 'Hausse' : ($trend === 'down' ? 'Baisse' : 'Stable') }} ce mois
            </p>
        </div>
        <div class="p-3 rounded-lg {{ $colors[$color]['bg'] }} {{ $colors[$color]['icon'] }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}" />
            </svg>
        </div>
    </div>
</div>

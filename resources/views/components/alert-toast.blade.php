@props([
    'event' => 'default-event',
    'message' => 'Success!',
    'type' => 'success',
])

@php
    $bgColor = match($type) {
        'success' => 'bg-green-500',
        'error' => 'bg-red-500',
        'info' => 'bg-blue-500',
        'warning' => 'bg-yellow-500',
        default => 'bg-gray-800',
    };
@endphp

<div
    x-data="{ show: false }"
    x-on:{{ $event }}.window="show = true; setTimeout(() => show = false, 3000);"
    x-show="show"
    x-transition
    class="fixed top-5 right-5 {{ $bgColor }} text-white px-4 py-2 rounded shadow-lg z-50"
    style="display: none;"
>
    {{ $message }}
</div>

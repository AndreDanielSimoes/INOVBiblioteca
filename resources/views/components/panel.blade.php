@php
    $classes = 'p-4 bg-white/10 rounded-xl border border-transparent hover:border-blue-800 group transition-colors duration-500';
@endphp

<div {{ $attributes(['class' => $classes]) }}>
    {{ $slot }}
</div>

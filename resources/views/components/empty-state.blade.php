@props(['title', 'message'])
<div {{ $attributes->merge(['class' => 'empty-state text-center']) }}>
    <div class="empty-state-icon">◇</div>
    <h2 class="h5">{{ $title }}</h2>
    <p class="text-secondary mb-0">{{ $message }}</p>
    @if(isset($action))
        <div class="mt-3">{{ $action }}</div>
    @endif
</div>

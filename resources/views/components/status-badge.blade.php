@props(['status'])
@php
    $statusValue = $status instanceof \App\TaskStatus ? $status->value : (string) $status;
    $class = match ($statusValue) {
        \App\TaskStatus::Completed->value => 'text-bg-success',
        \App\TaskStatus::InProgress->value => 'text-bg-warning',
        default => 'text-bg-secondary',
    };
@endphp
<span {{ $attributes->merge(['class' => "badge rounded-pill {$class}"]) }}>{{ $statusValue }}</span>

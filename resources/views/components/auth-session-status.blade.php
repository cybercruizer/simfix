@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-red-600']) }}>
        {{ $status }}
    </div>
@endif

@props(['value'])

<label {{ $attributes->merge(['class' => 'text-lg font-semibold text-gray-900']) }}>
    {{ $value ?? $slot }}
</label>

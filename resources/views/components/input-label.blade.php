@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-bold text-md text-black']) }}>
    {{ $value ?? $slot }}
</label>

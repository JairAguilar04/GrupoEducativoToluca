@props(['value'])

<label {{ $attributes->merge(['class' => 'label']) }}>
    {{ $value ?? $slot }}<span class="text-red-600 font-bold">*</span>
</label>

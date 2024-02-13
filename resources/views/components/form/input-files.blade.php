@props(['name'])

<input type="file" name="{{ $name }}[]" id="{{ $name }}" multiple
    {{ $attributes->merge(['class' => 'mt-1 p-2 border rounded-md']) }}>

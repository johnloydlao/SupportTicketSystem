@props(['label' => null, 'values' => [], 'checked' => [], 'name' => ''])

<div {{ $attributes->merge(['class' => 'flex items-center']) }}>
    @foreach ($values as $value)
        <div class="mr-4">
            <input type="checkbox" name="{{ $name }}[]" id="{{ $name }}_{{ $value }}"
                value="{{ $value }}" {{ in_array($value, $checked) ? 'checked' : '' }}
                class="form-checkbox h-5 w-5 border-gray-400 rounded-md focus:border-gray-400 focus:ring
                focus:ring-blue-950 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1
                dark:text-gray-300 dark:focus:ring-offset-dark-eval-1">
            <label for="{{ $name }}_{{ $value }}"
                class="ml-2 font-medium text-sm text-gray-700 dark:text-gray-300']) }}>
                {{ $value ?? $slot }}">{{ $value }}</label>
        </div>
    @endforeach
</div>

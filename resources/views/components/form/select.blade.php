@props(['name', 'id', 'options', 'selected' => null])

<select name="{{ $name }}" id="{{ $id }}"
    {{ $attributes->merge([
        'class' => 'form-select py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring
                                            focus:ring-blue-950 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1
                                            dark:text-gray-300 dark:focus:ring-offset-dark-eval-1',
    ]) }}>

    @foreach ($options as $value => $label)
        <option value="{{ $value }}" {{ $value == $selected ? 'selected' : '' }}
            class="font-medium text-sm text-gray-700 dark:text-gray-300 {{ $value == $selected ? ' font-medium text-sm text-gray-700 dark:text-gray-300' : '' }}">
            {{ $label }}
        </option>
    @endforeach
</select>

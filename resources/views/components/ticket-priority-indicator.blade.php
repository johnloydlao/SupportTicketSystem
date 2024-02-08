@props(['priority'])

<span
    class="{{ $priority === 'Low' ? 'bg-blue-500 text-white' : ($priority === 'Medium' ? 'bg-yellow-500 text-white' : 'bg-red-500 text-white') }} px-2 inline-flex text-xs leading-5 font-semibold rounded-md">
    {{ $priority }}
</span>

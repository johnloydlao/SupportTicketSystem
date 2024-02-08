@props(['status'])

<span
    class="{{ $status === 'Open' ? 'bg-orange-500 text-white' : 'bg-green-500 text-white' }} px-2 inline-flex text-xs leading-5 font-semibold rounded-md">
    {{ $status }}
</span>

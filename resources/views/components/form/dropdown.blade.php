@props(['trigger'])
<div x-data="{ show: false }" @click.away="show = false" >
    <div @click="show =! show">
        {{ $trigger }}

    </div>
    <div x-show="show" x-transition x-bind:class="show ? 'border border-blue-950' : ''"
        class="py-2 absolute bg-white border border-blue-950 w-full mt-2 rounded-xl overflow-auto max-h-52 dark:focus:text-white dark:focus:bg-dark-eval-3 dark:text-gray-400 dark:bg-dark-eval-3">
        {{ $slot }}
    </div>
</div>

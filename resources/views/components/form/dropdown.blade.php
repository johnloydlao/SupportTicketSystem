@props(['trigger'])
<div x-data="{ show: false }" @click.away="show = false">
    <div @click="show =! show">
        {{ $trigger }}

    </div>
    <div x-show="show"
        class="py-2 absolute bg-white border border-blue-950 w-full mt-2 rounded-xl overflow-auto max-h-52">
        {{ $slot }}
    </div>
</div>

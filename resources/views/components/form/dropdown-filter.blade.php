<div class="relative w-full md:w-1/4 md:ml-4 lg:inline-flex border border-blue-950 dark:border-gray-600 rounded-md">
    <x-form.dropdown>
        <x-slot name="trigger">
            <button class="py-2 pl-3 pr-9 text-sm font-semibold w-full lg:w-40 text-left inline-flex">
                {{ $triggerText }}
                <x-icons.arrow-down class="absolute pointer-events-none" style="right: 12px;" />
            </button>
        </x-slot>

        {{ $slot }}
    </x-form.dropdown>
</div>

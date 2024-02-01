<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Tickets > Create Ticket') }}
            </h2>

        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">

        <form method="post" action="{{ route('tickets.store') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
            @csrf

            <div class="space-y-2">
                <x-form.label for="title" :value="__('Title')" />
                <x-form.input id="title" name="title" type="text" class="block w-full" required autofocus />
                <x-form.error :messages="$errors->get('title')" />
            </div>

            <div class="space-y-2">
                <x-form.label for="description" :value="__('Description')" />
                <x-form.textarea id="description" name="description" type="text" class="block w-full" autofocus />
                <x-form.error :messages="$errors->get('description')" />
            </div>

            <div class="space-y-2">
                <x-form.label for="labels" :value="__('Labels')" />
                @php
                    $labels = \App\Models\Label::pluck('name')->toArray();
                @endphp
                <x-form.input-checkbox label="labels" name="labels" :values="$labels" />
                <x-form.error :messages="$errors->get('labels')" />
            </div>

            <div class="space-y-2">
                <x-form.label for="categories" :value="__('Categories')" />
                @php
                    $categories = \App\Models\Category::pluck('name')->toArray();
                @endphp
                <x-form.input-checkbox label="categories" name="categories" :values="$categories" />
                <x-form.error :messages="$errors->get('categories')" />
            </div>

            <div class="space-y-2">

                <x-form.label for="priority" :value="__('Priority')" />
                <x-form.select name="priority" id="priority" :options="['low' => 'Low', 'medium' => 'Medium', 'high' => 'High']" />
                <x-form.error :messages="$errors->get('priority')" />
            </div>
            <div class="space-y-2">
                <x-form.label for="files" :value="__('Files')" />
                <x-form.input-files name="files" id="files" class="mt-1" />
                <x-form.error :messages="$errors->get('files')" />
            </div>

            <div>
                <x-button class="justify-center w-full gap-2">

                    <span>{{ __('Submit') }}</span>
                </x-button>
            </div>

        </form>
    </div>
</x-app-layout>

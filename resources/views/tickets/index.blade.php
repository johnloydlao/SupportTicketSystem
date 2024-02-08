<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <x-header title="Tickets > My Tickets " />
    </x-slot>

    <x-display-area>

        <div class="flex flex-col p-6">

            <div class="flex flex-col md:flex-row md:justify-between space-y-4 md:space-y-0 mb-4 ">

                <!-- Search bar -->
                <div class="w-full md:w-1/8">
                    <form method="GET" action="/tickets">
                        @if (request('status', 'priority', 'category'))
                            <input type="hidden" name="status" value="{{ request('status') }}">
                            <input type="hidden" name="priority" value="{{ request('priority') }}">
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif

                        <x-form.input-with-icon-wrapper>
                            <x-slot name="icon">
                                <x-icons.search aria-hidden="true" class="w-4 h-4" />
                            </x-slot>

                            <x-form.input withicon id="search" class="block w-full " type="text" name="search"
                                value="{{ request('search') }}" placeholder="{{ __('Search Title') }}" />
                        </x-form.input-with-icon-wrapper>
                    </form>
                </div>

                <x-form.dropdown-filter>
                    <x-slot name="triggerText">
                        {{ isset($currentStatus) ? ucwords($currentStatus) : 'Status' }}
                    </x-slot>
                    <x-form.dropdown-item
                        href="?status=open&{{ http_build_query(request()->except('status', 'page')) }}"
                        :active="request()->is('')">Open</x-form.dropdown-item>
                    <x-form.dropdown-item
                        href="?status=closed&{{ http_build_query(request()->except('status', 'page')) }}"
                        :active="request()->is('')">Closed</x-form.dropdown-item>
                </x-form.dropdown-filter>

                <x-form.dropdown-filter>
                    <x-slot name="triggerText">
                        {{ isset($currentPriority) ? ucwords($currentPriority) : 'Priority' }}
                    </x-slot>
                    <x-form.dropdown-item
                        href="?priority=low&{{ http_build_query(request()->except('priority', 'page')) }}"
                        :active="request()->is('')">Low</x-form.dropdown-item>
                    <x-form.dropdown-item
                        href="?priority=medium&{{ http_build_query(request()->except('priority', 'page')) }}"
                        :active="request()->is('')">Medium</x-form.dropdown-item>
                    <x-form.dropdown-item
                        href="?priority=high&{{ http_build_query(request()->except('priority', 'page')) }}"
                        :active="request()->is('')">High</x-form.dropdown-item>
                </x-form.dropdown-filter>

                <!-- Categories filter -->
                <x-form.dropdown-filter>
                    <x-slot name="triggerText">
                        {{ isset($currentCategory) ? ucwords($currentCategory->name) : 'Category' }}
                    </x-slot>
                    @foreach ($categories as $category)
                        <x-form.dropdown-item
                            href="?category={{ $category->name }}&{{ http_build_query(request()->except('category', 'page')) }}"
                            :active="request()->is('')">{{ ucwords($category->name) }}</x-form.dropdown-item>
                    @endforeach
                </x-form.dropdown-filter>

                <!-- Clear Filters link -->
                <div class="w-full md:w-1/4 flex items-center justify-center">
                    <a href="/tickets" class="text-blue-500 hover:underline text-sm">Clear Filters</a>
                </div>

            </div>

            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    @if ($tickets->count())
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-md mb-3">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-blue-950">
                                    <tr>
                                        <x-table.header>Ticket ID</x-table.header>
                                        <x-table.header>Title</x-table.header>
                                        <x-table.header>Status</x-table.header>
                                        <x-table.header>Priority</x-table.header>
                                        <x-table.header>Categories</x-table.header>
                                        <x-table.header>Date Submitted</x-table.header>
                                    </tr>
                                </thead>

                                <tbody class=" divide-y divide-gray-200">
                                    @foreach ($tickets as $ticket)
                                        <x-ticket.item :ticket="$ticket" />
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-center pt-2">No tickets found.</p>
                    @endif


                </div>
                {{ $tickets->links() }}

            </div>

        </div>

    </x-display-area>
</x-app-layout>

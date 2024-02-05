<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Tickets > My Tickets') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">

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

                            <x-form.input withicon id="search" class="block w-full" type="text" name="search"
                                value="{{ request('search') }}" placeholder="{{ __('Search Title') }}" />
                        </x-form.input-with-icon-wrapper>
                    </form>
                </div>

                <!-- Status filter -->
                <div class="relative w-full md:w-1/4 md:ml-4 lg:inline-flex border border-blue-950 rounded-md">
                    <x-form.dropdown>
                        <x-slot name="trigger">
                            <button class="py-2 pl-3 pr-9 text-sm font-semibold w-full lg:w-40 text-left inline-flex">
                                {{ isset($currentStatus) ? ucwords($currentStatus) : 'Status' }}
                                <x-icons.arrow-down class="absolute pointer-events-none" style="right: 12px;" />
                            </button>
                        </x-slot>

                        <x-form.dropdown-item
                            href="?status=open&{{ http_build_query(request()->except('status', 'page')) }}"
                            :active="request()->is('')">Open</x-form.dropdown-item>
                        <x-form.dropdown-item
                            href="?status=closed&{{ http_build_query(request()->except('status', 'page')) }}"
                            :active="request()->is('')">Closed</x-form.dropdown-item>
                    </x-form.dropdown>
                </div>

                <!-- Priority filter -->
                <div class="relative w-full md:w-1/4 md:ml-4 lg:inline-flex border border-blue-950 rounded-md">
                    <x-form.dropdown>
                        <x-slot name="trigger">
                            <button class="py-2 pl-3 pr-9 text-sm font-semibold w-full lg:w-40 text-left inline-flex">
                                {{ isset($currentPriority) ? ucwords($currentPriority) : 'Priority' }}
                                <x-icons.arrow-down class="absolute pointer-events-none" style="right: 12px;" />
                            </button>
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
                    </x-form.dropdown>
                </div>

                <!-- Categories filter -->
                <div class="relative w-full md:w-1/4 md:ml-4 lg:inline-flex border border-blue-950 rounded-md">
                    <x-form.dropdown>
                        <x-slot name="trigger">
                            <button class="py-2 pl-3 pr-9 text-sm font-semibold w-full lg:w-40 text-left inline-flex">
                                {{ isset($currentCategory) ? ucwords($currentCategory->name) : 'Categories' }}
                                <x-icons.arrow-down class="absolute pointer-events-none " style="right: 12px;" />
                            </button>
                        </x-slot>

                        @foreach ($categories as $category)
                            <x-form.dropdown-item
                                href="?category={{ $category->name }}&{{ http_build_query(request()->except('category', 'page')) }}"
                                :active="request()->is('')">{{ ucwords($category->name) }}</x-form.dropdown-item>
                        @endforeach
                    </x-form.dropdown>
                </div>

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
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">
                                            Title
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">
                                            Priority
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">
                                            Categories
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">
                                            Date Submitted
                                        </th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class=" divide-y divide-gray-200">
                                    @foreach ($tickets as $ticket)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm"> <a
                                                    href="/tickets/{{ rawurlencode($ticket->title) }}"
                                                    class="text-blue-500 hover:underline cursor-pointer">
                                                    {{ $ticket->title }}</a>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="{{ $ticket->status === 'Open' ? 'bg-orange-200 ' : 'bg-green-200' }} px-2 inline-flex text-xs leading-5 font-semibold rounded-md  ">
                                                    {{ ucwords($ticket->status) }}
                                                </span>
                                            </td>
                                            <td class="  px-6 py-4 whitespace-nowrap ">
                                                <span
                                                    class="{{ $ticket->priority === 'Low' ? 'bg-blue-200' : ($ticket->priority === 'Medium' ? 'bg-yellow-200' : 'bg-red-200') }}  px-2 inline-flex text-xs leading-5 font-semibold rounded-md ">
                                                    {{ ucwords($ticket->priority) }}</span>

                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                @foreach ($ticket->categories as $category)
                                                    <li>{{ $category->name }}</li>
                                                @endforeach
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm  ">
                                                <time>{{ $ticket->created_at->format('F j, Y, g:i a') }}</time>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">

                                            </td>
                                        </tr>
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
    </div>
    </div>
</x-app-layout>

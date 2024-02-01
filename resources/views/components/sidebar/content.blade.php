<x-perfect-scrollbar as="nav" aria-label="main" class="flex flex-col flex-1 gap-4 px-3">

    <x-sidebar.link title="Dashboard" href="{{ route('dashboard') }}" :isActive="request()->routeIs('dashboard')">
        <x-slot name="icon">
            <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>

    <x-sidebar.dropdown title="Tickets" :active="Str::startsWith(
        request()
            ->route()
            ->uri(),
        'tickets',
    )">
        <x-slot name="icon">
            <x-icons.ticket class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>

        <x-sidebar.sublink title="My Tickets" href="{{ route('tickets') }}" :active="request()->routeIs('tickets')" />
        <x-sidebar.sublink title="Create Ticket" href="{{ route('tickets.create') }}" :active="request()->routeIs('tickets.create')" />
    </x-sidebar.dropdown>

    <div x-transition x-show="isSidebarOpen || isSidebarHovered" class="text-sm text-gray-500">
        Dummy Links
    </div>

    @php
        $links = array_fill(0, 20, '');
    @endphp

    @foreach ($links as $index => $link)
        <x-sidebar.link title="Dummy link {{ $index + 1 }}" href="#" />
    @endforeach

</x-perfect-scrollbar>

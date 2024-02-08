<tr>
    <x-table.data>{{ $ticket->id }} </x-table.data>
    <x-table.data><a href="/tickets/{{ $ticket->id }}" class="text-blue-500 hover:underline cursor-pointer">
            {{ $ticket->title }}</a></x-table.data>
    <x-table.data> <x-ticket-status-indicator :status="$ticket->status" /></x-table.data>
    <x-table.data> <x-ticket-priority-indicator :priority="$ticket->priority" /></x-table.data>
    <x-table.data>
        @foreach ($ticket->categories as $category)
            <li>{{ $category->name }}</li>
        @endforeach
    </x-table.data>
    <x-table.data> <time>{{ $ticket->created_at->format('F j, Y, g:i a') }}</time></x-table.data>
</tr>

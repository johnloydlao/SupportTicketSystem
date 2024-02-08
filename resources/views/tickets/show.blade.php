<x-app-layout>
    <x-slot name="header">
        <x-header title="Tickets > My Tickets > {{ $ticket->title }}" />
    </x-slot>

    <x-display-area>
        <div class="flex flex-col">
            <div>
                <div class="pb-2 text-lg font-bold"> Ticket#{{ $ticket->id }} - {{ $ticket->title }}</div>
                <div>
                    <x-ticket-status-indicator :status="$ticket->status" />
                    <x-ticket-priority-indicator :priority="$ticket->priority" />

                    @foreach ($ticket->categories as $category)
                        <span
                            class=" bg-violet-500 text-white px-2 inline-flex text-xs leading-5 font-semibold rounded-md ">{{ $category->name }}</span>
                    @endforeach

                    @foreach ($ticket->labels as $label)
                        <span
                            class=" bg-pink-500 text-white px-2 inline-flex text-xs leading-5 font-semibold rounded-md ">{{ $label->name }}</span>
                    @endforeach
                </div>
            </div>
            <div>

            </div>
            <div>{{ $ticket->description }}

            </div>

        </div>


    </x-display-area>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <x-header title="Tickets > My Tickets > {{ $ticket->title }}" />
    </x-slot>

    <x-display-area>
        <div class="grid grid-cols-1 md:grid-cols-2">
            <div class="basis-1/2">
                <div class="flex flex-col">
                    <div class="border-0 border-b-2 pb-2">
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

                    <div class="py-2">
                        <div class="py-2">
                            <div class="flex items-center text-sm">
                                <img src="https://i.pravatar.cc/60?" class="rounded-full w-10 h-10">
                                <div class="ml-3">
                                    <h5 class="font-bold">{{ $ticket->user->name }}</h5>
                                    <h6><time>{{ $ticket->created_at->format('F j, Y, g:i a') }}</time></h6>
                                </div>
                            </div>
                        </div>
                        <p class=" text-base"> {{ $ticket->description }}</p>

                        <p class="text-sm py-3 text-gray-500">{{ count($ticket->files) }} Attachments</p>

                        <div class="flex flex-wrap gap-4">


                            @foreach ($ticket->files as $file)
                                @if ($loop->iteration < 3)
                                    <x-file-attachment-card download="{{ asset($file->path . $file->name) }}"
                                        icon="{{ $file->type === 'pdf' ? asset('images/PDFLogo.png') : asset($file->path . $file->name) }}"
                                        filename="{{ $file->name }}"
                                        filesize="{{ round($file->size / 1024) }} KB" />
                                @elseif($loop->remaining)
                                    <a href="" class="text-sm text-blue-500 hover:underline cursor-pointer">Show
                                        more attachments</a>
                                @endif
                            @endforeach
                        </div>


                    </div>
                    <section class="  antialiased border-t-2 p-4">
                        <div class="">

                            <form action="/tickets/{{ $ticket->id }}/comments" method="post" class="mb-6">
                                @csrf
                                <div
                                    class="focus:ring-black py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border  border-gray-300 dark:bg-gray-800 dark:border-gray-700">
                                    <label for="body" class="sr-only">Your comment</label>
                                    <textarea id="body" name = "body" rows="5"
                                        class=" resize-none px-0 w-full text-base text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                                        placeholder="Comment as {{ Auth::user()->name }}" required></textarea>
                                    <x-form.error :messages="$errors->get('body')" />
                                </div>
                                <div class="flex justify-end">
                                    <x-button class="text-sm">

                                        Send
                                    </x-button>
                                </div>
                            </form>

                        </div>
                    </section>
                </div>
            </div>
            <div class="basis-1/2 overflow-scroll h-4/5">

                <div class="flex justify-between items-center mb-6 sticky top-0">
                    <h2 class="text-lg font-bold text-gray-900 dark:text-white">Comments
                        ({{ $ticket->comments->count() }})</h2>
                </div>
                @if ($ticket->comments->count())

                    @foreach ($ticket->comments as $comment)
                        <article class="px-4 text-base bg-gray-100 hover:bg-gray-200 rounded-lg dark:bg-gray-900 mb-2">
                            <footer class="flex justify-between items-center mb-2">
                                <div class="flex items-center">

                                    <p
                                        class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold">
                                        <img class="mr-2 w-6 h-6 rounded-full"
                                            src="https://flowbite.com/docs/images/people/profile-picture-2.jpg"
                                            alt="{{ $comment->user->name }}">{{ $comment->user->name }}
                                    </p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                        <time>{{ $comment->created_at->format('F j, Y, g:i a') }}</time>
                                    </p>
                                </div>
                                <div x-data="{ isOpen: false }" class="">
                                    <button @click="isOpen = !isOpen"
                                        class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 dark:text-gray-400 rounded-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                                        type="button">
                                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="currentColor" viewBox="0 0 16 3">
                                            <path
                                                d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                                        </svg>
                                        <span class="sr-only">Comment settings</span>
                                    </button>

                                    <!-- Dropdown menu -->
                                    <div x-show="isOpen" @click.away="isOpen = false" id="dropdownComment1"
                                        class=" absolute bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                            aria-labelledby="dropdownMenuIconHorizontalButton">
                                            <li><a href="#"
                                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                                            </li>
                                            <li><a href="#"
                                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Remove</a>
                                            </li>
                                            <li><a href="#"
                                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Report</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </footer>
                            <p>{{ $comment->body }}</p>
                        </article>
                    @endforeach
                @else
                    <div class="flex justify-center mb-2">
                        <x-illustrations.void />
                    </div>
                    <p class="text-center">No comments yet. Please add one.</p>
                @endif

            </div>
        </div>

    </x-display-area>
</x-app-layout>

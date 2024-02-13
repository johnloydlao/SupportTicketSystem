<a href="{{ $download }}" download>
    <div
        class=" rounded-md flex items-center border border-blue-300 bg-blue-100 dark:bg-dark-eval-2 hover:bg-blue-200 dark:hover:bg-dark-eval-1">
        <div class="flex items-center p-2">
            <img src="{{ $icon }}" class=" object-contain w-10 h-10 ">
            <div class="ml-3 w-40">
                <div>
                    <p class="font-bold text-xs truncate">{{ $filename }}</p>
                    <p class="text-gray-500 text-xs">{{ $filesize }}</p>
                </div>
            </div>
            <x-icons.download class="ml-4 w-4 rounded" />
        </div>
    </div>
</a>

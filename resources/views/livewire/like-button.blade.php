<div>
    <!-- Model has been liked -->
    @if ($count)
        <button wire:click="like"
            class="text transform text-yellow-200 transition-colors duration-100 hover:text-white focus:text-gray-600 focus:outline-none dark:bg-gray-700 dark:focus:bg-gray-600">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 1 24 24" stroke-width="1.0"
                stroke="currentColor" class="h-10 w-10">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
            </svg>
            <div class="text-sm font-extrabold">{{ $count }}</span>
        </button>
        <!-- Model has not been liked -->
    @else
        <button wire:click="unlike"
            class="text transform text-gray-400 transition-colors duration-100 hover:text-white focus:text-yellow-200 focus:outline-none dark:bg-gray-700 dark:focus:bg-gray-600">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 1 24 24" stroke-width="1.0"
                stroke="currentColor" class="h-10 w-10">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
            </svg>
            {{-- <div class="text-sm font-extrabold hover:text-yellow-200">
                {{ $model }}</span> --}}
        </button>
    @endif
</div>

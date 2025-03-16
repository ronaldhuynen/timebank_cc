<div>
    @if ($paginator->hasPages() && $paginator->total() > $paginator->perPage())
        <nav aria-label="Pagination Navigation" class="flex justify-end" role="navigation">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span
                    class="invisible relative ml-3 inline-flex cursor-default items-center rounded-md border border-gray-200 bg-white px-4 py-2 text-sm font-medium leading-5 text-gray-300 shadow-sm dark:border-gray-600 dark:bg-gray-800 dark:text-gray-600">
                    {{ __('Previous') }}
                </span>
            @else
                <button
                    class="relative ml-3 inline-flex items-center rounded-md border border-gray-200 bg-white px-4 py-2 text-sm font-medium leading-5 text-gray-500 shadow-sm dark:border-gray-600 dark:bg-gray-800 dark:text-gray-600"
                    type="button"
                    wire:click="previousPage('{{ $paginator->getPageName() }}')">
                    {{ __('Previous') }}
                </button>
            @endif

            {{-- Pagination Elements --}}
            @php
                $currentPage = $paginator->currentPage();
                $lastPage = $paginator->lastPage();

                if ($paginator->total() === 0) {
                    $start = 0;
                    $end = 0;
                } else {
                    $start = max($currentPage - 1, 1);
                    $end = min($currentPage + 1, $lastPage);
                }
            @endphp

            @if ($start > 0 && $end > 0)
                {{-- First Page Link --}}
                @if ($start > 1)
                    <button
                        class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium leading-5 text-gray-500 shadow-sm dark:border-gray-600 dark:bg-gray-800 dark:text-gray-600"
                        type="button"
                        wire:click="gotoPage(1)">
                        1
                    </button>
                    @if ($start > 2)
                        <span
                            class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium leading-5 text-gray-500 shadow-sm dark:border-gray-600 dark:bg-gray-800 dark:text-gray-600">
                            ...
                        </span>
                    @endif
                @endif

                {{-- Page Links --}}
                @for ($page = $start; $page <= $end; $page++)
                    @if ($page == $paginator->currentPage())
                        <span
                            class="relative ml-3 inline-flex cursor-default items-center rounded-md border border-blue-600 bg-white px-4 py-2 text-sm font-medium leading-5 text-blue-600 shadow-sm">
                            {{ $page }}
                        </span>
                    @else
                        <button
                            class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium leading-5 text-gray-500 shadow-sm dark:border-gray-600 dark:bg-gray-800 dark:text-gray-600"
                            type="button"
                            wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')">
                            {{ $page }}
                        </button>
                    @endif
                @endfor

                {{-- Last Page Link --}}
                @if ($end < $lastPage)
                    @if ($end < $lastPage - 1)
                        <span
                            class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium leading-5 text-gray-500 shadow-sm dark:border-gray-600 dark:bg-gray-800 dark:text-gray-600">
                            ...
                        </span>
                    @endif
                    <button
                        class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium leading-5 text-gray-500 shadow-sm dark:border-gray-600 dark:bg-gray-800 dark:text-gray-600"
                        type="button"
                        wire:click="gotoPage({{ $lastPage }}, '{{ $paginator->getPageName() }}')">
                        {{ $lastPage }}
                    </button>
                @endif
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <button
                    class="relative ml-3 inline-flex items-center rounded-md border border-gray-200 bg-white px-4 py-2 text-sm font-medium leading-5 text-gray-500 shadow-sm dark:border-gray-600 dark:bg-gray-800 dark:text-gray-600"
                    type="button"
                    wire:click="nextPage('{{ $paginator->getPageName() }}')">
                    {{ __('Next') }}
                </button>
            @else
                <span
                    class="invisible relative ml-3 inline-flex cursor-default items-center rounded-md border border-gray-200 bg-white px-4 py-2 text-sm font-medium leading-5 text-gray-300 shadow-sm dark:border-gray-600 dark:bg-gray-800 dark:text-gray-600">
                    {{ __('Next') }}
                </span>
            @endif
        </nav>
    @endif
</div>
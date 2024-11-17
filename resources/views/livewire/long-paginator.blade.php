<div>
    <!-- TODO: Remove debug for production -->
    <!-- Debug paginator items -->
    {{-- @dump([
        'total' => $paginator->total(),
        'lastPage' => $paginator->lastPage(),
        'currentPage' => $paginator->currentPage(),
        'perPage' => $paginator->perPage(),
        'count' => $paginator->count(),
    ]) --}}

    @if ($paginator->hasPages() && $paginator->total() > $paginator->perPage())
        <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-end">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="invisible relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-300 bg-white border border-gray-200 cursor-default leading-5 rounded-md dark:text-gray-600 dark:bg-gray-800 dark:border-gray-600 shadow-sm">{{__('Previous')}}</span>
            @else
                <button type="button" wire:click="previousPage('{{ $paginator->getPageName() }}')" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-200 leading-5 rounded-md dark:text-gray-600 dark:bg-gray-800 dark:border-gray-600 shadow-sm">{{__('Previous')}}</button>
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
                    <button type="button" wire:click="gotoPage(1)" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 leading-5 rounded-md dark:text-gray-600 dark:bg-gray-800 dark:border-gray-600 shadow-sm">1</button>
                    @if ($start > 2)
                        <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 leading-5 rounded-md dark:text-gray-600 dark:bg-gray-800 dark:border-gray-600 shadow-sm">...</span>
                    @endif
                @endif

                {{-- Page Links --}}
                @for ($page = $start; $page <= $end; $page++)
                    @if ($page == $paginator->currentPage())
                        <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-blue-600 bg-white border border-blue-600 cursor-default leading-5 rounded-md shadow-sm">{{ $page }}</span>
                    @else
                        <button type="button" wire:click="gotoPage({{ $page }})" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 leading-5 rounded-md dark:text-gray-600 dark:bg-gray-800 dark:border-gray-600 shadow-sm">{{ $page }}</button>
                    @endif
                @endfor

                {{-- Last Page Link --}}
                @if ($end < $lastPage)
                    @if ($end < $lastPage - 1)
                        <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 leading-5 rounded-md dark:text-gray-600 dark:bg-gray-800 dark:border-gray-600 shadow-sm">...</span>
                    @endif
                    <button type="button" wire:click="gotoPage({{ $lastPage }})" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 leading-5 rounded-md dark:text-gray-600 dark:bg-gray-800 dark:border-gray-600 shadow-sm">{{ $lastPage }}</button>
                @endif
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <button type="button" wire:click="nextPage('{{ $paginator->getPageName() }}')" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-200 leading-5 rounded-md dark:text-gray-600 dark:bg-gray-800 dark:border-gray-600 shadow-sm">{{__('Next')}}</button>
            @else
                <span class="invisible relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-300 bg-white border border-gray-200 cursor-default leading-5 rounded-md dark:text-gray-600 dark:bg-gray-800 dark:border-gray-600 shadow-sm">{{__('Next')}}</span>
            @endif
        </nav>
    @endif
</div>
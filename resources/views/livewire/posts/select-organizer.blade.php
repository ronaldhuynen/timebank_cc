<div x-data class="mt-4 max-w-md">

    <label for="toAccount" class="my-2 block text-sm font-medium text-gray-700"> {{ __('Event organizer') }} <span
            class="text-red-600">*</span> </label>

    <div class="relative">
        <div class="pointer-events-none absolute inset-y-0 left-0 flex pl-3 pt-2">
            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                    clip-rule="evenodd" />
            </svg>
        </div>


        <!----- When nothing is selected ---->
        @if (!isset($selectedId) || $search != '')

            <input wire:model.debounce.300ms="search" x-on:blur="$wire.checkValidation()"
                class="block w-full rounded-md border border-gray-300 bg-white py-2 pl-10 pr-3 leading-5 placeholder-gray-400 shadow-sm transition duration-150 ease-in-out focus:border-indigo-300 focus:placeholder-gray-700 sm:text-sm"
                placeholder="{{ __('Search organizer name') }}" type="search" autocomplete="off">

            @if (strlen($search) > 2)
                <ul
                    class="absolute z-50 mt-0 w-full rounded-md border border-gray-300 bg-white text-sm text-gray-700 shadow-lg">
                    @forelse ($searchResults as $result)
                        <li>
                            <a wire:click="orgSelected({{ $result['id'] }})"
                                class="flex items-center px-2 py-2 hover:bg-gray-100">
                                <img src="{{ $result['profile_photo_path'] }}" class="w-10 rounded-full">
                                <div class="ml-4 leading-tight">
                                    <div class="font-semibold text-gray-900">
                                        @if (array_key_exists('name', $result))
                                            {{ $result['name'] }}
                                        @else
                                            {{ __('No results found') }}
                                        @endif
                                    </div>
                                    <div class="text-gray-600">
                                        @if (array_key_exists('description', $result))
                                            {{ $result['description'] }}
                                        @else
                                            {{ __('No results found') }}
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </li>
                    @empty
                        <li class="px-4 py-4">{{ __('No results found for') }} "{{ $search }}"</li>
                    @endforelse
                </ul>
            @endif

        <!----- When selected ---->
        @else
            <input wire:model.debounce.300ms="search"
                class="sadow-sm block w-full rounded-md border border-gray-300 bg-white py-2 pl-10 pr-3 leading-5 placeholder-gray-400 transition duration-150 ease-in-out focus:border-indigo-300 focus:placeholder-gray-300 focus:outline-none sm:text-sm"
                placeholder="{{ __('Search again...') }}" type="search" autocomplete="off">
            <div
                class="focus:shadow-outline-blue mt-2 w-full rounded-md border border-gray-300 bg-white pl-0 pr-3 leading-5 shadow-sm transition duration-150 ease-in-out focus:border-indigo-300 focus:outline-none sm:text-sm">
                <div class="flex items-center px-2 py-2">
                    <img src="{{ $selected['profile_photo_path'] }}" class="w-10 rounded-full">
                    <div class="ml-4 leading-tight">
                        <div wire:model="name" class="font-semibold">
                            {{ $selected['name'] }}
                        </div>
                        <div wire:model="description" class="text-gray-600">
                            {{ $selected['description'] }}
                        </div>
                    </div>
                </div>

            </div>
        @endif

    </div>
</div>

<div class="mt-4 max-w-md" wire:init="preSelected" x-data="{ open: false, selected: @entangle('selectedAccount') }">

    <!-- Only show component when profile owns more than one account -->
    @if (count(session('activeProfileAccounts')) > 1)

        @isset($label)
            <x-jetstream.label :value="$label" for="account" />
        @else
            <x-jetstream.label for="account" value="{{ __('From account') }}" />
        @endisset
        <div class="relative">
            <button @click="open = !open"
                    class="mt-1 block w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-left shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                    type="button">
                <div :class="selected ? 'text-gray-900' : 'text-gray-300'" class="flex items-center justify-between">
                    @if (!$selectedAccount)
                        <span class="cursor-default text-red-700" x-text=" '{{ __('No account available') }}'"></span>
                    @else
                        <span x-text="selected ? selected.name : '{{ __('Select an account') }}'"></span>
                        <span class="ml-auto" x-text="selected ? selected.balanceH : ''"></span>
                    @endif
                    <svg class="text-secondary-400 invalidated:text-negative-400 invalidated:dark:text-negative-600 ml-2 h-5 w-5"
                         fill="none" height="24" stroke="currentColor" viewBox="0 0 24 24" width="24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="M8.25 15L12 18.75L15.75 15M8.25 9L12 5.25L15.75 9" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="1.5"></path>
                    </svg>
                </div>
            </button>
            <ul @click.away="open = false"
                class="absolute z-10 mt-1 w-full rounded-md border border-gray-300 bg-white shadow-lg" x-show="open">
                @foreach ($profileAccounts as $index => $profileAccount)
                    <li @click="selected = { id: {{ $profileAccount['id'] }}, name: '{{ __(ucfirst(strtolower($selectedAccount['name']))) }}', balance: '{{ tbFormat($profileAccount['balance']) }}' }; open = false; $wire.fromAccountSelected({{ $profileAccount['id'] }})"
                        class="flex cursor-pointer justify-between px-3 py-2 hover:bg-gray-100"
                        wire:key="{{ $index }}">
                        <span>{{ __(ucfirst(strtolower($profileAccount['name']))) }}</span>
                        <span class="ml-auto">{{ tbFormat($profileAccount['balance']) }}</span>
                        <span class="ml-2 w-5"></span>
                    </li>
                @endforeach
            </ul>
        </div>

    @endif

</div>

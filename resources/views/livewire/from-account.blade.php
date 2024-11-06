<div wire:init="preSelected" class="max-w-md mt-4" x-data="{ open: false, selected: @entangle('selectedAccount') }">
    @isset($label)
        <x-jetstream.label :value="$label" for="account" />
    @else
        <x-jetstream.label for="account" value="{{ __('From account') }}" />
    @endisset

<div class="relative">
    <button type="button" @click="open = !open" class="text-left mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        <div :class="selected ? 'text-gray-900' : 'text-gray-300'" class="flex justify-between items-center">
            @if (!$selectedAccount)
                <span class="text-red-700 cursor-default" x-text=" '{{ __('No account available') }}'"></span>
            @else
                <span x-text="selected ? selected.name : '{{ __('Select Account') }}'"></span>
                <span class="ml-auto" x-text="selected ? selected.balanceH : ''"></span>
            @endif
            <svg class="w-5 h-5 ml-2  text-secondary-400 invalidated:text-negative-400 invalidated:dark:text-negative-600" stroke="currentColor" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M8.25 15L12 18.75L15.75 15M8.25 9L12 5.25L15.75 9" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </div>
    </button>
        <ul x-show="open" @click.away="open = false" class="absolute z-10 mt-1 w-full bg-white border border-gray-300 rounded-md shadow-lg">
            @foreach($profileAccounts as $index => $profileAccount)
                <li wire:key="{{ $index }}" @click="selected = { id: {{ $profileAccount['id'] }}, name: '{{ ucfirst(strtolower($profileAccount['name'])) }}', balance: '{{ tbFormat($profileAccount['balance']) }}' }; open = false; $wire.fromAccountSelected({{ $profileAccount['id'] }})" class="flex justify-between px-3 py-2 hover:bg-gray-100 cursor-pointer">
                    <span>{{ ucfirst(strtolower($profileAccount['name'])) }}</span>
                    <span class="ml-auto">{{ tbFormat($profileAccount['balance']) }}</span>
                    <span class="w-5 ml-2"></span>
                </li>
            @endforeach
        </ul> 
    </div>
</div>
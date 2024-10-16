<div wire:init="preSelected({{ $profileAccounts }})" class="max-w-md mt-4" x-data="{ open: false, selected: null }">
    @isset($label)
        <x-jetstream.label :value="$label" for="account" />
    @else
        <x-jetstream.label for="account" value="{{ __('From account') }}" />
    @endisset

    <div class="relative">
        <button @click="open = !open" class="text-left mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        <div :class="selected ? 'text-gray-900' : 'text-gray-300'" class="flex justify-between">
                <span x-text="selected ? selected.name : '{{ __('Select Account') }}'"></span>
                <span x-text="selected ? selected.balance : ''"></span>
            </div>
        </button>
        <ul x-show="open" @click.away="open = false" class="absolute z-10 mt-1 w-full bg-white border border-gray-300 rounded-md shadow-lg">
            @foreach($profileAccounts as $index => $profileAccount)
                <li wire:key="{{ $index }}" @click="selected = { id: {{ $profileAccount['id'] }}, name: '{{ ucfirst(strtolower($profileAccount['name'])) }}', balance: '{{ tbFormat($profileAccount['balance']) }}' }; open = false; $wire.fromAccountSelected({{ $profileAccount['id'] }})" class="flex justify-between px-3 py-2 hover:bg-gray-100 cursor-pointer">
                    <span>{{ ucfirst(strtolower($profileAccount['name'])) }}</span>
                    <span>{{ tbFormat($profileAccount['balance']) }}</span>
                </li>
            @endforeach
        </ul>
    </div>
</div>
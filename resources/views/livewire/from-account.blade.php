<div wire:init="preSelected({{ $profileAccounts }})" class="max-w-md mt-4">

    @isset($label)
        <x-jetstream.label :value="$label" for="account" />
    @else
        <x-jetstream.label for="account" value="{{ __('From account') }}" />
    @endisset
        <select wire:model.live="fromAccountId" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            @foreach($profileAccounts as $index => $profileAccount)
            <option wire:key="{{ $index }}" wire:click="fromAccountSelected({{ $profileAccount['id'] }})" value={{ $profileAccount['id'] }}>{{ $profileAccount['name'] }} &emsp; {{ tbFormat($profileAccount['balance']) }}
            </option>
            @endforeach
        </select>
</div>



<div wire:init="preSelected({{ $profileAccounts }})" class="max-w-md mt-4">

    <label for="account" class="my-2 block text-sm font-medium text-gray-900">{{ __('From account') }}</label>

        <select wire:model="fromAccountId" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            @foreach($profileAccounts as $index => $profileAccount)
            <option wire:key="{{ $index }}" wire:click="fromAccountSelected({{ $profileAccount['id'] }})" value={{ $profileAccount['id'] }}>{{ $profileAccount['name'] }} &emsp; {{ tbFormat($profileAccount['balance']) }}
            </option>
            @endforeach
        </select>
</div>



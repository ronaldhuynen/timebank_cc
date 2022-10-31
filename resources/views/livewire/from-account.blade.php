<div wire:init="preSelected({{ $userAccounts }})" class="max-w-md mt-4">

    <label for="account" class="my-2 block text-sm font-medium text-gray-700">{{ __('From your') }}</label>

        <select wire:model="fromAccountId" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            @foreach($userAccounts as $index => $userAccount)
            <option wire:key="{{ $index }}" wire:click="fromAccountSelected({{ $userAccount['id'] }})" value={{ $userAccount['id'] }}>{{ $userAccount['name'] }} &emsp; {{ tbFormat($userAccount['balance']) }}
            </option>
            @endforeach
        </select>
</div>



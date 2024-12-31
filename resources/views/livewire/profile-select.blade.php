<div @click.stop>
    <select wire:model.live="userProfileIndex" wire:change="profileSelected" class="cursor-pointer mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        <option value="null" disabled>{{ __('Switch Profile') }}</option>
        <option value={{ null }}>{{ \Illuminate\Support\Str::limit($userName, 25, $end='...') }}</option>
        @foreach($userProfiles as $index => $userProfile)
        <option  wire:key="{{ $index }}" value="{{ $index }}"> {{ \Illuminate\Support\Str::limit($userProfile['name'], 25, $end='...') }}</option>
        @endforeach
    </select>
</div>


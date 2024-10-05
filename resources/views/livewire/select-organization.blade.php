<div @click.stop>
    <select wire:model.live="organizationId" wire:change="organizationSelected" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        <option value="null" disabled>{{ __('Switch Profile') }}</option>
        <option value={{ null }}>{{ \Illuminate\Support\Str::limit($user['name'], 25, $end='...') }}</option>
        @foreach($userOrganizations as $index => $userOrganization)
        <option wire:key="{{ $index }}" value="{{ $userOrganization['id'] }}"> {{ \Illuminate\Support\Str::limit($userOrganization['name'], 25, $end='...') }}</option>
        @endforeach
    </select>
</div>

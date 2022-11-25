<div @click.stop>
    {{-- <x-select
        placeholder="switrch"
        wire:model.defer="organisationId"
        />
        @foreach($userOrganisations as $index => $userOrganisation)
            <x-select.user-option src="https://via.placeholder.com/500" label="{{ $userOrganisation['name'] }}" value="{{ $userOrganisation['id'] }}" />
        @endforeach
    </x-select> --}}

        <x-select placeholder="Switch profile" wire:model.defer="organisationId">
            @foreach($userOrganisations as $index => $userOrganisation)
                <x-select.user-option src="{{ Storage::url($userOrganisation['profile_photo_path']) }}" label=" {{ $userOrganisation['name'] }}" value="{{ $userOrganisation['id'] }}" />
            @endforeach
        </x-select>

</div>
<x-jet-form-section submit="updateProfilePhone">
    <x-slot name="title">
        {{ __('Skills you share on Timebank.cc') }}
    </x-slot>

    <x-slot name="description">
        <p>{{ __('Add your skills to your profile.') }}
        <p> {{ __('Rare skills can be interesting for others, but very common skills are very usefull too!') }} </p>
    </x-slot>

    <x-slot name="form">

        <!-- Skills -->
        <div class="col-span-6  mb-6" 
        {{-- wire:init="phonecodeInit" --}}
        >
        <x-jet-label for="phone" value="{{ __('Skills, separated by a comma') }}" />
            <div class="col-span-2">
                <x-input
                    id="skills"
                    placeholder="Writing English, Walking your dog, Moving house, Electronics repair"
                    wire:model.lazy="state.phone" 
                    class="placeholder-gray-300"/>
            </div>
            @error('phone')
                <p class="col-span-6 -mt-6 text-sm text-red-500">{{$message}}</p>
            @enderror

        <div class="col-span-6 mt-3">
            <x-checkbox id="right-label" label="Visible for my Timebank.cc friends" wire:model.defer="state.phone_public_for_friends" />
        </div>
        </div>
    </x-slot>



    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>

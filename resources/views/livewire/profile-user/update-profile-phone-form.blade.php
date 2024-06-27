<x-form-section submit="updateProfilePhone">
    <x-slot name="title">
        {{ __('Mobile phone number') }}
    </x-slot>

    <x-slot name="description">
        <p>{{ __('Your mobile phone can be used to authorize access to your Timebank.cc account.') }}
        <p> {{ __('Choose if approved Timebank.cc friends will be able to see your phone number. Otherwise your number will be kept private') }} </p>
    </x-slot>

    <x-slot name="form">

        <!-- Phone -->
        <div class="col-span-6  -mb-6" wire:init="phonecodeInit">
        <x-label for="phone" value="{{ __('Mobile phone') }}" />
        </div>
            <div class="col-span-1">
                <x-native-select
                    id="phonecode"
                    wire:model="phonecode"
                    :options="$phoneCodeOptions"
                    option-value="code"
                    option-label="label"
                    class="placeholder-gray-300"
                    >
                </x-native-select>
            </div>
            <div class="col-span-2 -ml-3">
                <x-input
                    id="phone"
                    placeholder="Enter mobile phone number"
                    wire:model.lazy="state.phone" 
                    class="placeholder-gray-300"/>
            </div>
            @error('phone')
                <p class="col-span-6 -mt-6 text-sm text-red-500">{{$message}}</p>
            @enderror

        <div class="col-span-6 -mt-3">
            <x-checkbox id="right-label" label="Visible for my Timebank.cc friends" wire:model.defer="state.phone_public_for_friends" />
        </div>
    </x-slot>



    <x-slot name="actions">
        <x-action-message class="mr-3" on="saved">
            {{ __('Saved') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>

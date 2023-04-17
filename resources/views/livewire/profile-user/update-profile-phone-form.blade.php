<x-jet-form-section submit="updateProfilePhone">
    <x-slot name="title">
        {{ __('Mobile phone number') }}
    </x-slot>

    <x-slot name="description">
       <p> {{ __('Only approved Timebank.cc friends will be able to see your phone number.') }} </p>
       <p>{{ __('Your mobile phone can also be used as an alternative mode of authorizing access to your Timebank.cc account. ') }}
    </x-slot>

    <x-slot name="form">

        <!-- Phone -->
        <div class="col-span-6  -mb-6" wire:init="phonecodeInit">
        <x-jet-label for="phone" value="{{ __('Mobile phone') }}" />
        </div>
            <div class="col-span-1">
                <x-native-select
                    id="phonecode"
                    wire:model="phonecode"
                    :options="$phoneCodeOptions"
                    option-value="code"
                    option-label="label">
                </x-native-select>
            </div>
            <div class="col-span-2 -ml-3">
                <x-input
                    id="phone"
                    placeholder="Enter mobile phone number"
                    wire:model.lazy="state.phone" />
            </div>
            @error('phone')
                <p class="col-span-6 -mt-6 text-sm text-red-500">{{$message}}</p>
            @enderror

        <div class="col-span-6 -mt-3">
            <x-checkbox id="right-label" label="Visible for my Timebank.cc friends" wire:model.defer="state.phone_public_for_friends" />
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

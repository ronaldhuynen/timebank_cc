<x-jetstream.form-section submit="updateMessageSettings">
    <x-slot name="title">
        {{ __('Message settings') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update you message settings') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-8 sm:col-span-4 !font-normal">
            <x-jetstream.label for="email-settings" value="{{ __('Emails') }}" />
            <div class="p-2"></div>
            <x-checkbox id="system_messages" secondary label="{{ __('System messages') }}" wire:model="systemMessage" readonly="true" disabled="true"/>
            @if (getActiveProfileType() != 'Admin')
                <x-checkbox id="payments" secondary label="{{ __('Payments received') }}" wire:model="paymentReceived"/>
                <div class="p-2"></div>
            @endif
            <x-checkbox id="local_newsletter" secondary label="{{ __('Local newsletters') }}" wire:model="localNewsletter"/>
            <x-checkbox id="general_newsletter" secondary label="{{ __('General newsletters') }}" wire:model="generalNewsletter"/>
            <div class="p-2"></div>
            @if (getActiveProfileType() != 'Admin')
                <x-checkbox id="personal_chat_messages" secondary label="{{ __('Unread personal chat messages') }}" wire:model="personalChat"/>
                <x-checkbox id="group_chat_messages" secondary label="{{ __('Unread group chat messages') }}" wire:model="groupChat"/>
                <div class="p-4"></div>
                <x-jetstream.label for="unread_chat_delay" value="{{ __('Delay for sending unread chat message emails') }}" />
                <div class="p-1"></div>

                <div class="w-28">
                            <div class="p-1"></div>
                    <x-maskable
                        id="unread_chat_delay"
                        mask="##"
                        suffix="{{ __('hours') }}"
                        placeholder="0"
                        wire:model="chatUnreadDelay"
                    />
                </div>
            @endif
        </div>   
    </x-slot>


    <x-slot name="actions">
        <x-jetstream.action-message class="mr-3" on="saved">
            {{ __('Saved') }}
        </x-jetstream.action-message>

        <x-jetstream.button>
            {{ __('Save') }}
        </x-jetstream.button>
                    @error('paymentReceived')
                <p class="col-span-6 -mt-6 text-sm text-red-500">{{$message}}</p>
            @enderror
    </x-slot>   
</x-jetstream.form-section>

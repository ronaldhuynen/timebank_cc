<x-jetstream.action-section>
    <x-slot name="title">
        {{ __('Delete profile and login') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Permanently delete your profile.') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600">
            {{ __('Once your profile is deleted, all of its balance totals and data will be permanently deleted. All your transactions will be anonymized, also in the online transaction overviews and statements of other Timebank.cc users. Before deleting your account, please download any data, transaction overviews or statements that you wish to retain.') }}
        </div>

        <div class="mt-5">
            <x-jetstream.danger-button wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                {{ __('Delete profile') }}
            </x-jetstream.danger-button>
        </div>

        <!-- Delete User Confirmation Modal -->
        <x-jetstream.dialog-modal wire:model.live="confirmingUserDeletion">
            <x-slot name="title">
                {{ __('Delete profile') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Are you sure you want to delete your profile? This step is irriversable.') }}
                {{ __('Once your profile is deleted, all of its balance totals and data will be permanently deleted. All your transactions will be anonymized, also in the online transaction overviews and statements of other Timebank.cc users. Before deleting your account, please download any data, transaction overviews or statements that you wish to retain.') }}


                <div class="mt-4" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-jetstream.input type="password" class="mt-1 block w-3/4"
                                placeholder="{{ __('Password') }}"
                                x-ref="password"
                                wire:model="password"
                                wire:keydown.enter="deleteUser" />

                    <x-jetstream.input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jetstream.secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jetstream.secondary-button>

                <x-jetstream.danger-button class="ml-3" wire:click="deleteUser" wire:loading.attr="disabled">
                    {{ __('Delete profile') }}
                </x-jetstream.danger-button>
            </x-slot>
        </x-jetstream.dialog-modal>
    </x-slot>
</x-jetstream.action-section>

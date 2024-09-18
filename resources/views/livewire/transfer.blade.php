<form wire:submit.prevent="showModal">
    @csrf
    <div class="bg-white px-4 py-4 shadow sm:rounded-lg sm:p-6">
        <div class="grid grid-cols-6 gap-6">
            <div class="col-span-6 sm:col-span-4">

                <!--- Amount --->
                @livewire('amount', ['maxLengthHoursInput' => config('timebank-cc.maxLengthHoursInput.user')])
                @error('amount')
                    <div class="mb-3 text-sm text-red-700" role="alert">
                        {{ __($message) }}
                    </div>
                @enderror

                <!--- From account --->
                @livewire('from-account')
                @error('fromAccountId')
                    <div class="mb-3 text-sm text-red-700" role="alert">
                        {{ __($message) }}
                    </div>
                @enderror

                <!--- To Account --->
                @livewire('to-account', ['toHolderName' => $toHolderName])
                @error('toAccountId')
                    <div class="mb-3 text-sm text-red-700" role="alert">
                        {{ __($message) }}
                    </div>
                @enderror

                <!--- Description --->
                @livewire('description')
                @error('description')
                    <div class="mb-3 text-sm text-red-700" role="alert">
                        {{ __($message) }}
                    </div>
                @enderror

            </div>
        </div>
        <div class="text-right">
            <x-jetstream.button wire:click="showModal">
                {{ __('Pay') }}
            </x-jetstream.button>
        </div>
    </div>

    <!----Transfer limit error Modal ---->
    <x-jetstream.dialog-modal wire:model.live="modalErrorVisible">
        <x-slot name="title">
        </x-slot>

        <x-slot name="content">
            {{ $limitError }}
        </x-slot>
        <x-slot name="footer">
            <x-jetstream.secondary-button wire:click="$toggle('modalErrorVisible')" wire:loading.attr="disabled">
                {{ __('Back') }}
            </x-jetstream.secondary-button>
        </x-slot>
    </x-jetstream.dialog-modal>

    <!---- Confirmation Modal ---->
    <x-jetstream.dialog-modal wire:model.live="modalVisible">
        <x-slot name="title">
        </x-slot>

        <x-slot name="content">
            {{ __('Transfer ') . tbFormat($amount) .    __(' to the ') . $toAccountName . __(' of ') . $toHolderName . '?' }}
        </x-slot>
        <x-slot name="footer">
            <x-jetstream.secondary-button wire:click="$toggle('modalVisible')" wire:loading.attr="disabled">
                {{ __('No') }}
            </x-jetstream.secondary-button>

            <x-jetstream.secondary-button class="ml-3" wire:click="doTransfer()" wire:loading.attr="disabled">
                {{ __('Yes') }}
            </x-jetstream.secondary-button>
        </x-slot>
    </x-jetstream.dialog-modal>

</form>

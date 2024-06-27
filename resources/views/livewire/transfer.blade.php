<form wire:submit.prevent="validateModal">

    @csrf
    <div class="px-4 py-4 sm:p-6 bg-white shadow sm:rounded-lg">
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-4">

                    <!--- Amount --->
                    <livewire:amount>
                        @error('amount')
                        <div class="text-sm text-red-700 mb-3" role="alert">
                            {{ __($message) }}
                        </div>
                        @enderror


                    <!--- From account --->
                    <livewire:from-account>


                    <!--- To Account --->
                    <livewire:to-account :toHolderName="$toHolderName">
                        @if ($requiredError && !isset($result))
                        <div class="text-sm text-red-700 mb-3" role="alert">
                            {{ __('This field is required') }}
                        </div>
                        @endif


                    <!--- Description --->
                    <livewire:description>
                        @error('description')
                        <div class="text-sm text-red-700 mb-3" role="alert">
                            {{ __($message) }}
                        </div>
                        @enderror

            </div>
        </div>
    <div class="text-right">
        <x-button>
            {{ __('Pay') }}
        </x-button>
    </div>
</div>


    <!----Transfer limit error Modal ---->
    <x-dialog-modal wire:model="modalErrorVisible">
        <x-slot name="title">
        </x-slot>

        <x-slot name="content">
            {{ $limitError }}
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modalErrorVisible')" wire:loading.attr="disabled">
                {{ __('Back') }}
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>



    <!---- Confirmation Modal ---->
    <x-dialog-modal wire:model="modalVisible">
        <x-slot name="title">
        </x-slot>

        <x-slot name="content">
            {{ __('Transfer ') . $amount . __(' to the ') . $toAccountName . __(' of ') . $toHolderName . '?' }}
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modalVisible')" wire:loading.attr="disabled">
                {{ __('No') }}
            </x-secondary-button>

            <x-secondary-button class="ml-3" wire:click="doTransfer()" wire:loading.attr="disabled">
                {{ __('Yes') }}
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>


</form>

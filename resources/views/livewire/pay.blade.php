<form wire:submit.prevent="showModal">
    @csrf
    <div class="bg-white px-4 py-4 shadow sm:rounded-lg sm:p-6">
        <div class="grid grid-cols-6 gap-6">
            <div class="col-span-6 sm:col-span-4">

                <!--- Amount --->
                @livewire('amount', [
                    'maxLengthHoursInput' => config('timebank-cc.maxLengthHoursInput.user'),
                    'hours' => $hours,
                    'minutes' => $minutes,
                    'amount' => $amount,
                ])
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
                @livewire('to-account', ['toHolderName' => $toHolderName, 'toAccountId' => $toAccountId])
                @error('toAccountId')
                    <div class="mb-3 text-sm text-red-700" role="alert">
                        {{ __($message) }}
                    </div>
                @enderror

                <!--- Description --->
                @livewire('description', ['description' => $description])
                @error('description')
                    <div class="mb-3 text-sm text-red-700" role="alert">
                        {{ __($message) }}
                    </div>
                @enderror

                <!--- Transaction type --->
                @livewire('transaction-type-radio', ['type' => $type, 'typeOptions' => $typeOptions])
                @error('description')
                    <div class="mb-3 text-sm text-red-700" role="alert">
                        {{ __($message) }}
                    </div>
                @enderror

            </div>
        </div>
        <div class="text-right">
            <x-jetstream.button type="submit">
                {{ __('Pay') }}
            </x-jetstream.button>
        </div>
    </div>

    <!----Transfer limit error Modal ---->
    <x-jetstream.dialog-modal wire:model.live="modalErrorVisible">
        <x-slot name="title">
            {{ __('Payment limit') }}
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
    @if (!$limitError && !empty($transactionTypeSelected))
    <x-jetstream.dialog-modal wire:model.live="modalVisible">
        <x-slot name="title">
            {{ __('Confirm your payment') }}
        </x-slot>

        <x-slot name="content">

            <div class="py-3">
                {{ __('messages.pay_confirm', ['amount' => tbFormat($amount), 'toAccountName' => $toAccountName, 'toHolderName' => $toHolderName]) }}
            </div>

            <div class="grid grid-cols-3 items-center justify-center gap-8 py-3">
                <!-- Column 1: Images and Vertical Line -->
                <div class="w-full place-items-end">

                    <div class="w-full place-items-end">
                        <!-- From account -->
                        <div class="flex flex-col items-end">
                            <img alt="{{ session('activeProfileName') }}"
                                 class="h-16 w-16 rounded-full object-cover outline outline-1 outline-offset-2 outline-gray-900"
                                 src="{{ Storage::url(session('activeProfilePhoto')) }}">
                        </div>
                        <!-- Vertical Line and middle icon -->
                        <div class="flex flex-col items-end">
                            <div class="flex h-6 w-16 justify-center py-1">
                                <div class="h-full w-px bg-gray-600"></div>
                            </div>
                            <div class="flex h-6 w-16 justify-center">
                                <div
                                     class="flex h-6 w-6 items-center justify-center rounded-full text-gray-600 outline outline-1 outline-offset-1 outline-gray-600">
                                        <x-icon mini name="{{ $transactionTypeSelected['icon'] }}" />
                                </div>
                            </div>
                            <!-- Arrow Down -->
                            <div class="flex w-16 justify-center py-1">

                                <svg fill="none" height="20" viewBox="0 0 15 20" width="15"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.5 0 L7.5 18 M7.5 18 L0 10 M7.5 18 L15 10" stroke-width="1"
                                          stroke="#4B5563" />
                                </svg>
                            </div>
                        </div>

                        <!-- To account -->
                        <div class="flex flex-col items-end">
                            <img alt="{{ $toHolderName }}"
                                 class="h-16 w-16 rounded-full object-cover outline outline-1 outline-offset-2 outline-gray-600"
                                 src="{{ $toHolderPhoto }}">
                        </div>
                    </div>
                </div>
                <!-- Column 2: Info Text -->
                <div class="col-span-2 place-items-center">
                    <div class="grid h-16 content-center items-center leading-tight">
                        <div class="font-semibold">
                            {{ session('activeProfileName') }}
                        </div>
                        <div class="text-gray-600">
                            {{ __(ucfirst(strtolower($fromAccountName))) }}
                        </div>
                    </div>
                    <div class="grid h-16 mr-12 content-center items-center leading-tight">
                        <div class="font-semibold">
                            {{ tbFormat($amount) }}
                        </div>
                        <div class="text-gray-600">
                            {{ __($transactionTypeSelected['label']) }}
                        </div>
                    </div>
                    <div class="grid h-16 content-center items-center leading-tight">
                        <div class="font-semibold">
                            {{ $toHolderName }}
                        </div>
                        <div class="text-gray-600">
                            {{ $toAccountName }}
                        </div>
                    </div>
                </div>
            </div>
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        </x-slot>
        <x-slot name="footer">
            @if (session('error'))
            <x-jetstream.secondary-button wire:click="$toggle('modalVisible')" wire:loading.attr="disabled">
                {{ __('Back') }}
            </x-jetstream.secondary-button>
            @else
            <x-jetstream.secondary-button class="w-32 justify-center" wire:click="$toggle('modalVisible')"
                    wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jetstream.secondary-button>

            <x-jetstream.secondary-button class="ml-3 w-32 justify-center" wire:click="doTransfer()"
                    wire:loading.attr="disabled">
                {{ __('Ok') }}
            </x-jetstream.secondary-button>
            @endif
        </x-slot>
    </x-jetstream.dialog-modal>
    @endif

</form>

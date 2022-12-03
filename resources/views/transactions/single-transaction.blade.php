<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaction Details') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    {{-- TODO: change into canTransfer --}}
        @if (Laravel\Fortify\Features::canUpdateProfileInformation())

        <div>
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('Your transaction statement') }}</h3>
                        <p class="mt-1 text-sm text-gray-600">{{ __('With detailed specification of this transaction.')  }}</p>
                    </div>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2 ">

                    <!--- Transaction table -->
                    @livewire('single-transaction-table', ['transactionId' => $transactionId, 'accountId' => $accountId])


                </div>
            </div>
        </div>
        @endif



    </div>




 </div>

</x-app-layout>

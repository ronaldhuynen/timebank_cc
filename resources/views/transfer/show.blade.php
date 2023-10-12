<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">
            {{ __('Transfer Timebank.cc Hours') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    {{-- TODO: change into canTransfer --}}
        @if (Laravel\Fortify\Features::canUpdateProfileInformation())

        <div>
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('One hour of work is always valued as H 1:00') }}</h3>
                        <p class="mt-1 text-sm text-gray-600">{{ __('Regardless the type of help you provided. You can include preparation time that is directly related to this exchange. For group exchanges your total work-time should be split by the number of participants. Timebank.cc exchanges are only for non-profit puproses.')  }}</p>
                    </div>
                </div>
                <div class="mt-0 md:mt-0 md:col-span-2 ">

                    <livewire:transfer>

                </div>
            </div>
        </div>
        @endif


    </div>

    <div class="pt-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">


                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">

                    <div class="mt-4 text-2xl">
                        {{ __('Transaction History') }}
                    </div>

                    <div class="mt-6 text-gray-500">
                        {{__('Here we can write some additional info about this page. Of course only if we need to. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in vol ')}}

                    </div>

                    <!--- Transactions table -->
                    @livewire('from-account')


                    <!--- Transactions table -->
                    @livewire('transactions-table')


                </div>
            </div>
        </div>
         </div>


</x-app-layout>

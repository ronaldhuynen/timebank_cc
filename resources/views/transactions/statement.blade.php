    <x-app-layout>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Your transaction history') }}
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white ">

                    <div class="mt-8 text-2xl font-semibold text-gray-900">
                        {{ __('Transaction Statement') }}
                    </div>

                    <div class="mt-6 mb-12 text-gray-500">
                        {{__('Here a short intro about this page.')}}
                    </div>

                    <!--- Transaction table -->
                    @livewire('single-transaction-table', ['transactionId' => $transactionId])

                </div>
            </div>
        </div>
</x-app-layout>

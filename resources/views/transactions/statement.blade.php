<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaction Statement') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">


                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">


                    <div class="my-6 text-gray-500">
                        {{__('Here detailed info about account holder current date etc..')}}

                    </div>

                    <!--- Components here -->
     <!--- Transaction table -->
     @livewire('single-transaction-table', ['transactionId' => $transactionId, 'accountId' => $accountId])






                </div>
            </div>
        </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">
            {{ __('Transaction History') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">

                    <!--- Change account -->
                    @livewire('from-account', ['label' => __('Change account')])
                    
                    <!-- Table title -->
                    @livewire('table-title')

                    <!-- Balance limits --->
                    @livewire('account-usage-bar')

                    <!--- Transactions table -->
                    @livewire('transactions-table')

                </div>
            </div>
        </div>

</x-app-layout>


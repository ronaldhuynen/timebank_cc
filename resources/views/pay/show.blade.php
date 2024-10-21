<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-900">
            {{ __('Transfer Timebank.cc Hours') }}
        </h2>
            </x-slot>

    <div class="mx-auto max-w-7xl py-10 sm:px-6 lg:px-8">
            <div>
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">
                                {{ __('One hour of work is always valued as H 1:00') }}</h3>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Regardless the type of help you provided. You can include preparation time that is directly related to this exchange. For group exchanges your total work-time should be split by the number of participants. Timebank.cc exchanges are only for non-profit puproses.') }}
                            </p>
                        </div>
                    </div>
                    <div class="mt-0 md:col-span-2 md:mt-0">
                        @livewire('pay', [
                            'amount' => $amount ?? null,
                            'hours' => $hours ?? null,
                            'minutes' => $minutes ?? null,
                            'toAccountId' => $toAccountId ?? null,
                            'toHolderName' => $name ?? null,
                            'description' => $description ?? null,
                        ])
                    </div>
                </div>
            </div>
    </div>
</x-app-layout>

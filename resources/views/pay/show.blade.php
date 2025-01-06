<x-app-layout>
    <x-slot name="header">
        <div class="mt-2 text-xl font-semibold leading-tight text-gray-100">
            {{ __('Transfer Timebank.cc Hours') }}
        </div>
    </x-slot>

    <div class="mx-auto max-w-7xl py-10 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-3 sm:px-0">
                    @livewire('side-post', [
                        'type' => 'SiteContents\Pay\Sticky' ?? null, 
                        'sticky' => true,
                        'fallbackTitle' => __('Your time is currency'),
                        'fallbackDescription' => __('Timebank Hours can only be used to trade work, help, or services. Each hour equals 60 minutes of work. They can’t be turned into euros, emphasizing that all work is valued equally. These simple rules ensure that no profit can be made, keeping the focus on cooperation and mutual support.') ])
                    @livewire('side-post', [
                        'type' => 'SiteContents\Pay' ?? null, 
                        'random' => true,
                        'fallbackTitle' => '',
                        'fallbackDescription' => '' ])
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
                    'type' => $type ?? null,
                ])
            </div>
        </div>
    </div>
</x-app-layout>

<div class="my-4">

    <div class="flex space-x-12">
        <div class="my-6 w-2/4 flex-none">
            <x-jetstream.label for="search" value="{{ __('Search keywords') }}" />
            <x-jetstream.input :clearable="true" class="text-sm text-gray-900 placeholder-gray-300"
                               placeholder="Search keywords" right-icon="search" wire:model.live="search" />
            @error('search')
                <div class="mb-3 text-sm text-red-700" role="alert">
                    {{ __($message) }}
                </div>
            @enderror

            <livewire:select-account :label="__('Search from / to')" />
            <x-jetstream.label for="searchAmount" value="{{ __('Search amount') }}" />
            <x-jetstream.input :clearable="true" class="text-sm text-gray-900 placeholder-gray-300"
                               placeholder="Search by amount" right-icon="search" wire:model.live="searchAmount" />
            @error('searchAmount')
                <div class="mb-3 text-sm text-red-700" role="alert">
                    {{ __($message) }}
                </div>
            @enderror
            <!--- Amount --->
            <livewire:amount :label="__('Search amount')" :maxLengthHoursInput="config('timebank-cc.maxLengthHoursInput.user')" />
            {{-- TODO: if user is admin or bank:  <livewire:amount :label="__('Search amount')" :maxLengthHoursInput="config('timebank-cc.maxLengthHoursInput.bank')"> --}}
                @error('amount')
                    <div class="mb-3 text-sm text-red-700" role="alert">
                        {{ __($message) }}
                    </div>
                @enderror
        </div>
        <div class="z-50 my-6 flex-auto">
            <x-datetime-picker :shadowless="true" :without-time="true" class="placeholder-gray-300"
                               display-format="DD-MM-YYYY" label="{{ __('From date') }}"
                               placeholder="{{ __('Select a date') }}" wire:model.live="fromDate" />
        </div>
        <div class="z-50 my-6 flex-auto">
            <x-datetime-picker :shadowless="true" :without-time="true" class="placeholder-gray-300"
                               display-format="DD-MM-YYYY" label="{{ __('To date') }}"
                               placeholder="{{ __('Select a date') }}" wire:model.live="toDate" />
        </div>
    </div>
    <x-jetstream.secondary-button class="mt-2" type="button" wire:click="searchTransactions">
        {{ __('Search') }}
    </x-jetstream.secondary-button>
    <!-- Results table -->
    <table class="mbt-2 mb-20 w-full min-w-full leading-normal" id="transactions">
        <thead>
            <tr>
                <th class="border-b border-gray-200 py-6">

                    <a class="px-0 py-2 text-sm font-normal text-gray-500" href="#" role="button" scope="col"
                       wire:click.prevent="sortBy('datetime')">
                        {{ __('Date') }}
                    </a>
                </th>
                <th class="border-b border-gray-200 py-6">

                    <a class="px-0 py-2 text-sm font-normal text-gray-500" href="#" role="button" scope="col"
                       wire:click.prevent="sortBy('relation')">
                        {{ __('From / to') }}
                    </a>
                </th>
                <th class="border-b border-gray-200 py-6">

                    <a class="px-0 py-2 text-sm font-normal text-gray-500" href="#" role="button" scope="col"
                       wire:click.prevent="sortBy('description')">
                        {{ __('Details') }}
                    </a>
                </th>
                <th class="border-b border-gray-200 py-6 text-right">

                    <a class="px-0 py-2 text-sm font-normal text-gray-500" href="#" role="button" scope="col"
                       wire:click.prevent="sortBy('amount')">
                        {{ __('Amount') }}
                    </a>
                </th>
                @if ($hideBalance === false)
                    <th class="border-b border-gray-200 py-6 text-right">
                        <a class="px-0 py-2 text-sm font-normal text-gray-500" href="#" role="button"
                           scope="col" wire:click.prevent="sortBy('balance')">
                            {{ __('Balance') }}
                        </a>
                    </th>
                @endif
            </tr>
        </thead>
        <tbody>
            @if ($transactions)
                @foreach ($transactions['data'] as $transaction)
                    <tr onclick="window.location='{{ route('transaction.show', $transaction['trans_id']) }}'"
                        style="cursor: pointer;">
                        <td class="w-2/16 border-b border-gray-200 bg-white px-2 py-2 text-sm">
                            <p class="whitespace-no-wrap text-gray-900">
                                {{ date('d-m-Y', strtotime($transaction['datetime'])) }}
                            </p>
                        </td>
                        <td class="w-6/16 border-b border-gray-200 bg-white px-2 py-2 text-sm">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <p class="relative block" href="#">
                                        <img alt="profile" class="mx-auto h-10 w-10 rounded-full object-cover"
                                             src="{{ Storage::url($transaction['profile_photo']) }}" />
                                    </p>
                                </div>
                                <div class="ml-3">
                                    <p class="whitespace-no-wrap text-gray-900">
                                        {{ $transaction['relation'] }}
                                    </p>
                                    <p class="whitespace-no-wrap text-gray-500">
                                        @if (isset($transaction['account_to_name']))
                                            {{ $transaction['account_to_name'] }}
                                        @else
                                            {{ $transaction['account_from_name'] }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="w-8/16 border-b border-gray-200 bg-white px-2 py-2 text-sm">
                            @if ($hideBalance === false)
                                <p class="whitespace-no-wrap text-gray-900">
                                    {{ strlen($transaction['description']) > 63 ? substr_replace($transaction['description'], '...', 60) : $transaction['description'] }}
                                </p>
                            @else
                                <p class="whitespace-no-wrap text-gray-900">
                                    {{ strlen($transaction['description']) > 83 ? substr_replace($transaction['description'], '...', 80) : $transaction['description'] }}
                                </p>
                            @endif
                        </td>
                        <td class="w-2/16 border-b border-gray-200 bg-white px-2 py-2 text-right text-sm">
                            <p class="whitespace-no-wrap text-gray-900">
                                @if ($transaction['type'] === 'Debit')
                                    <span class="text-red-700"> {{ tbFormat($transaction['amount']) }} -</span>
                                @else
                                    <span class="text-gray-900"> {{ tbFormat($transaction['amount']) }} +</span>
                                @endif
                            </p>
                        </td>
                        @if ($hideBalance === false)
                            <td class="w-2/16 border-b border-gray-200 bg-white px-2 py-2 text-right text-sm">
                                <p class="whitespace-no-wrap text-gray-900">
                                    @if ($transaction['balance'] < 0)
                                        <span class="text-red-700"> {{ tbFormat($transaction['balance']) }} </span>
                                    @else
                                        <span class="text-gray-900"> {{ tbFormat($transaction['balance']) }} </span>
                                    @endif
                                </p>
                            </td>
                        @endif
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="row relative">
        <div class="flex">
            <select class="w-20 rounded-md border border-gray-300 bg-white px-3 py-2 text-gray-700 shadow-sm focus:border-gray-500 focus:outline-none focus:ring-gray-500 sm:text-sm"
                    wire:model.live="perPage">
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="200">200</option>
            </select>
            <div class="mt-2 flex-auto px-3 text-gray-400">{{ __('results') }}</div>
        </div>
        @if ($transactions)
            <div class="absolute right-0">
                {{ (new \Illuminate\Pagination\LengthAwarePaginator(
                    $transactions['data'],
                    $transactions['total'],
                    $transactions['per_page'],
                    $transactions['current_page'],
                    ['path' => $transactions['path']],
                ))->links('vendor.livewire.tailwind') }}
            </div>
        @endif
    </div>

</div>

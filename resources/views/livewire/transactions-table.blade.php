<div class="my-4">

    <div class="flex space-x-12">
        <div class="flex-none w-2/4 my-6">
            <x-input wire:model="search" right-icon="search" label="{{ __('Search transactions') }}" placeholder="Name, description or amount" :clearable="true" class="placeholder-gray-300 text-gray-900 text-sm" />

        </div>
        <div class="flex-auto my-6 z-50">
            <x-datetime-picker label="{{ __('From date') }}" placeholder="{{ __('Select a date') }}" wire:model="fromDate" :without-time="true" display-format="DD-MM-YYYY" class="placeholder-gray-300" />

        </div>

        <div class="flex-auto my-6 z-50">
            <x-datetime-picker label="{{ __('To date') }}" placeholder="{{ __('Select a date') }}" wire:model="toDate" :without-time="true"  display-format="DD-MM-YYYY" class="placeholder-gray-300" />
        </div>
    </div>



<!-- Results table -->
 <table wire:model="searchState" class="mbt-2 mb-20 min-w-full w-full leading-normal" id="transactions">
     <thead>
         <tr>
            <th class="py-6 border-b border-gray-200">

                <a wire:click.prevent="sortBy('datetime')" href="#" role="button" scope="col" class="px-0 py-2 text-gray-500 text-sm font-normal">
                    {{ __('Date') }}
                </a>
             </th>
             <th class="py-6 border-b border-gray-200">


                <a wire:click.prevent="sortBy('relation')" href="#" role="button" scope="col" class="px-0 py-2 text-gray-500 text-sm font-normal">
                    {{ __('From / to') }}
                </a>
             </th>
             <th class="py-6 border-b border-gray-200">


                <a wire:click.prevent="sortBy('description')" href="#" role="button" scope="col" class="px-0 py-2 text-gray-500 text-sm font-normal">
                    {{ __('Details') }}
                </a>
            </th>
            <th class="py-6 border-b border-gray-200 text-right">


                <a wire:click.prevent="sortBy('amount')" href="#" role="button" scope="col" class="px-0 py-2 text-gray-500 text-sm font-normal">
                    {{ __('Amount') }}
                </a>
            </th>
            @if ($searchState === false )
            <th class="py-6 border-b border-gray-200 text-right">
                <a wire:click.prevent="sortBy('balance')" href="#" role="button" scope="col" class="px-0 py-2 text-gray-500 text-sm font-normal">
                    {{ __('Balance') }}
                </a>
            </th>
            @endif
         </tr>
     </thead>
     <tbody>
         @foreach($transactions as $transaction)
         <tr onclick="window.location='{{ route('transaction.show', $transaction['trans_id']) }}'" style="cursor: pointer;">
             <td class="px-2 py-2 border-b border-gray-200 bg-white text-sm w-2/16">
                 <p class="text-gray-900 whitespace-no-wrap">
                     {{ date('d-m-Y', strtotime($transaction['datetime'])) }}
                 </p>
             </td>
             <td class="px-2 py-2 border-b border-gray-200 bg-white text-sm w-6/16">
                 <div class="flex items-center">
                     <div class="flex-shrink-0">
                         <p href="#" class="block relative">
                             <img alt="profile" src="{{ Storage::url($transaction['profile_photo']) }}" class="mx-auto object-cover rounded-full h-10 w-10 " />
                         </p>
                     </div>
                     <div class="ml-3">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ $transaction['relation'] }}
                            </p>
                            <p class="text-gray-500 whitespace-no-wrap">
                                @if(isset($transaction['account_to_name']))
                                   {{ $transaction['account_to_name'] }}
                                @else
                                   {{ $transaction['account_from_name'] }}
                                @endif
                            </p>
                     </div>
                 </div>
             </td>
             <td class="px-2 py-2 border-b border-gray-200 bg-white text-sm w-8/16">
                @if ($searchState === false )
                    <p class="text-gray-900 whitespace-no-wrap">
                        {{ (strlen($transaction['description']) > 63) ? substr_replace($transaction['description'], '...', 60) : $transaction['description'] }}
                    </p>
                @else
                    <p class="text-gray-900 whitespace-no-wrap">
                        {{ (strlen($transaction['description']) > 83) ? substr_replace($transaction['description'], '...', 80) : $transaction['description'] }}
                    </p>
                @endif
             </td>
             <td class="px-2 py-2 border-b border-gray-200 bg-white text-sm text-right w-2/16">
                 <p class="text-gray-900 whitespace-no-wrap">
                     @if ( $transaction['type'] === 'Debit' )
                     <span class="text-red-700"> {{ tbFormat($transaction['amount']) }} -</span>
                     @else
                        <span class="text-gray-900"> {{ tbFormat($transaction['amount']) }} +</span>
                     @endif
                 </p>
             </td>
            @if ($searchState === false )
                <td class="px-2 py-2 border-b border-gray-200 bg-white text-sm text-right w-2/16">
                    <p class="text-gray-900 whitespace-no-wrap">
                        @if ( $transaction['balance'] < 0 )
                            <span class="text-red-700"> {{ tbFormat($transaction['balance']) }} </span>
                        @else
                            <span class="text-gray-900"> {{ tbFormat($transaction['balance']) }} </span>
                        @endif
                    </p>
                </td>
            @endif
         </tr>
         @endforeach
     </tbody>
 </table>

<!-- Pagination -->
 <div class="row my-6 relative">
    <div class="flex">
        <select wire:model="perPage" class="w-16 py-2 px-3 border border-gray-300 bg-white text-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
        <div class="flex-auto px-3 mt-2 text-gray-400">{{ __('results') }}</div>
    </div>
    <div class="absolute right-0">
        {{-- TODO! Remove livewire.datatables and use the default pagination! No need for datatables package with many dependecies (maatwerk/excel) only for pagination?--}}
        {{ $transactions->links('livewire.datatables.tailwind-pagination') }}
    </div>
 </div>

</div>

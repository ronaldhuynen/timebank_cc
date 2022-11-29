<div>
<input wire:model="search" type="text" placeholder="Search...">
<button wire:click="clear">Clear</button>

<div class="my-6">
<select wire:model="perPage" class="mt-1 block w-16 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    <option value="5">5</option>
    <option value="10">10</option>
    <option value="50">50</option>
</select>
{{ __('Results') }}
</div>

<!-- Results table -->
 <table class="min-w-full w-full leading-normal" id="transactions">
     <thead>
         <tr>
            <th class="py-6 border-b border-gray-200">

                <a wire:click.prevent="sortBy('datetime')" href="#" role="button" scope="col" class="px-0 py-2 text-gray-800 text-sm uppercase font-normal">
                    {{ __('Date') }}
                </a>
             </th>
             <th class="py-6 border-b border-gray-200">


                <a wire:click.prevent="sortBy('relation')" href="#" role="button" scope="col" class="px-0 py-2 text-gray-800 text-sm uppercase font-normal">
                    {{ __('From / to') }}
                </a>
             </th>
             <th class="py-6 border-b border-gray-200">


                <a wire:click.prevent="sortBy('description')" href="#" role="button" scope="col" class="px-0 py-2 text-gray-800 text-sm uppercase font-normal">
                    {{ __('Details') }}
                </a>
            </th>
            <th class="py-6 border-b border-gray-200 text-right">


                <a wire:click.prevent="sortBy('amount')" href="#" role="button" scope="col" class="px-0 py-2 text-gray-800 text-sm uppercase font-normal">
                    {{ __('Amount') }}
                </a>
            </th>
            <th class="py-6 border-b border-gray-200 text-right">


                <a wire:click.prevent="sortBy('balance')" href="#" role="button" scope="col" class="px-0 py-2 text-gray-800 text-sm uppercase font-normal">
                 {{ __('Balance') }}
                </a>
            </th>
         </tr>
     </thead>
     <tbody>
         @foreach($transactions as $transaction)
         <tr>
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
                         <p class="text-gray-900 whitespace-no-wrap ">
                             {{ $transaction['relation'] }}
                         </p>
                     </div>
                 </div>
             </td>
             <td class="px-2 py-2 border-b border-gray-200 bg-white text-sm w-8/16">
                 <p class="text-gray-900 whitespace-no-wrap">
                     {{ (strlen($transaction['description']) > 58) ? substr_replace($transaction['description'], '...', 55) : $transaction['description'] }}
                 </p>
             </td>
             <td class="px-2 py-2 border-b border-gray-200 bg-white text-sm text-right w-2/16">
                 <p class="text-gray-900 whitespace-no-wrap">
                     {{ tbFormat($transaction['amount']) }}
                     @if ( $transaction['type'] === 'Debit' )
                     -
                     @else
                     +
                     @endif
                 </p>
             </td>
             <td class="px-2 py-2 border-b border-gray-200 bg-white text-sm text-right w-2/16">

                 <p class="text-gray-900 whitespace-no-wrap">
                     {{ ($search != null ? '' : tbFormat($transaction['balance'])) }}

                 </p>
             </td>
         </tr>
         @endforeach
     </tbody>
 </table>

<!-- Pagination -->
 <div class="row my-16 relative">
    <div class="absolute right-0">
        {{ $transactions->links('livewire.datatables.tailwind-pagination') }}
    </div>
 </div>



</div>

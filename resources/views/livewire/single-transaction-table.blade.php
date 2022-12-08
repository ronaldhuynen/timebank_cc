<div class="mt-6">
    <!-- Results table -->
    <table class="min-w-full w-full leading-normal" id="transaction">
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
            </tr>
        </thead>
        <tbody>
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
                        {{ $transaction['description'] }}
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
            </tr>
        </tbody>
    </table>
    <div class="my-6 text-gray-500 text-right">

        {{ __('Footer texts here.') }}
    </div>

</div>


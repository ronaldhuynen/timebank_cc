<div class="mt-6">
    <div class="px-0 py-2 text-gray-900 font-bold text-sm">
    {{ __('Transaction # ') }} {{ $transaction['trans_id'] }}
    </div>

    <!--Statement table -->
    <table class="min-w-full w-full leading-normal" id="transaction">
        <thead>
            <tr>
                <th class="py-6 border-b border-gray-200">
                    <a wire:click.prevent="sortBy('datetime')" href="#" role="button" scope="col" class="px-0 py-2 text-gray-500 text-sm font-normal">
                        {{ __('Date') }}
                    </a>
                </th>
                <th class="py-6 border-b border-gray-200">
                    <a wire:click.prevent="sortBy('relation')" href="#" role="button" scope="col" class="px-0 py-2 text-gray-500 text-sm font-normal">
                        {{ __('From') }}
                    </a>
                </th>
                <th class="py-6 border-b border-gray-200">
                    <a wire:click.prevent="sortBy('description')" href="#" role="button" scope="col" class="px-0 py-2 text-gray-500 text-sm font-normal">
                        {{ __('To') }}
                    </a>
                </th>
                <th class="py-6 border-b border-gray-200">
                    <a wire:click.prevent="sortBy('amount')" href="#" role="button" scope="col" class="px-0 py-2 text-gray-500 text-sm font-normal">
                        {{ __('Amount') }}
                    </a>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr onclick="window.location='{{ url()->previous() }}'" style="cursor: pointer;">
                <td class="px-2 py-2 border-b border-gray-200 bg-white text-sm w-2/16 font-bold align-top">

                    <p class="text-gray-900 whitespace-no-wrap">
                        {{ date('d-m-Y', strtotime($transaction['datetime'])) }}
                    </p>
                </td>
                <td class="px-2 py-2 border-b border-gray-200 bg-white text-sm w-6/16 align-top">

                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <p href="#" class="block relative">
                                <img alt="profile" src="{{ Storage::url($transaction['from_profile_photo']) }}" class="mx-auto object-cover rounded-full h-10 w-10 " />
                            </p>
                        </div>
                        <div class="ml-3">
                            <p class="text-gray-900 whitespace-no-wrap font-bold">
                                {{ $transaction['from_relation'] }}
                            </p>
                            <p class="text-gray-900 whitespace-no-wrap ">
                                {{ $transaction['from_account'] }}
                            </p>
                        </div>
                    </div>
                </td>

                <td class="px-2 py-2 border-b border-gray-200 bg-white text-sm w-6/16 align-top">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <p href="#" class="block relative">
                                <img alt="profile" src="{{ Storage::url($transaction['to_profile_photo']) }}" class="mx-auto object-cover rounded-full h-10 w-10 " />
                            </p>
                        </div>
                        <div class="ml-3">
                            <p class="text-gray-900 whitespace-no-wrap font-bold">

                                {{ $transaction['to_relation'] }}
                            </p>
                            <p class="text-gray-900 whitespace-no-wrap ">
                                {{ $transaction['to_account'] }}
                            </p>
                        </div>
                    </div>
                </td>

                <td class="px-2 py-2 border-b border-gray-200 bg-white w-2/16 text-semibold text-xl  align-top">

                    <p class="text-gray-900 whitespace-no-wrap">
                        {{ tbFormat($transaction['amount']) }}
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="text-gray-900 my-6 text-base leading-10">
        {{ $transaction['description'] }}
    </div>
    <div class="mt-12 text-gray-900 text-right relative h-12">
       <x-icon name="link" class="inline w-6 h-6 ml-3" solid />
        <x-icon name="mail" class="inline w-6 h-6 ml-3" solid />
        <x-icon name="qrcode" class="inline w-6 h-6 ml-3" solid />

    </div>

</div>


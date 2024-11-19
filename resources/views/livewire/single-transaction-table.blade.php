<div class="mt-6">
    <div class="px-0 py-2 text-sm font-bold text-gray-900">
        {{ __('Transaction # ') }} {{ $transaction['trans_id'] }}
    </div>

    <!--Statement table -->
    <table class="w-full min-w-full leading-normal" id="transaction">
        <thead>
            <tr>
                <th class="py-6">
                    <div class="px-0 py-2 text-sm font-normal text-gray-500">
                        {{ __('Date') }}
                    </div>
                </th>
                <th class="py-6">
                    <div class="px-0 py-2 text-sm font-normal text-gray-500">
                        {{ __('From') }}
                    </div>
                </th>
                <th class="py-6">
                    <div class="px-0 py-2 text-sm font-normal text-gray-500">
                        {{ __('To') }}
                    </div>
                </th>
                <th class="py-6">
                    <div class="px-0 py-2 text-sm font-normal text-gray-500">
                        {{ __('Amount') }}
                    </div>
                </th>
            </tr>
        </thead>

        <!--TODO: mobile lay-out! -->
        <tbody>
            <tr class="px-1" style="cursor: pointer;">
                <td class="w-2/16 align-top text-sm">
                    <div class="whitespace-no-wrap font-bold text-gray-900">
                        {{ date('D d-m-Y', strtotime($transaction['datetime'])) }}
                    </div>
                    <div class="whitespace-no-wrap text-gray-900">
                        {{ __('on ') . date('H:i:s', strtotime($transaction['datetime'])) }}

                    </div>
                </td>
                <td class="w-6/16 align-top text-sm">

                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="relative block" onclick="window.location='{{ url($transaction['from_relation_path']) }}'">
                                <img alt="profile"
                                    class="mx-auto h-16 w-16 rounded-full object-cover outline outline-1 outline-offset-1 outline-gray-600"
                                    src="{{ Storage::url($transaction['from_profile_photo']) }}" />
                            </div>
                        </div>
                        <div class="ml-3">
                            <div class="whitespace-no-wrap font-bold text-gray-900">
                                @if ($transaction['from_relation_full_name'] == $transaction['from_relation_name']) 
                                    {{ $transaction['from_relation_name'] }} 
                                    <div class="text-gray-500 font-normal text-2xs"> {{$transaction['from_relation_location']}} </div>
                                @else
                                    {{ $transaction['from_relation_name'] }} 
                                    <div class="text-gray-500 font-normal text-2xs"> {{ Illuminate\Support\Str::limit($transaction['from_relation_full_name'] . ', ' . $transaction['from_relation_location'], 35)}} </div>
                                @endif
                            </div>
                            <div class="whitespace-no-wrap text-gray-900">
                                {{ __(ucfirst(strtolower($transaction['from_account']))) }}
                            </div>
                        </div>
                    </div>
                </td>

                <td class="w-6/16 align-top text-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="relative block" onclick="window.location='{{ url($transaction['to_relation_path']) }}'">
                                <img alt="profile"
                                    class="mx-auto h-16 w-16 rounded-full object-cover outline outline-1 outline-offset-1 outline-gray-600"
                                    src="{{ Storage::url($transaction['to_profile_photo']) }}" />
                            </div>
                        </div>
                        <div class="ml-3">
                            <div class="whitespace-no-wrap font-bold text-gray-900">
                                @if ($transaction['to_relation_full_name'] == $transaction['to_relation_name']) 
                                    {{ $transaction['to_relation_name'] }} 
                                    <div class="text-gray-500 font-normal text-2xs"> {{$transaction['to_relation_location']}} </div>
                                @else
                                    {{ $transaction['to_relation_name'] }} 
                                    <div class="text-gray-500 font-normal text-2xs"> {{ Illuminate\Support\Str::limit($transaction['to_relation_full_name'] . ', ' . $transaction['to_relation_location'], 35)}} </div>
                                @endif
                            </div>
                            <div class="whitespace-no-wrap text-gray-900">
                                {{ __(ucfirst(strtolower($transaction['to_account']))) }}
                            </div>
                        </div>
                    </div>
                </td>

                <td class="w-2/16 text-semibold align-top text-sm font-bold">

                    <div class="whitespace-no-wrap text-gray-900">
                        {{ tbFormat($transaction['amount']) }}
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

    <!-- Description --->
    <div class="mt-12 px-0 text-sm font-normal text-gray-500">
        {{ __('Description') }}
    </div>
    <div class="my-6 text-base leading-10 text-gray-900">
        {{ $transaction['description'] }}
    </div>

    <!-- Transaction type -->
    @if (!empty($transaction['type_label']))
    <div class="mt-12 px-0 text-sm font-normal text-gray-500">
        {{ __('Transaction type') }}
    </div>
    <div class="my-6 text-base leading-10 text-gray-900">
        <div class="flex items-center">
            <div
                class="flex items-center justify-center rounded-full outline outline-1 outline-offset-1 outline-gray-600">
                    <x-icon class="" mini name="{{ $transaction['type_icon'] }}" />
                </div>
            <span class="ml-3">{{ __(ucfirst(strtolower(($transaction['type_label'])))) }}</span>
        </div>
    </div>
    @endif

    <div class="my-6 text-right align-bottom text-gray-900">
        <span class="float-right my-12" onclick="qrModal()" style="cursor: pointer;"
            wire:click="$toggle('qrModalVisible')">

            {{ SimpleSoftwareIO\QrCode\Facades\QrCode::size(60)->errorCorrection('L')->color(17, 24, 39)->generate(route('transaction.show', ['transactionId' => $transactionId])) }}
        </span>

    </div>

    <!---- QR Modal ---->
    <x-jetstream.dialog-modal wire:model.live="qrModalVisible">

        <x-slot name="title">
            {{ __('QR code') }} {{ strtolower(__('Transaction # ')) }} {{ $transaction['trans_id'] }}
        </x-slot>

        <x-slot name="content">
            <div class="py-6">
                {{ __('messages.qr_transaction_info', ['from_relation' => $transaction['from_relation_name'], 'to_relation' => $transaction['to_relation_name']]) }}
            </div>
            <div class="flex flex-col items-center justify-center h-full">
                <!-- Align QR code in center and scale to max width -->
                <div class="relative object-cover mb-4" id="qr-container" wire:click="$toggle('qrModalVisible')">
                    {{ SimpleSoftwareIO\QrCode\Facades\QrCode::size(280)->errorCorrection('L')->color(17, 24, 39)->generate(route('transaction.show', ['transactionId' => $transactionId])) }}
                </div>
                <!-- Route Link -->
                {{ route('transaction.show', ['transactionId' => $transactionId]) }}
            </div>
        </x-slot>
        
        <x-slot name="footer">
        </x-slot>

        <x-slot name="footer">
        </x-slot>
    </x-jetstream.dialog-modal>
</div>

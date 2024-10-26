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
            <tr class="px-1" onclick="window.location='{{ url()->previous() }}'" style="cursor: pointer;">
                <td class="w-2/16 align-top text-sm">
                    <p class="whitespace-no-wrap font-bold text-gray-900">
                        {{ date('D d-m-Y', strtotime($transaction['datetime'])) }}
                    </p>
                    <p class="whitespace-no-wrap text-gray-900">
                        {{ __('on ') . date('H:i:s', strtotime($transaction['datetime'])) }}

                    </p>
                </td>
                <td class="w-6/16 align-top text-sm">

                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <p class="relative block" href="#">
                                <img alt="profile"
                                     class="mx-auto h-16 w-16 rounded-full object-cover outline outline-1 outline-offset-1 outline-gray-600"
                                     src="{{ Storage::url($transaction['from_profile_photo']) }}" />
                            </p>
                        </div>
                        <div class="ml-3">
                            <p class="whitespace-no-wrap font-bold text-gray-900">
                                {{ $transaction['from_relation'] }}
                            </p>
                            <p class="whitespace-no-wrap text-gray-900">
                                {{ $transaction['from_account'] }}
                            </p>
                        </div>
                    </div>
                </td>

                <td class="w-6/16 align-top text-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <p class="relative block" href="#">
                                <img alt="profile"
                                     class="mx-auto h-16 w-16 rounded-full object-cover outline outline-1 outline-offset-1 outline-gray-600"
                                     src="{{ Storage::url($transaction['to_profile_photo']) }}" />
                            </p>
                        </div>
                        <div class="ml-3">
                            <p class="whitespace-no-wrap font-bold text-gray-900">

                                {{ $transaction['to_relation'] }}
                            </p>
                            <p class="whitespace-no-wrap text-gray-900">
                                {{ $transaction['to_account'] }}
                            </p>
                        </div>
                    </div>
                </td>

                <td class="w-2/16 text-semibold align-top text-sm font-bold">

                    <p class="whitespace-no-wrap text-gray-900">
                        {{ tbFormat($transaction['amount']) }}
                    </p>
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
    <div class="mt-12 px-0 text-sm font-normal text-gray-500">
        {{ __('Transaction type') }}
    </div>
    <div class="my-6 text-base leading-10 text-gray-900">
        @if ($transaction['type'] == 'work')
            <div class="flex items-center">
                <div
                     class="flex items-center justify-center rounded-full outline outline-1 outline-offset-1 outline-gray-600">
                    <x-icon class="" mini name="clock" />
                </div>
                <span class="mx-2">{{ __('For the total time worked or helped') }}</span>
            </div>
        @elseif ($transaction['type'] == 'gift')
            <div class="flex items-center">
                <div
                     class="flex items-center justify-center rounded-full outline outline-1 outline-offset-1 outline-gray-600">

                    <x-icon mini name="gift" />
                </div>
                <span class="mx-2">{{ __('As a gift, without something in return') }}</span>
            </div>
        @elseif ($transaction['type'] == 'donation')
            <div class="flex items-center">
                <div
                     class="flex items-center justify-center rounded-full outline outline-1 outline-offset-1 outline-gray-600">
                    <x-icon mini name="hand-thumb-up" />
                </div>
                <span class="mx-2">{{ __('As a donation, to support the cause of this organization') }}</span>
            </div>
        @elseif ($transaction['type'] == 'currency creation')
            <div class="flex items-center">
                <div
                     class="flex items-center justify-center rounded-full outline outline-1 outline-offset-1 outline-gray-600">
                    <x-icon mini name="bolt" />
                </div>
                <span class="mx-2">{{ __('Currency creation') }}</span>
            </div>
        @elseif ($transaction['type'] == 'currency removal')
            <div class="flex items-center">
                <div
                     class="flex items-center justify-center rounded-full outline outline-1 outline-offset-1 outline-gray-600">
                    <x-icon mini name="bolt-slash" />
                </div>
                <span class="mx-2">{{ __('Currency removal') }}</span>
            </div>
        @endif
    </div>

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
                {{ __('messages.qr_transaction_info', ['from_relation' => $transaction['from_relation'], 'to_relation' => $transaction['to_relation']]) }}
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

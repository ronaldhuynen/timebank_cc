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

        <!--FIXME: mobile lay-out! -->
        <tbody>
            <tr onclick="window.location='{{ url()->previous() }}'" style="cursor: pointer;">
                <td class="px-2 py-2 border-b border-gray-200 bg-white text-sm w-2/16 align-top">
                    <p class="text-gray-900 whitespace-no-wrap font-bold">
                        {{ date('D d-m-Y', strtotime($transaction['datetime'])) }}
                    </p>
                    <p class="text-gray-900 whitespace-no-wrap">
                        {{ __('on ') . date('H:i:s', strtotime($transaction['datetime'])) }}

                    </p>
                </td>
                <td class="px-2 py-2 border-b border-gray-200 bg-white text-sm w-6/16 align-top">

                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <p href="#" class="block relative">
                                <img alt="profile" src="{{ Storage::url($transaction['from_profile_photo']) }}" class="mx-auto object-cover rounded-full w-16 h-16 " />
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
                                <img alt="profile" src="{{ Storage::url($transaction['to_profile_photo']) }}" class="mx-auto object-cover rounded-full w-16 h-16 " />
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

                <td class="px-2 py-2 border-b border-gray-200 bg-white w-2/16 text-semibold text-sm font-bold  align-top">

                    <p class="text-gray-900 whitespace-no-wrap">
                        {{ tbFormat($transaction['amount']) }}
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="px-0 mt-12 text-gray-500 text-sm font-normal">
    {{ __('Description') }}
    </div>
    <div class="text-gray-900 my-6 text-base leading-10">
        {{ $transaction['description'] }}
    </div>

    <div class="my-6 text-gray-900 text-right align-bottom">
        <span wire:click="$toggle('qrModalVisible')" class="float-right my-12" style="cursor: pointer;" onclick="qrModal()">


            {{ SimpleSoftwareIO\QrCode\Facades\QrCode::size(60)->errorCorrection('L')->color(17, 24, 39)->generate(route('transaction.show', ['transactionId' => $transactionId])) }}
        </span>

    </div>


    <!---- Confirmation Modal ---->
    <x-jet-dialog-modal wire:model="qrModalVisible">

        <x-slot name="title">
        </x-slot>

        <x-slot name="content">
        <div class="absolute"></div>

            <!-- TODO: Align qr in center and scale to max width -->
            <div wire:click="$toggle('qrModalVisible')" class="object-cover relative inset-0" id="qr-container">
                {{ SimpleSoftwareIO\QrCode\Facades\QrCode::size(280)->errorCorrection('L')->color(17, 24, 39)->generate(route('transaction.show', ['transactionId' => $transactionId])) }}
               <script>
                   function qrModal() {
                       console.log('qrModal exxcutes');
                        document.getElementById('qr-container').firstElementChild.setAttribute("width", "100%");
                        document.getElementById('qr-container').firstElementChild.setAttribute("height", "100%");
                        document.getElementById('qr-container').firstElementChild.setAttribute("viewBox", "0 0 600 600");
                        console.log(document.getElementById('qr-container').firstElementChild);
                   }
               </script>

            </div>
            {{ route('transaction.show', ['transactionId' => $transactionId]) }}
        </x-slot>

        <x-slot name="footer">
        </x-slot>
    </x-jet-dialog-modal>
</div>

